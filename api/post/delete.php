<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$errMsg = [
    'success' => false,
    'message' => 'Error deleting post',
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
$blogPost->id = $data->id;

if ($blogPost->check()) {
    if ($blogPost->delete()) {
        die(json_encode($successMsg));
    }
}
die(json_encode($errMsg));