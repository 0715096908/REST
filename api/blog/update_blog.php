<?php
//we use PUT request to update our blog
//this file interacts with our model
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-with');


include_once '../../config/Database.php';
include_once '../../models/Blog.php';

$database = new Database();
$db = $database->connect();

$post = new Blog($db);

$data = json_decode(file_get_contents("php://input"));

$post->id=$data->id;

//assign data to post

$post->blog_title = $data->blog_title;
$post->blog_body = $data->blog_body;
$post->blog_author = $data->blog_author;
$post->blog_id = $data->blog_id;

//create post
if($post->update_blog())
{
    echo json_encode(
    array('message'=>'Blog Updated') 
    );
} 
else
  {
 echo json_encode(
 array('message'=>'Blog Not Updated')
 );
} 
?>