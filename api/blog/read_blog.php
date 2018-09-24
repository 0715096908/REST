<?php
//this file interacts with our model
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Blog.php';

$database = new Database();
$db = $database->connect();

$post = new Blog($db);

//calls the function we created in our Blog.php
$result = $post->read_blog();


$num = $result->rowCount(); 

//if num > o means some posts found else no post found
if($num > 0)
{
$posts_arr = array();
$posts_arr['data'] = array();

while($row = $result->fetch(PDO::FETCH_ASSOC))
{
    extract($row);
    $post_item = array(
        'id' => $id,
        'blog_title' => $blog_title,
        'blog_body' => html_entity_decode($blog_body),
        'blog_author' => $blog_author,
        'blog_id' => $blog_id,
        'blog_name' => $blog_name
    );

array_push($posts_arr['data'], $post_item);
}

//turn our blog post into json format
echo json_encode($posts_arr);

}
else
{
//no blog found, echo in json format
echo json_encode(
array('message' => 'No blog found in the database')
);
}

?>