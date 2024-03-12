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
    width="1000"
    alt="home"
    src="https://live.staticflickr.com/65535/53518432372_567e583301_z.jpg"/>
</p>

---
## PHP CRUD REST API with Swagger Documentation and JWT Authentication
### Description

- This PHP CRUD (Create, Read, Update, Delete) REST API is built using PHP PDO for database operations, Swagger for API documentation, and JWT (JSON Web Tokens) for authentication. It provides endpoints to perform CRUD operations on posts and categories, with secure authentication using JWT.


 <p align="center">
  <img 
    width="450"
    alt="home"
    src="https://live.staticflickr.com/65535/53519640099_062e5ffb21_z.jpg"/>
   <img 
    width="450"
    alt="home"
    src="https://live.staticflickr.com/65535/53519641889_6be4981cd2_z.jpg"/>
</p>

---

## Features
- **Create:** Add new posts with title, author, description, and category.
- **Read:** Retrieve a list of posts or get a single post by ID.
- **Update:** Modify existing posts with updated information.
- **Delete:** Remove posts from the database.
- **Authentication:** Secure authentication using JWT (JSON Web Tokens) for accessing protected endpoints.
- **Swagger Documentation:** Well-documented API endpoints using Swagger UI for easy reference.

---

## Endpoints
| METHOD | ROUTE | FUNCTIONALITY |ACCESS|REQUIRMENTS|
| ------- | ----- | ------------- | ------------- | ------------ |
| *GET* | ```/api/post/posts.php``` | _Get a list of all posts_| _All users_| Authentication |
| *GET* | ```/api/post/singlePost.php?id={post_id}``` | _Get a single post by ID_| _All users_| Authentication |
| *POST* | ```/api/post/insert.php``` | _Create a new post_| _All users_| Authentication |
| *PUT* | ```/api/post/update.php`?id={post_id}``` | _Update an existing post_| _All users_| Authentication |
| *DELETE* | ```/api/post/destroy.php?id={post_id}``` | _Delete a post by ID_| _All users_| Authentication |

---

## Usage
- **Clone the Repository:** Clone this repository to your local machine.
- **Install Dependencies:** Run composer install to install required dependencies.
- **Database Configuration:** Update the database connection settings in the Database.php file.
- **Start the Server:** Start your local server (e.g., Apache, Nginx).
- **Access Swagger Documentation:** Navigate to /swagger.json to access the Swagger API documentation.
- **Authentication:** To access protected endpoints, obtain a JWT token by calling the /api/post/auth.php endpoint with valid credentials. Include the obtained token in the Authorization header of your requests to authenticated endpoints.

---
## Example Requests
### Create a New Post (Authenticated Request)

```
POST /api/post/insert.php

{
  "title": "New Post Title",
  "author": "John Doe",
  "description": "This is a new post.",
  "category_id": 1
}
```

### Update a Post (Authenticated Request)

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

### Delete a Post (Authenticated Request)

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
- **Firebase JWT Library** (for authentication)


  <p align="left">
  <img src="https://img.shields.io/badge/Php-00008B?style=for-the-badge&logo=php&logoColor=white"/>
  <img src="https://img.shields.io/badge/mysql-acace6?style=for-the-badge&logo=mysql&logoColor=white"/>
  <img src="https://img.shields.io/badge/Composer-0000FF?style=for-the-badge&logo=Composer&logoColor=white"/>
  <img src="https://img.shields.io/badge/Swagger-85EA2D?style=for-the-badge&logo=Swagger&logoColor=white"/>
  <img src="https://img.shields.io/badge/Phpmyadmin-ffa500?style=for-the-badge&logo=phpmyadmin&logoColor=white"/>
  <img src="https://img.shields.io/badge/JWT-FF0000?style=for-the-badge&logo=jwt&logoColor=white"/>
 
</p>


---

## License
This project is licensed under the [MIT License](LICENSE).

---

### Built with ❤️ by Payam Anari

Thank you for exploring the Gym Fitness app! If you have any questions, feedback, or just want to say hi, feel free to [reach out](mailto:anari.p62@gmail.com). Happy fitness journey!

---
