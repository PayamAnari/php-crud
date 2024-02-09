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

if (count($_POST)) {

    // Create post.

    $params = [
        'title' => $_POST['title'],
        'author' => $_POST['author'],
        'description' => $_POST['description'],
        'category_id' => $_POST['category_id'],
    ];

    $newPost = $post->create_new_post($params);

    if ($newPost) {
        echo json_encode(array('message' => 'Post created'));
    } else {
        echo json_encode(array('message' => 'Post creation failed'));
    }
} else if (isset($data)) {
    $params = [
        'title' => $data->title,
        'author' => $data->author,
        'description' => $data->description,
        'category_id' => $data->category_id,
    ];

    if ($post->create_new_post($params)) {
        echo json_encode(array('message' => 'Post created'));
    }
}
