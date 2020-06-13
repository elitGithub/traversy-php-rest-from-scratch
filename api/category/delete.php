<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

$errMsg = [
    'success' => false,
    'message' => 'Error deleting category',
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

$data = json_decode(file_get_contents("php://input"));
$category->id = $data->id;

if ($category->check()) {
    if ($category->delete()) {
        die(json_encode($successMsg));
    }
}
die(json_encode($errMsg));