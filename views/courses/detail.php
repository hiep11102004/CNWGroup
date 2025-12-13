<?php
// detail.php - Course Detail View

// Assuming $course is an associative array containing course details
// and $instructor is an associative array containing instructor details
// and $enrollmentStatus is a string indicating enrollment status

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($course['title']); ?> - Course Detail</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #333;
        }
        .course-info {
            margin-bottom: 20px;
        }
        .course-info p {
            line-height: 1.6;
        }
        .enroll-button {
            display: inline-block;
            padding: 10px 20px;
            background: #5cb85c;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .enroll-button.disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<div class="container">
    <h1><?php echo htmlspecialchars($course['title']); ?></h1>
    <div class="course-info">
        <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
        <p><strong>Instructor:</strong> <?php echo htmlspecialchars($instructor['fullname']); ?></p>
        <p><strong>Price:</strong> $<?php echo number_format($course['price'], 2); ?></p>
        <p><strong>Duration:</strong> <?php echo htmlspecialchars($course['duration_weeks']); ?> weeks</p>
        <p><strong>Level:</strong> <?php echo htmlspecialchars($course['level']); ?></p>
    </div>

    <?php if ($enrollmentStatus === 'not_enrolled'): ?>
        <a href="enroll.php?course_id=<?php echo $course['id']; ?>" class="enroll-button">Enroll Now</a>
    <?php else: ?>
        <a href="#" class="enroll-button disabled">Already Enrolled</a>
    <?php endif; ?>
</div>

</body>
</html>