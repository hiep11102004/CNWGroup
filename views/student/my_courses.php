<?php
// my_courses.php

session_start();
require_once '../../config/Database.php';
require_once '../../models/Enrollment.php';
require_once '../../models/Course.php';

$database = new Database();
$db = $database->connect();

$enrollment = new Enrollment($db);
$courses = $enrollment->getCoursesByStudentId($_SESSION['user_id']);

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
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #dddddd;
            text-align: left;
        }
        th {
            background: #35424a;
            color: #ffffff;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
    </style>
</head>
<body>

<header>
    <h1>My Enrolled Courses</h1>
</header>

<div class="container">
    <?php if (empty($courses)): ?>
        <p>You are not enrolled in any courses.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>Course Title</th>
                <th>Description</th>
                <th>Status</th>
                <th>Progress</th>
            </tr>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><?php echo htmlspecialchars($course['title']); ?></td>
                    <td><?php echo htmlspecialchars($course['description']); ?></td>
                    <td><?php echo htmlspecialchars($course['status']); ?></td>
                    <td><?php echo htmlspecialchars($course['progress']) . '%'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>

</body>
</html>