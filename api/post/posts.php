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
$data = $post->readPosts();

//if there is posts available

if ($data->rowCount()) {
    $posts = [];

    //fetching the data from the database

    while ($row = $data->fetch(PDO::FETCH_OBJ)) {

        $posts[$row->id] = [
            'id' => $row->id,
            'title' => $row->title,
            'author' => $row->author,
            'categoryName' => $row->category,
            'description' => $row->description,
            'created_at' => $row->created_at,
        ];
    }

    //return the data in json format
    http_response_code(200);
    echo json_encode($posts);

} else {
    http_response_code(404);
    echo json_encode(['message' => 'No Posts Found']);
}
