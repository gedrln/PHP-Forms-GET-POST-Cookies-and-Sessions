<?php
session_start();

$error = "";
$success = "";

// LOGOUT (GET)
if (isset($_GET["action"]) && $_GET["action"] == "logout") {
    session_destroy();
    header("Location: login.php");
    exit();
}

// SUCCESS MESSAGE FROM SIGNUP (GET)
if (isset($_GET["message"])) {
    $success = "Account created successfully! Please login.";
}

// LOGIN PROCESS (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        $error = "All fields are required.";
    }
    elseif (
        isset($_SESSION["registered_email"]) &&
        $email == $_SESSION["registered_email"] &&
        $password == $_SESSION["registered_password"]
    ) {

        $_SESSION["user"] = $_SESSION["registered_name"];

        // COOKIE (1 hour)
        setcookie("username", $_SESSION["registered_name"], time() + 3600);

        header("Location: dashboard.php");
        exit();
    }
    else {
        $error = "Invalid login credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Sports Event Management - Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
<h2>Sports Event Management System</h2>
<h3>Login</h3>

<?php
if ($success != "") echo "<p class='success'>$success</p>";
if ($error != "") echo "<p class='error'>$error</p>";
?>

<form method="POST">
<input type="text" name="email" placeholder="Email"><br>
<input type="password" name="password" placeholder="Password"><br>
<button type="submit">Login</button>
</form>

<br>
<a href="signup.php">Create New Account</a>

</div>
</body>
</html>