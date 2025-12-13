<?php
// Include header and sidebar
include_once '../layouts/header.php';
include_once '../layouts/sidebar.php';

// Fetch lessons for the specific course
$course_id = $_GET['course_id'] ?? null;
$lessons = []; // Fetch lessons from the database based on course_id

// Validate course_id
if ($course_id === null) {
    echo "<p>Invalid course ID.</p>";
    exit;
}

// Assume we have a function to get lessons by course ID
// $lessons = Lesson::getLessonsByCourseId($course_id);
?>

<div class="container">
    <h2>Manage Lessons for Course ID: <?php echo htmlspecialchars($course_id); ?></h2>
    
    <a href="create.php?course_id=<?php echo htmlspecialchars($course_id); ?>" class="btn btn-primary">Add New Lesson</a>
    
    <?php if (empty($lessons)): ?>
        <p>No lessons found for this course.</p>
    <?php else: ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lessons as $lesson): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($lesson['title']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo htmlspecialchars($lesson['id']); ?>&course_id=<?php echo htmlspecialchars($course_id); ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo htmlspecialchars($lesson['id']); ?>&course_id=<?php echo htmlspecialchars($course_id); ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this lesson?');">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
// Include footer
include_once '../layouts/footer.php';
?>