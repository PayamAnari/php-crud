
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Category
{

    //Category Properties.

    public $id;
    public $name;
    public $created_at;

    //Database Connection.

    private $connection;
    private $table = 'category';

    //Constructor with Database.

    public function __construct($db)
    {
        $this->connection = $db;
    }

    //Get Categories.

    public function readCategories()
    {

        //Create Query.

        $query = 'SELECT
        id,
        name,
        created_at
        FROM ' . $this->table . '
        ORDER BY
        created_at DESC
        ';

        //Prepare Statement.

        $category = $this->connection->prepare($query);

        //Execute Query.

        $category->execute();

        return $category;

    }

    //Create Category.

    public function createCategory()
    {

        //Create Query.

        $query = 'INSERT INTO ' . $this->table . '
        SET
        name = :name';

        //Prepare Statement.

        $category = $this->connection->prepare($query);

        //Clean Data.

        $this->name = htmlspecialchars(strip_tags($this->name));

        //Bind Data.

        $category->bindParam(':name', $this->name);

        //Execute Query.

        if ($category->execute()) {
            return true;
        }

        //Print Error if something goes wrong.

        printf("Error: %s.\n", $category->error);

        return false;

    }

}
