<?php
session_start();
include("header.php");
?>
<main class="content">
<?php
	if($_SESSION["loggued_on_user"] !== "") {
		echo '<h1 class="page-title">All items</h2>';
	} else {
		echo '<h1 class="page-title">Shop now, register to place an order!</h2>';
	}
	// include("items.php");
	include("footer.php");
?>
</main>
