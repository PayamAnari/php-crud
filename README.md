<h1 align="center">
  <img
    width="300"
    alt="php-crud"
    src="https://live.staticflickr.com/65535/53513286051_89dd5e6176.jpg">
</h1>

---
<h3 align="center">
  <strong>
      ✅ PDO PHP Rest Api ✅

  </strong>
</h3>

---
<p align="center">
  <img 
    width="1200"
    alt="home"
    src="https://live.staticflickr.com/65535/53513454408_f335f82d77_z.jpg"/>
</p>

---
## PHP CRUD REST API with Swagger Documentation
### Description

- This PHP CRUD (Create, Read, Update, Delete) REST API is built using PHP PDO for database operations and Swagger for API documentation. It provides endpoints to perform CRUD operations on posts and categories.

---

## Features
- **Create:** Add new posts with title, author, description, and category.
- **Read:** Retrieve a list of posts or get a single post by ID.
- **Update:** Modify existing posts with updated information.
- **Delete:** Remove posts from the database.
- **Swagger Documentation:** Well-documented API endpoints using Swagger UI for easy reference.

---

## Endpoints
- **GET /api/post/posts.php:** Get a list of all posts.
- **GET /api/post/singlePost.php?id={post_id}:** Get a single post by its ID.
- **POST /api/post/insert.php:** Create a new post.
- **PUT /api/post/update.php:** Update an existing post.
- **DELETE /api/post/destroy.php:** Delete a post by its ID.

---

## Usage
- **Clone the Repository:** Clone this repository to your local machine.
- **Install Dependencies:** Run composer install to install required dependencies.
- **Database Configuration:** Update the database connection settings in the Database.php file.
- **Start the Server:** Start your local server (e.g., Apache, Nginx).
- **Access Swagger Documentation:** Navigate to /swagger.json to access the Swagger API documentation.

---
## Example Requests
### Create a New Post

```
POST /api/post/insert.php

{
  "title": "New Post Title",
  "author": "John Doe",
  "description": "This is a new post.",
  "category_id": 1
}
```

### Update a Post

```
PUT /api/post/update.php

{
  "id": 1,
  "title": "Updated Post Title",
  "author": "Jane Doe",
  "description": "This post has been updated.",
  "category_id": 2
}
```

### Delete a Post

```
POST /api/post/destroy.php

{
  "id": 1
}
```

---

## Technologies Used
- **PHP** >= 7.0
- **MySQL**
- **Composer** (for installing dependencies)
- **Swagger**
- **PhpMyAdmin**

  <p align="left">
  <img src="https://img.shields.io/badge/Php-00008B?style=for-the-badge&logo=phpmyadmin&logoColor=white"/>
  <img src="https://img.shields.io/badge/mysql-acace6?style=for-the-badge&logo=phpmyadmin&logoColor=white"/>
  <img src="https://img.shields.io/badge/Composer-0000FF?style=for-the-badge&logo=Composer&logoColor=white"/>
  <img src="https://img.shields.io/badge/Swagger-85EA2D?style=for-the-badge&logo=Swagger&logoColor=white"/>
  <img src="https://img.shields.io/badge/Phpmyadmin-ffa500?style=for-the-badge&logo=phpmyadmin&logoColor=white"/>
 
</p>


---

## License
This project is licensed under the [MIT License](LICENSE).

---

### Built with ❤️ by Payam Anari

Thank you for exploring the Gym Fitness app! If you have any questions, feedback, or just want to say hi, feel free to [reach out](mailto:anari.p62@gmail.com). Happy fitness journey!

---
