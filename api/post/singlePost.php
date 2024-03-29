<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

//Headers

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Methods: POST');

//Include Database and Post Model.

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate Database.

$database = new Database();
$db = $database->connect();

//Instantiate Post.

$post = new Post($db);

//Get Post.

if (isset($_GET['id'])) {

    $data = $post->read_single_post($_GET['id']);

    if (!is_bool($data)) {
        $posts = [];

        while ($row = $data->fetch(PDO::FETCH_OBJ)) {
            $posts[$row->id] = [
                'id' => $row->id,
                'categoryName' => $row->category,
                'description' => $row->description,
                'title' => $row->title,
                'author' => $row->author,
                'created_at' => $row->created_at,
            ];
        }

        echo json_encode($posts);
    } else {
        echo json_encode(['message' => 'No post found']);
    }

} else {
    http_response_code(400);
    echo json_encode(['message' => 'Please provide the "id" parameter']);
}
