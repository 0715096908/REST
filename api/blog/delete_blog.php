<?php
//this file interacts with our model
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-with');


include_once '../../config/Database.php';
include_once '../../models/Blog.php';

$database = new Database();
$db = $database->connect();

$post = new Blog($db);

$data = json_decode(file_get_contents("php://input"));

$post->id=$data->id;


//create post
if($post->delete_blog())
{
    echo json_encode(
    array('message'=>'Blog Deleted') 
    );
} 
else
  {
 echo json_encode(
 array('message'=>'Blog Not Deleted')
 );
} 

 





?>