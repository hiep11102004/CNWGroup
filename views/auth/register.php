<?php

session_start();


include_once '../layouts/header.php';


$username = $email = $password = $fullname = "";
$errors = [];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    if (empty(trim($_POST["username"]))) {
        $errors[] = "Username is required.";
    } else {
        $username = trim($_POST["username"]);
    }

   
    if (empty(trim($_POST["email"]))) {
        $errors[] = "Email is required.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        $email = trim($_POST["email"]);
    }


    if (empty(trim($_POST["password"]))) {
        $errors[] = "Password is required.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }


    if (empty(trim($_POST["fullname"]))) {
        $errors[] = "Full name is required.";
    } else {
        $fullname = trim($_POST["fullname"]);
    }

    if (empty($errors)) {
    }
}
?>

<div class="container">
    <h2>Register</h2>
    <?php

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
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($username); ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($fullname); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>

<?php

include_once '../layouts/footer.php';
?>