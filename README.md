<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About the Project

 - This project is a Partial Reqirement for Applications Development 2.
 - The Project is built on Laravel 10.
 - The project is To-Do-List App.
 - It has three  main tables [Users], [Tasks], and [Categories].
 - The project is a REST API with Laravel Sanctum.

## HTTP Requests

 1. Users  
    - POST | Register User => api/register
    ```bash
     user {
        "first_name": "string",
        "last_name" :"string",
        "email" : "string",
        "password" : "string"
     }
    ```
    - POST | Login => api/login
    ```bash
    user {
        "email" : "string",
        "password" : "string"
    }
    ```
    - POST | Logout => api/logout


 2. Tasks
    - GET | Retrieve all tasks => api/tasks
    - GET | Retrive a Single tasks => api/tasks/:id
    - POST | Create Task => api/tasks
   ```bash
    task {
        "title" : "string",
        "description" : "string",
        "due_date" : "string"
    }
   
   ```

    - PUT | Update a single Task => api/tasks/:id

    ```bash
    task {
        "title" : "string",
        "description" : "string",
        "due_date" : "string"
    }
   ```

     - PATCH | Updates a single Field on TASK => api/tasks/:id

     ```bash
      task {
        "title" : "string | optional",
        "description" : "string | optional",
        "due_date" : "string |optional"
    }
     ```

   3. Categories
     
      - GET | Retrieve all categories => api/categories
      - GET | Retrieve a single record => api/categories/:id
      - POST | Create a single category => api/categories

     ```bash 
     category {
        "name" : "string"
     }

     ```

      - PUT | update a category => api/categories/:id
     ```bash 
     category {
        "name" : "string"
     }

     ``` 


