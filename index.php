<?php
require_once '../config/Database.php';
require_once '../controllers/HomeController.php';
require_once '../controllers/AuthController.php';
require_once '../controllers/CourseController.php';
require_once '../controllers/EnrollmentController.php';
require_once '../controllers/LessonController.php';
require_once '../controllers/AdminController.php';

$database = new Database();
$db = $database->connect();


$homeController = new HomeController($db);
$authController = new AuthController($db);
$courseController = new CourseController($db);
$enrollmentController = new EnrollmentController($db);
$lessonController = new LessonController($db);
$adminController = new AdminController($db);


$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri === '/' || $requestUri === '/home') {
    $homeController->index();
} elseif ($requestUri === '/login' && $requestMethod === 'GET') {
    $authController->login();
} elseif ($requestUri === '/register' && $requestMethod === 'GET') {
    $authController->register();
} elseif (strpos($requestUri, '/courses') === 0) {
    if ($requestMethod === 'GET') {
        $courseController->index();
    } elseif ($requestMethod === 'POST' && $requestUri === '/courses/enroll') {
        $enrollmentController->enroll();
    }
} elseif (strpos($requestUri, '/admin') === 0) {
    $adminController->dashboard();
} else {
    http_response_code(404);
    echo '404 Not Found';
}
?>