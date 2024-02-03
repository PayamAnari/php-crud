<?php

error_reporting(E_ALL);
ini_set('display_error', 1);

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate Database.

$database = new Database;
$db = $database->connect();

$post = new Post($db);

// Get raw posted data.
// For $data to work -> add headers and in postman add content type.
$data = json_decode(file_get_contents("php://input"));

if (isset($data)) {

    //Update Post.

    $params = [
        'id' => $data->id,
        'title' => $data->title,
        'author' => $data->author,
        'category_id' => $data->category_id,
        'description' => $data->description,
    ];

    if ($post->update_post($params)) {
        echo json_encode(['message' => 'Post Updated']);
    } else {
        echo json_encode(['message' => 'Post Not Updated']);
    }
}
