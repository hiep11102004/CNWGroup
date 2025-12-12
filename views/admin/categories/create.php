<?php
// views/admin/categories/create.php

// Include header and sidebar
include_once '../layouts/header.php';
include_once '../layouts/sidebar.php';

// Initialize variables
$name = "";
$description = "";
$errors = [];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate category name
    if (empty(trim($_POST["name"]))) {
        $errors[] = "Category name is required.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate category description
    if (empty(trim($_POST["description"]))) {
        $errors[] = "Category description is required.";
    } else {
        $description = trim($_POST["description"]);
    }

    // If no errors, proceed to save the category (pseudo code)
    if (empty($errors)) {
        // Save category to database
        // $categoryModel->create($name, $description);
        header("Location: list.php"); // Redirect to category list after creation
        exit;
    }
}
?>

<div class="container">
    <h2>Create New Category</h2>

    <?php
    // Display errors if any
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo '<p>' . htmlspecialchars($error) . '</p>';
        }
        echo '</div>';
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="name">Category Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" required><?php echo htmlspecialchars($description); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Create Category</button>
    </form>
</div>

<?php
// Include footer
include_once '../layouts/footer.php';
?>