<?php
// views/instructor/lessons/edit.php

// Include header and sidebar
include_once '../layouts/header.php';
include_once '../layouts/sidebar.php';

// Assume we have a lesson object to edit
$lesson = [
    'id' => 1,
    'title' => 'Introduction to PHP',
    'content' => 'This lesson covers the basics of PHP programming.',
    'video_url' => 'https://example.com/video.mp4',
    'order' => 1
];

// Validate form submission
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $video_url = trim($_POST['video_url']);
    $order = (int)$_POST['order'];

    if (empty($title)) {
        $errors['title'] = 'Title is required.';
    }
    if (empty($content)) {
        $errors['content'] = 'Content is required.';
    }
    if (empty($video_url)) {
        $errors['video_url'] = 'Video URL is required.';
    }
    if ($order < 1) {
        $errors['order'] = 'Order must be a positive integer.';
    }

    // If no errors, proceed to update the lesson in the database
    if (empty($errors)) {
        // Code to update the lesson in the database goes here
        // Redirect or show success message
    }
}
?>

<div class="container">
    <h2>Edit Lesson</h2>
    <form method="POST" action="">
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($lesson['title']); ?>">
            <?php if (isset($errors['title'])): ?>
                <span class="error"><?php echo $errors['title']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content"><?php echo htmlspecialchars($lesson['content']); ?></textarea>
            <?php if (isset($errors['content'])): ?>
                <span class="error"><?php echo $errors['content']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="video_url">Video URL:</label>
            <input type="text" id="video_url" name="video_url" value="<?php echo htmlspecialchars($lesson['video_url']); ?>">
            <?php if (isset($errors['video_url'])): ?>
                <span class="error"><?php echo $errors['video_url']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <label for="order">Order:</label>
            <input type="number" id="order" name="order" value="<?php echo htmlspecialchars($lesson['order']); ?>">
            <?php if (isset($errors['order'])): ?>
                <span class="error"><?php echo $errors['order']; ?></span>
            <?php endif; ?>
        </div>
        <div>
            <button type="submit">Update Lesson</button>
        </div>
    </form>
</div>

<?php include_once '../layouts/footer.php'; ?>