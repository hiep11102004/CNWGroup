<?php
session_start();
require_once '../../config/Database.php';
require_once '../../models/User.php';
require_once '../../models/Enrollment.php';
require_once '../../models/Course.php';

$database = new Database();
$db = $database->connect();

$user = new User($db);
$enrollment = new Enrollment($db);
$course = new Course($db);

if (!isset($_SESSION['user_id'])) {
    header("Location: /onlinecourse/views/auth/login.php");
    exit();
}

$user->id = $_SESSION['user_id'];
$userData = $user->getUserById();

$enrolledCourses = $enrollment->getEnrolledCourses($user->id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="/onlinecourse/assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #35424a;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }
        h1 {
            margin: 0;
        }
        .course-list {
            margin: 20px 0;
            padding: 20px;
            background: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .course-item {
            padding: 10px;
            border-bottom: 1px solid #dddddd;
        }
        .course-item:last-child {
            border-bottom: none;
        }
        .course-title {
            font-size: 18px;
            font-weight: bold;
        }
        .course-progress {
            color: #888;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome, <?php echo htmlspecialchars($userData['fullname']); ?></h1>
</header>

<div class="container">
    <div class="course-list">
        <h2>Your Enrolled Courses</h2>
        <?php if (count($enrolledCourses) > 0): ?>
            <?php foreach ($enrolledCourses as $course): ?>
                <div class="course-item">
                    <div class="course-title"><?php echo htmlspecialchars($course['title']); ?></div>
                    <div class="course-progress">Progress: <?php echo htmlspecialchars($course['progress']); ?>%</div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You are not enrolled in any courses.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>