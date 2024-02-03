<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//Headers

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Methods: POST');

//Include Database and Post Model.

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//Instantiate Database.

$database = new Database();
$db = $database->connect();

//Instantiate Category.

$category = new Category($db);
$data = $category->readCategories();

//if there is categories available

if ($data->rowCount()) {
    $category = [];

    //fetching the data from the database

    while ($row = $data->fetch(PDO::FETCH_OBJ)) {

        $category[$row->id] = [
            'id' => $row->id,
            'name' => $row->name,
            'created_at' => $row->created_at,
        ];
    }

    //return the data in json format
    http_response_code(200);
    echo json_encode($category);

} else {
    http_response_code(404);
    echo json_encode(['message' => 'No Categories Found']);
}
