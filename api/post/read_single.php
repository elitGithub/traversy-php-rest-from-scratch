<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$errMsg = [
    'success' => false,
    'message' => 'Can\'t get any posts',
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
$blogPost->id = $blogPost->check() ? $_GET['id'] : die(json_encode($errMsg));

$blogPost->readSinglePost();

$postItem = [
    'id' => $blogPost->id,
    'title' => $blogPost->title,
    'body' => html_entity_decode($blogPost->body),
    'author' => $blogPost->author,
    'cateogry_id' => $blogPost->category_id,
    'category_name' => $blogPost->category_name
];

$successMsg['data'][] = $postItem;
die(json_encode($successMsg));