<?php
// File: /onlinecourse/views/admin/users/manage.php

// Include header and sidebar
include_once '../layouts/header.php';
include_once '../layouts/sidebar.php';

// Fetch users from the database (this is just a placeholder, actual fetching logic will be implemented in the controller)
$users = []; // This should be replaced with actual data fetching logic

// Check if there are any users to display
if (empty($users)) {
    echo "<p>No users found.</p>";
} else {
    echo '<h2>Manage Users</h2>';
    echo '<table>';
    echo '<tr><th>ID</th><th>Username</th><th>Email</th><th>Full Name</th><th>Role</th><th>Actions</th></tr>';
    
    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . htmlspecialchars($user['id']) . '</td>';
        echo '<td>' . htmlspecialchars($user['username']) . '</td>';
        echo '<td>' . htmlspecialchars($user['email']) . '</td>';
        echo '<td>' . htmlspecialchars($user['fullname']) . '</td>';
        echo '<td>' . ($user['role'] == 0 ? 'Student' : ($user['role'] == 1 ? 'Instructor' : 'Admin')) . '</td>';
        echo '<td>';
        echo '<a href="edit.php?id=' . htmlspecialchars($user['id']) . '">Edit</a> | ';
        echo '<a href="delete.php?id=' . htmlspecialchars($user['id']) . '" onclick="return confirm(\'Are you sure you want to delete this user?\');">Delete</a>';
        echo '</td>';
        echo '</tr>';
    }
    
    echo '</table>';
}

// Include footer
include_once '../layouts/footer.php';
?>

<style>
/* CSS styles for the manage users page */
table {
    width: 100%;
    border-collapse: collapse;
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

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
</style>