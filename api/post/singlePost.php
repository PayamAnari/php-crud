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
