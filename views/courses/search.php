<?php
// search.php

// Include header
include_once '../layouts/header.php';

// Include database connection
include_once '../../config/Database.php';

// Create database connection
$database = new Database();
$db = $database->connect();

// Initialize variables
$searchTerm = '';
$courses = [];

// Check if the search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    if (isset($_POST['search']) && !empty(trim($_POST['search']))) {
        $searchTerm = htmlspecialchars(trim($_POST['search']));

        // Prepare SQL query to search courses
        $query = "SELECT * FROM courses WHERE title LIKE :searchTerm OR description LIKE :searchTerm";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
        $stmt->execute();

        // Fetch results
        $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $error = "Please enter a search term.";
    }
}
?>

<div class="container">
    <h2>Search Courses</h2>
    <form method="POST" action="">
        <input type="text" name="search" value="<?php echo $searchTerm; ?>" placeholder="Search for courses..." required>
        <button type="submit">Search</button>
    </form>

    <?php if (isset($error)): ?>
        <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <?php if (!empty($courses)): ?>
        <h3>Search Results:</h3>
        <ul>
            <?php foreach ($courses as $course): ?>
                <li>
                    <a href="detail.php?id=<?php echo $course['id']; ?>"><?php echo htmlspecialchars($course['title']); ?></a>
                    <p><?php echo htmlspecialchars($course['description']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No courses found.</p>
    <?php endif; ?>
</div>

<style>
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

h2 {
    text-align: center;
}

form {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

input[type="text"] {
    width: 70%;
    padding: 10px;
    margin-right: 10px;
}

button {
    padding: 10px 15px;
}

.error {
    color: red;
    text-align: center;
}

ul {
    list-style-type: none;
    padding: 0;
}

li {
    margin-bottom: 15px;
}

li a {
    font-weight: bold;
    text-decoration: none;
}

li p {
    margin: 5px 0 0;
}
</style>

<?php
// Include footer
include_once '../layouts/footer.php';
?>