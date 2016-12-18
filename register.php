<?php
	require_once("pieces/start.php");
	require_once("pieces/header.php");
	include("/var/www/html/private/private.php");

  function check_if_exists($user,$db){
	$status = true;
  $stmt = mysqli_prepare($db,"SELECT username FROM users WHERE username like ? ");
  if(!(mysqli_stmt_bind_param($stmt,'s',$user))){
	  echo "error check database";
  }else if(!(mysqli_stmt_execute($stmt))){
	  echo "couldnt execute database check";
  }else if(mysqli_stmt_bind_result($stmt,$testuser)){
	  mysqli_stmt_fetch($stmt);
	  if($testuser==$user){
		  $status = false;
	  }
  }else if(!(mysqli_stmt_fetch($stmt))){
	  $status = false;
  }
  $stmt->close();
  return $status;
}
if(isset($_POST['newuser'])){
	
  $db = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);
  
  if(!$db){
	  echo "Error Connecting to database";
  }
  
  if(empty($_POST['username'])){
	  $_SESSION['errors']['username'] = 'Username is missing';
  }
  if(empty($_POST['password'])){
	  $_SESSION['errors']['password'] = 'Password is empty';
  }
  if(empty($_POST['fname'])) {
	  $_SESSION['errors']['first_name'] = 'First name is missing';
  }
  if(empty($_POST['lname'])) {
	  $_SESSION['errors']['email'] = 'email is missing';
  }
 
  if(count($_SESSION['errors']) > 0){
	//This is for ajax requests:
      if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&  strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo json_encode($_SESSION['errors']);
        exit;
  	  }
  }
  if(empty($_POST['username']) && empty($_POST['password']) && empty($_POST['fname']) && empty($_POST['lname'])){
	  echo "Please fill out the required information";
  }
  
  $pass = $_POST['password'];
  $user= $_POST['username'];
  $first= $_POST['fname'];
  $last= $_POST['lname'];
  
  $user = strtolower($user);
  
  $pass = hash("sha256",$pass);
  $pass = hash("sha512",$pass);
  
  $status = check_if_exists($user,$db);
  
  $stmt = mysqli_prepare($db,"INSERT INTO users(username,password,fname,lname)VALUES(?,?,?,?);");
  if(!$status){
	  echo "<div class = 'alert alert-warning text-center' role = 'alert'><strong>Error: </strong>user already exists in database</div>";
  }else if(!(mysqli_stmt_bind_param($stmt, 'ssss', $user,$pass,$first,$last))){
	  echo "Couldn't Bind Paramaters";
  }else if(!(mysqli_stmt_execute($stmt))){
	  echo "Couldn't Execute";
  }else{
	  echo "<div class = 'alert alert-success text-center' role = 'alert'><strong>Congratulations!</strong> You've been Succesfully Registered!<a href = 'login.php' class='alert-link'> Click Here to return to login</a></div>";
  }
  
  $stmt->close();
  $db->close();
}
?>
<div class="background">
  <h4 class='text-center'>Register Here</h4>
  <form action = "" method="POST"class="form-horizontal">
    <div class="form-group">
      <label for = "username" class="control-label col-sm-2">Username:</label>
	  <div class="col-sm-8">
	    <input type = "text" id="username" name="username" max="20" class="form-control" placeholder="Enter A Username">
	  </div>
	</div>
	<div class="form-group">
	  <label for = "password" class="control-label col-sm-2">Password:</label>
	  <div class="col-sm-8">
	    <input type = "password" id="password"name = "password" max="20" class="form-control" placeholder="20 Character Maximum">
	  </div>
	</div>
	<div class="form-group">
	  <label for = "fname" class="control-label col-sm-2">First Name:</label>
	  <div class="col-sm-8">
	    <input type = "text" id="fname"name="fname" max="20" class="form-control" placeholder="Enter Your First Name">
	  </div>
	</div>
	<div class="form-group">
	  <label for = "lname" class="control-label col-sm-2">Last Name:</label>
	  <div class="col-sm-8">
	    <input type = "text" id="lname"name = "lname" max="20" class="form-control" placeholder="Enter Your Last Name">
	  </div>
	</div>
	<div class="form-group">
	  <div class="col-sm-offset-2 col-sm-10">
	  <input type = "submit" name = "newuser" class="btn btn-primary">
	  </div>
	</div>
  </form>
</div>
