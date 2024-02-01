<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Post
{

    //Post Properties.

    public $id;
    public $category_id;
    public $title;
    public $description;
    public $created_at;

    //Database Connection.

    private $connection;
    private $table = 'posts';

    //Constructor with Database.

    public function __construct($db)
    {
        $this->connection = $db;
    }

}
