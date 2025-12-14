<?php
// course_progress.php

session_start();
require_once '../../config/Database.php';
require_once '../../models/Enrollment.php';
require_once '../../models/Course.php';

$database = new Database();
$db = $database->connect();

$enrollment = new Enrollment($db);
$course = new Course($db);

if (!isset($_SESSION['user_id'])) {
    header("Location: /onlinecourse/views/auth/login.php");
    exit();
}

$student_id = $_SESSION['user_id'];
$courses = $enrollment->getCoursesByStudent($student_id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Progress</title>
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
            padding: 10px;
            text-align: left;
        }
        th {
            background: #35424a;
            color: #ffffff;
        }
        .progress {
            width: 100%;
            background-color: #f3f3f3;
        }
        .progress-bar {
            height: 20px;
            background-color: #4caf50;
            text-align: center;
            color: white;
        }
    </style>
</head>
<body>

<header>
    <h1>Course Progress</h1>
</header>

<div class="container">
    <h2>Your Enrolled Courses</h2>
    <table>
        <tr>
            <th>Course Title</th>
            <th>Progress</th>
            <th>Status</th>
        </tr>
        <?php foreach ($courses as $course): ?>
            <tr>
                <td><?php echo htmlspecialchars($course['title']); ?></td>
                <td>
                    <div class="progress">
                        <div class="progress-bar" style="width: <?php echo $course['progress']; ?>%;">
                            <?php echo $course['progress']; ?>%
                        </div>
                    </div>
                </td>
                <td><?php echo htmlspecialchars($course['status']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

</body>
</html>