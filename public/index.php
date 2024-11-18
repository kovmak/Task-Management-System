<?php
declare(strict_types=1);

use App\Core\Router;

require_once '../vendor/autoload.php';

$router = new Router();

$router->setNotFoundHandler(function () {
    echo '404 - Page not found';
});

$router->get('/register', function () {
    include '../src/views/register.php';
});

$router->post('/register', function () {
    echo 'Registering user...';
});

$router->get('/login', function () {
    include '../src/views/login.php';
});

$router->post('/login', function () {
    echo 'Logging in...';
});

$router->get('/change-password', function () {
    include '../src/views/change-password.php';
});

$router->post('/change-password', function () {
    echo 'Changing password...';
});

$router->get('/tasks', function () {
    $tasks = [
        ['id' => 1, 'title' => 'Task 1', 'description' => 'Description 1', 'status' => 'In Progress', 'assigned_to_id' => 2],
    ];
    include '../src/views/tasks.php';
});

$router->post('/task/create', function () {
    echo 'Creating task...';
});

$router->get('/tasks/edit/{id}', function ($id) {
    echo 'Editing task with ID: ' . $id;
});

$router->get('/tasks/delete/{id}', function ($id) {
    echo 'Deleting task with ID: ' . $id;
});

$router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
