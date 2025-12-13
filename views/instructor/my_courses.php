<?php
// my_courses.php

session_start();
require_once '../../config/Database.php';
require_once '../../models/Course.php';
require_once '../../models/User.php';

$database = new Database();
$db = $database->connect();

$user;
$course = new Course($db);

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: /onlinecourse/views/auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$courses = $course->getCoursesByInstructor($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
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
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #dddddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #35424a;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .btn {
            background-color: #35424a;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<header>
    <h1>My Courses</h1>
</header>

<div class="container">
    <table>
        <tr>
            <th>Course Title</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
        <?php if ($courses): ?>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?php echo htmlspecialchars($course['title']); ?></td>
                    <td><?php echo htmlspecialchars($course['description']); ?></td>
                    <td>
                        <a href="course/edit.php?id=<?php echo $course['id']; ?>" class="btn">Edit</a>
                        <a href="course/manage.php?id=<?php echo $course['id']; ?>" class="btn">Manage Lessons</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No courses found.</td>
            </tr>
        <?php endif; ?>
    </table>
</div>

</body>
</html>