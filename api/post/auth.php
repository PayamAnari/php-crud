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

$token = new Post($db);

if (!$token->auth()) {
    http_response_code(404);
    echo json_encode(['message' => 'Could not generate token, Contact Admin']);
} else {
    http_response_code(200);
    echo json_encode($token->auth());
    echo json_encode(['message' => 'Token generated successfully']);
}
