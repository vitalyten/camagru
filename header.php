<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
    <title>camagru</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<header class="main-header">
<a href="index.php"><h1>camagru</h1></a>
<nav>
<ul>
<?php
if ($_SESSION["loggued_on_user"]) {
?>
	<a href="myacc.php"><li>MY ACCOUNT</li></a>
	<a href="logout.php"><li class="fa fa-sign-out" aria-hidden="true"></li></a>

<?php
} else {
?>
	<a href="login.php"><li>LOG IN</li></a>
	<a href="register.php"><li>REGISTER</li></a>
<?php
}
?>
</ul>
</nav>
</header>
