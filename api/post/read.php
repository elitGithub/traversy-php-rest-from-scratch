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

$result = $blogPost->readAll();
$rowNum = $result->rowCount();

if ($rowNum < 1) {
    die(json_encode($errMsg));
}

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $postItem = [
        'id' => $id,
        'title' => $title,
        'body' => html_entity_decode($body),
        'author' => $author,
        'cateogry_id' => $category_id,
        'category_name' => $category_name
    ];

    $successMsg['data'][] = $postItem;
}

die(json_encode($successMsg));