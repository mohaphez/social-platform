# Social Networking Platform


### Project Description and Features

The Social Networking Platform is a modular web application built using Laravel, which offers various features for social networking. Some key features of the platform include:

- **Modularity**: The project is built with modularity in mind, allowing for easy extension and customization of functionalities.
- **Dockerized Environment**: The project utilizes Docker and Docker Compose for environment setup, ensuring consistency across different development environments.
- **Automated Testing**: Comprehensive test coverage is included for all modules, ensuring the reliability and stability of the application.
- **RESTful Web Services**: The project exposes RESTful web services endpoints to interact with different functionalities of the platform.


## Getting Started

Follow these steps to set up the project on your local environment:

### Prerequisites

Before you begin, make sure you have the following prerequisites installed on your system:

-   [Git](https://git-scm.com/)
-   [Composer](https://getcomposer.org/)
-   [Docker](https://www.docker.com/)
-   [Docker Compose](https://docs.docker.com/compose/)

### Installation

1. Clone the project from GitHub:

    ```bash
    git https://github.com/mohaphez/social-platform.git
    cd social-platform
    ```

2. Copy the `.env.example` file and rename it to `.env`:

    ```bash
    cp .env.example .env
    ```

3. Install the project dependencies using Composer:

    ```bash
    docker run --rm \
        -u "$(id -u):$(id -g)" \
        -v "$(pwd):/var/www/html" \
        -w /var/www/html \
        laravelsail/php82-composer:latest \
        composer install --ignore-platform-reqs --no-scripts
    ```

4. Start the development environment using Docker Sail:

    ```bash
    ./vendor/bin/sail up -d
    ```

5. Update the project dependencies using Composer (**Important**):

    ```bash
        ./vendor/bin/sail composer update
    ```

6. Restart Docker Sail:

    ```bash
        ./vendor/bin/sail down && ./vendor/bin/sail up
    ```

7. Generate an application key:

    ```bash
    ./vendor/bin/sail php artisan key:generate
    ```

8. Run migrations the database:

    ```bash
    ./vendor/bin/sail php artisan migrate
    ```

9. Run seed the database:

    ```bash
    ./vendor/bin/sail php artisan module:seed
    ```

10. Generate the Shield resources and permissions:

    ```bash
    ./vendor/bin/sail php artisan shield:generate --resource=RoleResource --option=permissions
    ```

11. Create a super admin user:

    ```bash
    ./vendor/bin/sail php artisan shield:super-admin
    ```

12. Run storage link command``:

    ```bash
    ./vendor/bin/sail php artisan storage:link
    ```

### Accessing the Application

You can access the panel by opening your web browser and navigating to:

```
http://localhost/manager
```

### Default Admin Credentials

-   **Username:** admin@example.com
-   **Password:** password


### Automated Testing

All modules have comprehensive test suites. Users can easily run the tests using the following command:

```bash
./vendor/bin/sail test
```

# Web Services Endpoint Documentation

## 1. Posts
   ### 1.1 Retrieve Posts

   - **Endpoint**: /api/v1/posts
   - **Method**: GET
   - **Description**: Retrieve a list of posts.
   - **Response**:
     - **Status Code**: 200 OK
     - **Body**:
   ```json
    {
     "data": [
            {
               "id": 2,
               "title": "Post Title",
               "slug": "post-title",
               "published_at": "2024-03-15T12:00:00Z",
               "language": "English",
               "status": "Published",
               "content": "Post Content"
            }
        ],
        "message": "Posts retrieved successfully."
        }
   ```

## 1.2 Create a Post

- **Endpoint**: `/api/v1/posts/save`
- **Method**: POST
- **Description**: Create a new post.
- **Request Body**:
  ```json
  {
       "title": "Post Title",
       "slug": "post-title",
       "published_at": "2024-03-15T12:00:00Z",
       "language": "English",
       "status": "Published",
       "content": "Post Content"
  }
  ```
- **Response**:
   - **Status Code**: 200 OK
   - **Body**:
     ```json
     {
         "data": {
             "id": 2,
             "title": "Post Title",
              "slug": "post-title",
              "published_at": "2024-03-15T12:00:00Z",
              "language": "English",
              "status": "Published",
              "content": "Post Content"
         },
         "message": "Post created successfully."
     }
     ```
- **Error Responses**:
   - **404 Not Found**: If the specified post does not exist.

## 2. Comments

### 2.1 Create a Comment

- **Endpoint**: `/api/v1/comments/post/{post_id}`
- **Method**: POST
- **Description**: Create a new comment on a specific post.
- **Parameters**:
    - `post_id` (required): The ID of the post to which the comment belongs.
- **Request Body**:
  ```json
  {
      "body": "The content of the comment"
  }

- **Response**:
   - **Status Code**: 200 OK
   - **Body**:
     ```json
     {
         "data": {
            "body": "The content of the comment"
         },
         "message": "Comment created successfully."
     }
     ```