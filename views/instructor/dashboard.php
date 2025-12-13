<?php
session_start();
require_once '../../config/Database.php';
require_once '../../models/User.php';
require_once '../../models/Course.php';
require_once '../../models/Enrollment.php';

$database = new Database();
$db = $database->connect();

$user;
$courses = new Course($db);
$enrollment = new Enrollment($db);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: /onlinecourse/views/auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$instructor_courses = $courses->getCoursesByInstructor($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard</title>
    <link rel="stylesheet" href="/onlinecourse/assets/css/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        h1 {
            margin: 0;
        }
        .course-list {
            margin: 20px 0;
        }
        .course {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }
        .course h2 {
            margin: 0;
        }
        .course a {
            text-decoration: none;
            color: #007BFF;
        }
        .course a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <h1>Instructor Dashboard</h1>
    </header>
    <div class="container">
        <h2>Your Courses</h2>
        <div class="course-list">
            <?php if (empty($instructor_courses)): ?>
                <p>You have not created any courses yet.</p>
            <?php else: ?>
                <?php foreach ($instructor_courses as $course): ?>
                    <div class="course">
                        <h2><?php echo htmlspecialchars($course['title']); ?></h2>
                        <p><?php echo htmlspecialchars($course['description']); ?></p>
                        <a href="/onlinecourse/views/instructor/course/manage.php?course_id=<?php echo $course['id']; ?>">Manage Course</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <a href="/onlinecourse/views/instructor/course/create.php">Create New Course</a>
    </div>
</body>
</html>