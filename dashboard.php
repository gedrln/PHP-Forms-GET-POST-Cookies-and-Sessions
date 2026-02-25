<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["user"];
?>

<!DOCTYPE html>
<html>
<head>
<title>Sports Event Dashboard</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="box">
<h2>Sports Event Dashboard</h2>

<p>Welcome, <strong><?php echo $username; ?></strong>!</p>

<p>You can manage:</p>

<ul>
    <li>🏅 Register Athletes</li>
    <li>📅 View Event Schedule</li>
    <li>🏆 Manage Teams</li>
    <li>📊 View Match Results</li>
</ul>

<?php
if (isset($_COOKIE["username"])) {
    echo "<p><strong>Remembered User (Cookie):</strong> " . $_COOKIE["username"] . "</p>";
}
?>


<br>
<a href="login.php?action=logout">Logout</a>

</div>
</body>
</html>