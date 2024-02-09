<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\key;

/**
 * @OA\Info(title="PDO PHP Rest Api", version="1.0")
 *   @OA\SecurityScheme(
 *      type="http",
 *      description="Authentication with JWT",
 *      name="Authorization",
 *      in="header",
 *      scheme="bearer",
 *      bearerFormat="JWT",
 *      securityScheme="bearerToken",
 *    )
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
    protected $key = '98765246776546';

    //Database Connection.

    private $connection;
    private $table = 'posts';

    //Constructor with Database.

    public function __construct($db)
    {
        $this->connection = $db;
    }

    /**
     * @OA\Get(
     * path="/api/post/auth.php",
     * summary="Authenticates user.",
     * tags={"Security"},
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
    public function auth()
    {
        try
        {
            $issueDate = time();
            $expirationDate = time() * 3600; // 1hour
            $payload = [
                'iss' => 'http://localhost/8000',
                'aud' => 'http://localhost',
                'iat' => $issueDate,
                'exp' => $expirationDate,
                'userName' => 'John Doe',
            ];

            $jwtGeneratedToken = JWT::encode($payload, $this->key, 'HS256');

            return [

                'token' => $jwtGeneratedToken,
                'expire' => $expirationDate,
            ];

        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    /**
     * @OA\Get(
     * path="/api/post/posts.php",
     * summary="Get all list of posts",
     * tags={"Posts"},
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * security={ {"bearerToken": {}}}
     * )
     */
    public function readPosts()
    {

        try
        {
            $headers = apache_request_headers();

            if ($headers['Authorization']) {
                $token = str_ireplace('Bearer ', '', $headers['Authorization']);
                $decoded = JWT::decode($token, new key($this->key, 'HS256'));

                if (isset($decoded->userName) && $decoded->userName == 'John Doe') {

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
                } else {
                    return false;
                }

            } else {

                return false;
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        };

    }

    /**
     * @OA\Get(path="/api/post/singlePost.php",
     * tags={"Posts"},
     * summary="Get single post by id",
     * @OA\Parameter(
     *    name="id",
     *    in="query",
     *    required=false,
     *    description="The id passed to get in query string goes here",
     *    @OA\Schema(
     *       type="string"
     *    ),
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

    /**
     * @OA\Post(path="/api/post/insert.php",
     * summary="Create a new post.", tags={"Posts"},
     * @OA\RequestBody(
     *    @OA\MediaType(
     *        mediaType="multipart/form-data",
     *        @OA\Schema(
     *            @OA\Property(
     *                property="title",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                property="author",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                property="description",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                property="category_id",
     *                type="integer",
     *            ),
     *        ),
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
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

    /**
     * @OA\Put(
     * path="/api/post/update.php",
     * summary="Update a new post.", tags={"Posts"},
     * @OA\RequestBody(
     *    @OA\MediaType(
     *        mediaType="json",
     *        @OA\Schema(
     *            @OA\Property(
     *                property="id",
     *                type="integer",
     *            ),
     *            @OA\Property(
     *                property="title",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                property="author",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                property="description",
     *                type="string",
     *            ),
     *            @OA\Property(
     *                property="category_id",
     *                type="integer",
     *            ),
     *        ),
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
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

    /**
     * @OA\Delete(
     * path="/api/post/destroy.php",
     * summary="Delete post from database.",
     * tags={"Posts"},
     * @OA\RequestBody(
     *    @OA\MediaType(
     *      mediaType="json",
     *      @OA\Schema(
     *         @OA\Property(
     *           property="id",
     *           type="integer",
     *         ),
     *       ),
     *    ),
     * ),
     * @OA\Response(response="200", description="Success"),
     * @OA\Response(response="404", description="Not found"),
     * )
     */
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
