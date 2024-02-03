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

$data = json_decode(file_get_contents("php://input"));

if (isset($data)) {

    //Delete Category.

    if ($category->deleteCategory($data->id)) {
        echo json_encode(['message' => 'Category Deleted']);
    } else {
        echo json_encode(['message' => 'Category Not Deleted']);
    }
}
