<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
    header('Location: /onlinecourse/views/auth/login.php');
    exit();
}

$uploadError = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['material'];
    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
    
    if (in_array($file['type'], $allowedTypes)) {
        $uploadDir = '../../assets/uploads/materials/';
        $filePath = $uploadDir . basename($file['name']);
        
        if (move_uploaded_file($file['tmp_name'], $filePath)) {
            // Code to save file information to the database can be added here
            header('Location: /onlinecourse/views/instructor/materials/manage.php');
            exit();
        } else {
            $uploadError = 'Failed to upload file.';
        }
    } else {
        $uploadError = 'Invalid file type. Only PDF and Word documents are allowed.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Material</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="file"] {
            margin: 10px 0;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>

<h1>Upload Learning Material</h1>
<?php if ($uploadError): ?>
    <div class="error"><?php echo $uploadError; ?></div>
<?php endif; ?>
<form action="" method="POST" enctype="multipart/form-data">
    <label for="material">Choose file to upload (PDF, DOC, PPT):</label><br>
    <input type="file" name="material" id="material" required><br>
    <input type="submit" value="Upload">
</form>

</body>
</html>