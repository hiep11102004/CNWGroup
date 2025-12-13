<?php
// views/home/index.php

// Include header
include_once '../layouts/header.php';

// Sample data for courses (this would typically come from a database)
$courses = [
    [
        'id' => 1,
        'title' => 'Introduction to PHP',
        'description' => 'Learn the basics of PHP programming.',
        'image' => 'path/to/image1.jpg',
        'price' => 49.99,
    ],
    [
        'id' => 2,
        'title' => 'Advanced JavaScript',
        'description' => 'Deep dive into JavaScript and its frameworks.',
        'image' => 'path/to/image2.jpg',
        'price' => 59.99,
    ],
    [
        'id' => 3,
        'title' => 'Web Development Bootcamp',
        'description' => 'Become a full-stack web developer in 12 weeks.',
        'image' => 'path/to/image3.jpg',
        'price' => 199.99,
    ],
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Course Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
        }
        header {
            background: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        .course {
            border: 1px solid #ccc;
            border-radius: 5px;
            margin: 20px 0;
            padding: 10px;
            display: flex;
            align-items: center;
        }
        .course img {
            max-width: 150px;
            margin-right: 20px;
        }
        .course h3 {
            margin: 0;
        }
        .course p {
            margin: 5px 0;
        }
        .course .price {
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>

<header>
    <h1>Welcome to Online Course Platform</h1>
</header>

<div class="container">
    <h2>Available Courses</h2>
    <?php foreach ($courses as $course): ?>
        <div class="course">
            <img src="<?php echo $course['image']; ?>" alt="<?php echo $course['title']; ?>">
            <div>
                <h3><?php echo $course['title']; ?></h3>
                <p><?php echo $course['description']; ?></p>
                <p class="price">$<?php echo number_format($course['price'], 2); ?></p>
                <a href="courses/detail.php?id=<?php echo $course['id']; ?>">View Details</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php
// Include footer
include_once '../layouts/footer.php';
?>