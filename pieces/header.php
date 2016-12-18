<!DOCTYPE html>
<html>
<head>
  <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script src = "js/bootstrap.min.js"></script>
  <link href="css/site.css" rel="stylesheet" type="text/css" />
  <script src= "js/site.js"></script>
  <link rel="shortcut icon" type="image/x-icon" href="favicon.ico.png" />`
  <title>Paw-lease Adopt Me</title>
  
  <meta charset="utf-8" />
</head>
<body>
<nav class="navbar navbar-fixed-top navbar-default navbar-collapse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href=".">Paw-lease Adopt Me</a>
	  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>                        
      </button>
	  </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="information.php">Information</a></li>
		<?php if($_SESSION['user']!=null) { ?>
		  <li><a href="adoption.php">Adopt a Dog</a></li>
		<?php } ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		  <?php if($_SESSION['user']==null){?>
		  <li><a href="register.php">Create An Account</a></li>
          <li><a href="login.php">Login</a></li>
		  <?php }else{ ?>
		  <li class="dropdown">
		    <a class="dropdown-toggle" data-toggle="dropdown"><?php echo "Welcome, " . $_SESSION['user']; ?><span class="caret"></span></a>
		    <ul class="dropdown-menu">
		      <li><a href="account.php">Account info</a></li>
			  <li role="separator" class="divider"></li>
		  	  <li><a href="#" onclick="deleteaccount()">Delete Your Account</a></li>
		    </ul>
		  </li>
          <li><a href="logout.php">Logout</a></li>
		  <?php } ?>
      </ul>
    </div>
  </div>
</nav>