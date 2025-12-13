<?php
// Check if the user is logged in and has the instructor role
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
    header("Location: /onlinecourse/views/auth/login.php");
    exit();
}

// Include database connection
require_once '../../config/Database.php';
$db = new Database();
$conn = $db->connect();

// Initialize variables
$title = $description = $category_id = $price = $duration_weeks = $level = "";
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category_id = trim($_POST['category_id']);
    $price = trim($_POST['price']);
    $duration_weeks = trim($_POST['duration_weeks']);
    $level = trim($_POST['level']);

    // Validate inputs
    if (empty($title)) {
        $errors[] = "Title is required.";
    }
    if (empty($description)) {
        $errors[] = "Description is required.";
    }
    if (empty($category_id)) {
        $errors[] = "Category is required.";
    }
    if (empty($price) || !is_numeric($price)) {
        $errors[] = "Valid price is required.";
    }
    if (empty($duration_weeks) || !is_numeric($duration_weeks)) {
        $errors[] = "Valid duration in weeks is required.";
    }
    if (empty($level)) {
        $errors[] = "Level is required.";
    }

    // If no errors, insert course into database
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO courses (title, description, instructor_id, category_id, price, duration_weeks, level, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$title, $description, $_SESSION['user_id'], $category_id, $price, $duration_weeks, $level]);
        header("Location: /onlinecourse/views/instructor/course/manage.php");
        exit();
    }
}

// Fetch categories for dropdown
$categories = $conn->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .error {
            color: red;
        }
        form {
            max-width: 600px;
            margin: auto;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<h2>Create New Course</h2>

<?php
if (!empty($errors)) {
    echo '<div class="error">' . implode('<br>', $errors) . '</div>';
}
?>

<form action="" method="POST">
    <label for="title">Course Title:</label>
    <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($title); ?>" required>

    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($description); ?></textarea>

    <label for="category_id">Category:</label>
    <select id="category_id" name="category_id" required>
        <option value="">Select a category</option>
        <?php foreach ($categories as $category): ?>
            <option value="<?php echo $category['id']; ?>" <?php echo ($category['id'] == $category_id) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($category['name']); ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="price">Price:</label>
    <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($price); ?>" required>

    <label for="duration_weeks">Duration (weeks):</label>
    <input type="number" id="duration_weeks" name="duration_weeks" value="<?php echo htmlspecialchars($duration_weeks); ?>" required>

    <label for="level">Level:</label>
    <select id="level" name="level" required>
        <option value="">Select level</option>
        <option value="Beginner" <?php echo ($level == 'Beginner') ? 'selected' : ''; ?>>Beginner</option>
        <option value="Intermediate" <?php echo ($level == 'Intermediate') ? 'selected' : ''; ?>>Intermediate</option>
        <option value="Advanced" <?php echo ($level == 'Advanced') ? 'selected' : ''; ?>>Advanced</option>
    </select>

    <button type="submit">Create Course</button>
</form>

</body>
</html>