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

//$data = json_decode(file_get_contents("php://input"));

// Get raw posted data.

if (count($_POST)) {

    // Create category.

    $params = [
        'name' => $_POST['name'],
    ];

    if ($category->createCategory($params)) {
        echo json_encode(array('message' => 'Category created'));
    }
} else if (isset($data)) {
    $params = [
        'name' => $data->name,
    ];

    if ($category->createCategory($params)) {
        echo json_encode(array('message' => 'Category created'));
    }
}
