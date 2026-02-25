<?php
session_start();

$name = $email = $password = $confirm = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm = trim($_POST["confirm"]);

    // VALIDATIONS
    if (empty($name) || empty($email) || empty($password) || empty($confirm)) {
        $error = "All fields are required.";
    }
    elseif (strlen($name) < 3) {
        $error = "Name must be at least 3 characters.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    }
    elseif ($password != $confirm) {
        $error = "Passwords do not match.";
    }
    else {
        $_SESSION["registered_name"] = $name;
        $_SESSION["registered_email"] = $email;
        $_SESSION["registered_password"] = $password;

        header("Location: login.php?message=registered");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Sports Event Management - Signup</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
<h2>Sports Event Management System</h2>
<h3>Signup</h3>

<?php if ($error != "") echo "<p class='error'>$error</p>"; ?>

<form method="POST">
<input type="text" name="name" placeholder="Full Name"><br>
<input type="text" name="email" placeholder="Email"><br>
<input type="password" name="password" placeholder="Password"><br>
<input type="password" name="confirm" placeholder="Confirm Password"><br>
<button type="submit">Create Account</button>
</form>

<br>
<a href="login.php">Already registered? Login here</a>

</div>
</body>
</html>