<?php
//this file interacts with our model
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Blog.php';

$database = new Database();
$db = $database->connect();

$post = new Blog($db);

$post->id = isset($_GET['id']) ? $_GET['id'] : die();
$post->read_single_blog();

$post_arr = array(
 'id' => $post ->id,
 'blog_title' => $post ->blog_title,
 'blog_body' => $post ->blog_body,
 'blog_author' => $post ->blog_author,
 'blog_id' => $post ->blog_id,
 'blog_name' => $post ->blog_name,
);
//convert it to json data

print_r(json_encode($post_arr));
?>