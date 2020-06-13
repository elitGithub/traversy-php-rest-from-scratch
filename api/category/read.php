<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$errMsg = [
    'success' => false,
    'message' => 'Can\'t get any categories',
    'data' => [],
];

$successMsg = [
    'success' => true,
    'message' => '',
    'data' => []
];
$database = new Database();
$db = $database->connect();

$category = new Category($db);

$result = $category->readAll();
$rowNum = $result->rowCount();

if ($rowNum < 1) {
    die(json_encode($errMsg));
}

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    $categoryItem = [
        'id' => $id,
        'name' => html_entity_decode($name),
        'created_at' => $created_at
    ];

    $successMsg['data'][] = $categoryItem;
}

die(json_encode($successMsg));