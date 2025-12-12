<?php
// edit.php - View for editing a course category

// Assuming you have a variable $category that contains the category data to be edited
// and a variable $errors for validation errors if any.

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h2 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background: #5cb85c;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background: #4cae4c;
        }
        .error {
            color: red;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<h2>Edit Category</h2>

<?php if (!empty($errors)): ?>
    <div class="error">
        <?php foreach ($errors as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form action="path_to_your_update_logic.php" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($category['id']); ?>">
    
    <label for="name">Category Name:</label>
    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
    
    <label for="description">Description:</label>
    <textarea id="description" name="description" rows="4" required><?php echo htmlspecialchars($category['description']); ?></textarea>
    
    <input type="submit" value="Update Category">
</form>

</body>
</html>