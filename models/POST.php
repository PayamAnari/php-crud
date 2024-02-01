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

    //Get Posts.

    public function readPosts()
    {

        //Create Query.

        $query = 'SELECT
      category.name as category,
      posts.id,
      posts.title,
      posts.description,
      posts.category_id,
      posts.created_at
      FROM ' . $this->$table . ' posts LEFT JOIN
      category ON posts.category_id = category.id
      ORDER BY
      posts.created_at DESC
      ';

        //Prepare Statement.

        $post = $this->connection->prepare($query);

        //Execute Query.

        $post->execute();

        return $post;

    }

}
