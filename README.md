# Laravel Task Management API

## Overview
This project is a simple Task Management API built with Laravel 10+ that supports basic CRUD operations.

## API Endpoints
- **Create Task**: `POST /api/tasks`
- **Read All Tasks**: `GET /api/tasks`
- **Read Single Task**: `GET /api/tasks/{id}`
- **Update Task**: `PUT /api/tasks/{id}`
- **Delete Task**: `DELETE /api/tasks/{id}`

## Requirements
- Data validation for creating/updating tasks.
- Proper error handling and status codes.
- Status field limited to: `pending`, `in-progress`, `completed`.

## Repository
[GitHub Repository](https://github.com/codewarrior4/task-api.git)

## Postman Documentation
[Postman Documentation](https://documenter.getpostman.com/view/27882791/2sAXxMeYG8)

## Installation
1. Clone the repository: `git clone https://github.com/codewarrior4/task-api.git`
2. Navigate to the project directory: `cd your-repo`
3. Install dependencies: `composer update`
4. Set up your `.env` file and database.
5. Run migrations: `php artisan migrate`
6. Start the server: `php artisan serve`

## Evaluation Criteria
- Code Quality
- Functionality
- Security and scalability considerations
