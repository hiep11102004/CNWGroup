<?php


session_start();
$user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;

?>

<div class="sidebar">
    <h2>Navigation</h2>
    <ul>
        <li><a href="/onlinecourse/views/home/index.php">Home</a></li>
        <?php if ($user_role == 0): // Student ?>
            <li><a href="/onlinecourse/views/student/dashboard.php">Dashboard</a></li>
            <li><a href="/onlinecourse/views/student/my_courses.php">My Courses</a></li>
            <li><a href="/onlinecourse/views/student/course_progress.php">Course Progress</a></li>
        <?php elseif ($user_role == 1): // Instructor ?>
            <li><a href="/onlinecourse/views/instructor/dashboard.php">Instructor Dashboard</a></li>
            <li><a href="/onlinecourse/views/instructor/my_courses.php">My Courses</a></li>
            <li><a href="/onlinecourse/views/instructor/course/create.php">Create Course</a></li>
            <li><a href="/onlinecourse/views/instructor/students/list.php">Student List</a></li>
        <?php elseif ($user_role == 2): // Admin ?>
            <li><a href="/onlinecourse/views/admin/dashboard.php">Admin Dashboard</a></li>
            <li><a href="/onlinecourse/views/admin/users/manage.php">Manage Users</a></li>
            <li><a href="/onlinecourse/views/admin/categories/list.php">Manage Categories</a></li>
            <li><a href="/onlinecourse/views/admin/reports/statistics.php">Statistics</a></li>
        <?php endif; ?>
        <li><a href="/onlinecourse/views/auth/logout.php">Logout</a></li>
    </ul>
</div>

<style>
.sidebar {
    width: 250px;
    background-color: #f4f4f4;
    padding: 15px;
    border-right: 1px solid #ccc;
}

.sidebar h2 {
    font-size: 18px;
    margin-bottom: 15px;
}

.sidebar ul {
    list-style-type: none;
    padding: 0;
}

.sidebar ul li {
    margin: 10px 0;
}

.sidebar ul li a {
    text-decoration: none;
    color: #333;
}

.sidebar ul li a:hover {
    text-decoration: underline;
}
</style>