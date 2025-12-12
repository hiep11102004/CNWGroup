<?php
// statistics.php

// Include header and sidebar
include_once '../layouts/header.php';
include_once '../layouts/sidebar.php';

// Fetch statistics data (this is just a placeholder, actual data fetching logic will be implemented)
$totalCourses = 100; // Example data
$totalStudents = 500; // Example data
$totalInstructors = 20; // Example data
$totalEnrollments = 300; // Example data

// Validate data (ensure they are integers)
if (!is_int($totalCourses) || !is_int($totalStudents) || !is_int($totalInstructors) || !is_int($totalEnrollments)) {
    die("Invalid data for statistics.");
}
?>

<div class="container">
    <h1>Statistics Report</h1>
    <div class="statistics">
        <div class="stat-item">
            <h2>Total Courses</h2>
            <p><?php echo $totalCourses; ?></p>
        </div>
        <div class="stat-item">
            <h2>Total Students</h2>
            <p><?php echo $totalStudents; ?></p>
        </div>
        <div class="stat-item">
            <h2>Total Instructors</h2>
            <p><?php echo $totalInstructors; ?></p>
        </div>
        <div class="stat-item">
            <h2>Total Enrollments</h2>
            <p><?php echo $totalEnrollments; ?></p>
        </div>
    </div>
</div>

<style>
.container {
    margin: 20px;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.statistics {
    display: flex;
    flex-wrap: wrap;
}

.stat-item {
    flex: 1;
    min-width: 200px;
    margin: 10px;
    padding: 15px;
    border: 1px solid #007bff;
    border-radius: 5px;
    text-align: center;
}

.stat-item h2 {
    color: #007bff;
}

.stat-item p {
    font-size: 24px;
    font-weight: bold;
}
</style>

<?php
// Include footer
include_once '../layouts/footer.php';
?>