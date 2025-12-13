<?php
// edit.php - Form to edit an existing course

// Assuming you have a Course model and a method to get course details by ID
require_once '../../../models/Course.php';

$courseId = $_GET['id'] ?? null;
$course = null;

if ($courseId) {
    $courseModel;
    $course = $courseModel->getCourseById($courseId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate input
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $price = trim($_POST['price']);
    $duration_weeks = trim($_POST['duration_weeks']);
    $level = trim($_POST['level']);
    
    $errors = [];

    if (empty($title)) {
        $errors[] = "Title is required.";
    }
    if (empty($description)) {
        $errors[] = "Description is required.";
    }
    if (!is_numeric($price) || $price < 0) {
        $errors[] = "Price must be a positive number.";
    }
    if (!is_numeric($duration_weeks) || $duration_weeks < 1) {
        $errors[] = "Duration must be a positive integer.";
    }
    if (!in_array($level, ['Beginner', 'Intermediate', 'Advanced'])) {
        $errors[] = "Level must be one of: Beginner, Intermediate, Advanced.";
    }

    if (empty($errors)) {
        // Update course logic here
        $courseModel->updateCourse($courseId, $title, $description, $price, $duration_weeks, $level);
        header("Location: manage.php?success=Course updated successfully");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .error {
            color: red;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="number"], textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            padding: 10px 15px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Edit Course</h1>

<?php if (!empty($errors)): ?>
    <div class="error">
        <?php foreach ($errors as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="" method="POST">
    <div class="form-group">
        <label for="title">Course Title</label>
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($course->title ?? ''); ?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" required><?php echo htmlspecialchars($course->description ?? ''); ?></textarea>
    </div>
    <div class="form-group">
        <label for="price">Price</label>
        <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($course->price ?? ''); ?>" required>
    </div>
    <div class="form-group">
        <label for="duration_weeks">Duration (weeks)</label>
        <input type="number" id="duration_weeks" name="duration_weeks" value="<?php echo htmlspecialchars($course->duration_weeks ?? ''); ?>" required>
    </div>
    <div class="form-group">
        <label for="level">Level</label>
        <select id="level" name="level" required>
            <option value="Beginner" <?php echo (isset($course) && $course->level === 'Beginner') ? 'selected' : ''; ?>>Beginner</option>
            <option value="Intermediate" <?php echo (isset($course) && $course->level === 'Intermediate') ? 'selected' : ''; ?>>Intermediate</option>
            <option value="Advanced" <?php echo (isset($course) && $course->level === 'Advanced') ? 'selected' : ''; ?>>Advanced</option>
        </select>
    </div>
    <input type="submit" value="Update Course">
</form>

</body>
</html>