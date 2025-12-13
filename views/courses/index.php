<?php
// Include the header
include_once '../layouts/header.php';

// Fetch courses from the database (this is a placeholder, implement your own logic)
$courses = [
    ['id' => 1, 'title' => 'Course 1', 'description' => 'Description for Course 1', 'price' => 100, 'level' => 'Beginner'],
    ['id' => 2, 'title' => 'Course 2', 'description' => 'Description for Course 2', 'price' => 150, 'level' => 'Intermediate'],
    // Add more courses as needed
];

// Handle search and filter (this is a placeholder, implement your own logic)
$search = isset($_POST['search']) ? $_POST['search'] : '';
$filteredCourses = array_filter($courses, function($course) use ($search) {
    return stripos($course['title'], $search) !== false;
});
?>

<div class="container">
    <h1>Available Courses</h1>
    
    <form method="POST" action="">
        <input type="text" name="search" placeholder="Search courses..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>

    <div class="course-list">
        <?php if (empty($filteredCourses)): ?>
            <p>No courses found.</p>
        <?php else: ?>
            <ul>
                <?php foreach ($filteredCourses as $course): ?>
                    <li>
                        <h2><?php echo htmlspecialchars($course['title']); ?></h2>
                        <p><?php echo htmlspecialchars($course['description']); ?></p>
                        <p>Price: $<?php echo htmlspecialchars($course['price']); ?></p>
                        <p>Level: <?php echo htmlspecialchars($course['level']); ?></p>
                        <a href="detail.php?id=<?php echo $course['id']; ?>">View Details</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>

<?php
// Include the footer
include_once '../layouts/footer.php';
?>

<style>
.container {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
}

h1 {
    text-align: center;
}

.course-list {
    margin-top: 20px;
}

.course-list ul {
    list-style-type: none;
    padding: 0;
}

.course-list li {
    border: 1px solid #ccc;
    padding: 15px;
    margin-bottom: 10px;
}

.course-list h2 {
    margin: 0;
}

form {
    text-align: center;
    margin-bottom: 20px;
}

input[type="text"] {
    padding: 10px;
    width: 300px;
}

button {
    padding: 10px 15px;
}
</style>