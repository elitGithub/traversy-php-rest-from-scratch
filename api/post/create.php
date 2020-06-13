<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$errMsg = [
    'success' => false,
    'message' => 'Error adding new post',
    'data' => [],
];

$successMsg = [
    'success' => true,
    'message' => '',
    'data' => []
];
$database = new Database();
$db = $database->connect();

$blogPost = new Post($db);

$data = json_decode(file_get_contents("php://input"));

$blogPost->title = $data->title;
$blogPost->body = $data->body;
$blogPost->author = $data->author;
$blogPost->category_id = $data->category_id;

if ($blogPost->create()) {
    die(json_encode($successMsg));
}

die(json_encode($errMsg));