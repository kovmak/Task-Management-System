# Task management system

## Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Usage](#usage)
- [License](#license)

## Overview
This project is a PHP-based Task Management System designed to streamline task organization. It enables users to register, log in, and manage tasks effectively. Users can create, edit, delete, and assign tasks to others. Built on a straightforward PHP architecture, it includes HTML views for user interaction.

### Features
- **User Authentication**: Register, log in, and manage user sessions.
- **Task Management**: Create, view, update, and delete tasks.
- **Task Assignment**: Assign tasks to other users for collaboration.
- **Task Overview**: View task lists and detailed task information.
- **Password Management**: Change passwords securely.

## Usage
1. **Setup and Deployment**:
    - Clone the repository to your system.
    - Ensure PHP 8.3+ is installed.
    - Run `composer install` to install dependencies.
    - Set up a database (e.g., MySQL or PostgreSQL) for storing user and task data.
    - Update database configuration in the `src/Database/Database.php` file.
    - Launch the application using a web server (e.g., Apache, Nginx, or PHP's built-in server).

2. **Access the Application**:
    - Access the app via `http://localhost:8000` or the configured local address.

3. **Interacting with the Application**:
    - **GET** `/register`: Access the registration form.
    - **POST** `/register`: Register a new account.
    - **GET** `/login`: Access the login page.
    - **POST** `/login`: Log in with your credentials.
    - **GET** `/tasks`: View your task list.
    - **POST** `/tasks`: Add a new task.
    - **GET** `/tasks/{id}`: View task details by ID.
    - **PUT** `/tasks/{id}`: Edit an existing task.
    - **DELETE** `/tasks/{id}`: Delete a task.
    - **GET** `/change-password`: Access the password change form.
    - **POST** `/change-password`: Update your password.

## License
This project is licensed under the MIT License. For details, see the [LICENSE](LICENSE) file.