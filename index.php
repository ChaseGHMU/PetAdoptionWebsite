<?php
	require_once("pieces/start.php");
	require_once("pieces/header.php");
?>

  <?php if($_GET['message']=="success"){ ?>
	<div class = "alert alert-success text-center">You've been Succesfully logged in, <?php echo $_SESSION['user'];?></div>
  <?php } else if($_GET['message'] == "delete"){ ?>
	<div class = "alert alert-success text-center">You've been Succesfully Deleted</div>
  <?php } ?>
	<h1 class="text-center head">Welcome to the Dawg-Pound</h1>
	
	<div>
	<div align="center">
	<button type = "button" onclick = "timeout()" class="btn btn-success">About this Page</button>
	</div>
	<p id="update" align="center" style="padding: 0;"></p>
	</div>
	
	<div align = "center">
	<h3 class="text-center head">Myths and Facts about pet Adoption:</h3>
	<iframe width="560" height="315" src="https://www.youtube.com/embed/wtCyZQRnEvw" frameborder="0" allowfullscreen></iframe>
	</div>