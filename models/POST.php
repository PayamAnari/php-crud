<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
/**
 * @OA\Info(title="PDO PHP Rest Api", version="1.0")
 */

class Post
{

    //Post Properties.

    public $id;
    public $category_id;
    public $title;
    public $author;
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

    /**
     * @OA\Get(
     * path="/api/post/posts.php",
     * summary="Get all list of posts",
     * tags={"Posts"},
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
    public function readPosts()
    {

        //Create Query.

        $query = 'SELECT
      category.name as category,
      posts.id,
      posts.title,
      posts.author,
      posts.description,
      posts.category_id,
      posts.created_at
      FROM ' . $this->table . ' posts LEFT JOIN
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

    /**
     * @OA\Get(
     * path="/api/post/singlePost.php",
     * summary="Get single post",
     * tags={"Posts"},
     * @OA\Parameter(
     * name="id",
     * in="query",
     * required=true,
     * description="ID of the post",
     * @OA\Schema(
     * type="string"
     * ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
    public function read_single_post($id)
    {
        $this->id = $id;

        //Create Query.

        $query = 'SELECT
         category.name as category,
         posts.id,
         posts.title,
         posts.author,
         posts.description,
         posts.category_id,
         posts.created_at
         FROM ' . $this->table . ' posts LEFT JOIN
         category ON posts.category_id = category.id
         WHERE posts.id =?
         LIMIT 0,1
         ';

        $post = $this->connection->prepare($query);

        //$post->bindValue('id', $this->id, PDO::PARAM_INT);

        $post->bindValue(1, $this->id, PDO::PARAM_INT);

        $post->execute();
        return $post;
    }

    //Method for creating post.

    public function create_new_post($params)
    {

        try
        {
            // Assigning the values.

            $this->title = $params['title'];
            $this->author = $params['author'];
            $this->description = $params['description'];
            $this->category_id = $params['category_id'];

            // Create Query.

            $query = 'INSERT INTO ' . $this->table . '
            SET
            title = :title,
            author = :author,
            description = :description,
            category_id = :category_id';

            $post = $this->connection->prepare($query);

            $post->bindValue('title', $this->title);
            $post->bindValue('author', $this->author);
            $post->bindValue('description', $this->description);
            $post->bindValue('category_id', $this->category_id);

            if ($post->execute()) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    //Method for updating post.

    public function update_post($params)
    {

        try
        {
            // Assigning the values.

            $this->id = $params['id'];
            $this->title = $params['title'];
            $this->author = $params['author'];
            $this->description = $params['description'];
            $this->category_id = $params['category_id'];

            // Create Query.

            $query = 'UPDATE ' . $this->table . '
            SET
            title = :title,
            author = :author,
            description = :description,
            category_id = :category_id
            WHERE
            id = :id';

            $post = $this->connection->prepare($query);

            $post->bindValue('id', $this->id);
            $post->bindValue('title', $this->title);
            $post->bindValue('author', $this->author);
            $post->bindValue('description', $this->description);
            $post->bindValue('category_id', $this->category_id);

            if ($post->execute()) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    //Method for deleting post.

    public function delete_post($id)
    {

        try
        {
            // Assigning the values.

            $this->id = $id;

            // Create Query.

            $query = 'DELETE FROM ' . $this->table .
                ' WHERE id = :id';

            $post = $this->connection->prepare($query);

            $post->bindValue('id', $this->id);

            if ($post->execute()) {
                return true;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    public function deletePostsByCategoryId($categoryId)
    {
        try {
            // Create Query.
            $query = 'DELETE FROM ' . $this->table . ' WHERE category_id = :category_id';

            // Prepare Statement.
            $statement = $this->connection->prepare($query);

            // Bind Data.
            $statement->bindValue('category_id', $categoryId);

            // Execute Query.
            return $statement->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

}
