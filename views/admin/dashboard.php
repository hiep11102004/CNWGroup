<?php
// admin/dashboard.php

session_start();

// Check if the user is logged in and has admin role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 2) {
    header("Location: /onlinecourse/views/auth/login.php");
    exit();
}

// Include database connection
require_once '../../config/Database.php';

// Create database connection
$database = new Database();
$db = $database->connect();

// Fetch system statistics (example queries)
$totalUsersQuery = "SELECT COUNT(*) as total FROM users";
$totalCoursesQuery = "SELECT COUNT(*) as total FROM courses";
$totalEnrollmentsQuery = "SELECT COUNT(*) as total FROM enrollments";

$totalUsersStmt = $db->prepare($totalUsersQuery);
$totalUsersStmt->execute();
$totalUsers = $totalUsersStmt->fetch(PDO::FETCH_ASSOC)['total'];

$totalCoursesStmt = $db->prepare($totalCoursesQuery);
$totalCoursesStmt->execute();
$totalCourses = $totalCoursesStmt->fetch(PDO::FETCH_ASSOC)['total'];

$totalEnrollmentsStmt = $db->prepare($totalEnrollmentsQuery);
$totalEnrollmentsStmt->execute();
$totalEnrollments = $totalEnrollmentsStmt->fetch(PDO::FETCH_ASSOC)['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <style>
        /* Inline CSS for dashboard styling */
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
        .stats {
            display: flex;
            justify-content: space-around;
            margin: 20px 0;
        }
        .stat {
            background: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin: 0 10px;
            text-align: center;
        }
        footer {
            text-align: center;
            padding: 10px 0;
            background: #35424a;
            color: #ffffff;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1>Admin Dashboard</h1>
</header>

<div class="container">
    <div class="stats">
        <div class="stat">
            <h2>Total Users</h2>
            <p><?php echo $totalUsers; ?></p>
        </div>
        <div class="stat">
            <h2>Total Courses</h2>
            <p><?php echo $totalCourses; ?></p>
        </div>
        <div class="stat">
            <h2>Total Enrollments</h2>
            <p><?php echo $totalEnrollments; ?></p>
        </div>
    </div>
</div>

<footer>
    <p>&copy; <?php echo date("Y"); ?> Online Course Management System</p>
</footer>

</body>
</html>