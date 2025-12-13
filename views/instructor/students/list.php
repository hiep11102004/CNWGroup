<?php
// Fetch the list of students enrolled in the instructor's courses
// Assuming $students is an array of student data retrieved from the database
$students = []; // This should be populated with actual data from the database

// Validate if there are students to display
if (empty($students)) {
    echo "<p>No students enrolled in your courses.</p>";
} else {
    echo '<h2>Students List</h2>';
    echo '<table>';
    echo '<thead>';
    echo '<tr>';
    echo '<th>ID</th>';
    echo '<th>Full Name</th>';
    echo '<th>Email</th>';
    echo '<th>Enrollment Date</th>';
    echo '<th>Progress</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    foreach ($students as $student) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($student['id']) . '</td>';
        echo '<td>' . htmlspecialchars($student['fullname']) . '</td>';
        echo '<td>' . htmlspecialchars($student['email']) . '</td>';
        echo '<td>' . htmlspecialchars($student['enrolled_date']) . '</td>';
        echo '<td>' . htmlspecialchars($student['progress']) . '%</td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
}
?>

<style>
    h2 {
        font-size: 24px;
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #f1f1f1;
    }
</style>