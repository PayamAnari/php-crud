<?php

error_reporting(E_ALL);
ini_set('display_error', 1);

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

// Instantiate Database.

$database = new Database;
$db = $database->connect();

$category = new Category($db);

// For $data to work -> add headers and in postman add content type.
$data = json_decode(file_get_contents("php://input"));

if (isset($data)) {

    //Update Category.

    $params = [
        'id' => $data->id,
        'name' => $data->name,
    ];

    if ($category->updateCategory($params)) {
        echo json_encode(['message' => 'Category Updated']);
    } else {
        echo json_encode(['message' => 'Category Not Updated']);
    }
}
