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
if ($_SESSION["loggued_on_user"] == "")
{ // If there is no user logged in, show these options
?>
	<a href="login.php"><li>LOG IN</li></a>
	<a href="register.php"><li>REGISTER</li></a>
<?php
}
else if ($_SESSION["admin"])
{ // For admin users show the admin nav items
?>
	<a href="admin.php"><li>ADMIN</li></a>
	<a href="additem.php"><li>ADD ITEM</li></a>
<?php
} // Show Logged in global navigation
else
{
?>
	<a href="myacc.php"><li>MY ACCOUNT</li></a>
	<a href="logout.php"><li class="fa fa-sign-out" aria-hidden="true"></li></a>
<?php
}
?>
<a href="cart.php"><li class="fa fa-shopping-cart" aria-hidden="true">
<?php
	if ($_SESSION["cart"])
	{
		$i = 0;
		foreach ($_SESSION["cart"] as $item)
			$i++;
		if ($i > 0)
			echo "x".$i;
	}
?>
</li></a>
</ul>
</nav>
</header>
