<?php
// views/instructor/lessons/create.php

// Include header and sidebar
include_once '../layouts/header.php';
include_once '../layouts/sidebar.php';

// Initialize variables for form data and error messages
$title = $content = $video_url = '';
$errors = [];

// Form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate title
    if (empty(trim($_POST["title"]))) {
        $errors['title'] = "Title is required.";
    } else {
        $title = trim($_POST["title"]);
    }

    // Validate content
    if (empty(trim($_POST["content"]))) {
        $errors['content'] = "Content is required.";
    } else {
        $content = trim($_POST["content"]);
    }

    // Validate video URL
    if (empty(trim($_POST["video_url"]))) {
        $errors['video_url'] = "Video URL is required.";
    } else {
        $video_url = trim($_POST["video_url"]);
    }

    // If no errors, proceed with saving the lesson (database logic goes here)
    if (empty($errors)) {
        // Database insertion logic would go here
        // Redirect or show success message
    }
}
?>

<div class="container">
    <h2>Create New Lesson</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="title">Lesson Title:</label>
            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($title); ?>">
            <?php if (isset($errors['title'])): ?>
                <div class="text-danger"><?php echo $errors['title']; ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="content">Lesson Content:</label>
            <textarea name="content" class="form-control"><?php echo htmlspecialchars($content); ?></textarea>
            <?php if (isset($errors['content'])): ?>
                <div class="text-danger"><?php echo $errors['content']; ?></div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="video_url">Video URL:</label>
            <input type="text" name="video_url" class="form-control" value="<?php echo htmlspecialchars($video_url); ?>">
            <?php if (isset($errors['video_url'])): ?>
                <div class="text-danger"><?php echo $errors['video_url']; ?></div>
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Create Lesson</button>
    </form>
</div>

<?php
// Include footer
include_once '../layouts/footer.php';
?>