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

    // Method for reading single post

    public function read_single_post($id)
    {
        $this->id = $id;

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
         WHERE posts.id =?
         LIMIT 0,1
         ';

        $post = $this->connection->prepare($query);

        $post->bindValue(1, $this->id, PDO::PARAM_INT);

        $post->execute();
        return $post;
    }

    //Method for creating post.

    public function create_new_post($params)
    {

        //Create Query.

        try
        {

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

}
