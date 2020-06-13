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

$category->id = $category->check() ? $_GET['id'] : die(json_encode($errMsg));

$category->readSingle();

$categoryItem = [
    'id' => $category->id,
    'name' => $category->name,
];

$successMsg['data'][] = $categoryItem;
die(json_encode($successMsg));