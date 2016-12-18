<?php
	require_once("pieces/start.php");
	require_once("pieces/header.php");
	include("/var/www/html/private/private.php");
?>

<?php 
if(isset($_POST['submit'])){
	
  $db = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);
  
  if(!$db){
	  echo "Error Connecting to database";
  }
  
  $user=$_POST['username'];
  $pass=$_POST['password'];
  $pass=hash("sha256",$pass);
  $pass=hash("sha512",$pass);
  
  $stmt = mysqli_prepare($db,"SELECT userid, username,password,fname,lname FROM users WHERE username LIKE ?");
  
  if(!(mysqli_stmt_bind_param($stmt, 's', $user))){
	  echo "Couldn't Bind Paramaters";
  }else if(!(mysqli_stmt_execute($stmt))){
	  echo "Couldn't Execute";
  }else if(!(mysqli_stmt_bind_result($stmt,$id,$username,$password,$fname,$lname))){
	  echo "Couldn't Bind Result";
	  $result = mysqli_error($stmt);
	  echo $result;
  }else if(!(mysqli_stmt_fetch($stmt))){
	  $result = mysqli_stmt_error($stmt);
	  echo $result;
  }
  
  if($user == $username && $pass == $password){
	  $_SESSION['user'] = $fname;
	  $_SESSION['lname'] = $lname;
	  $_SESSION['userid']= $id;
	  $_SESSION['username'] = $username;
	  header("Location: index.php?message=success");
  }else{
	  echo "<div class='alert alert-danger text-center'><strong>Error: Incorrect username or password</strong> </div>";
  }
  $stmt->close();
  $db->close();
}

if($_GET['message'] == "loggedout"){
	echo "<div class='alert alert-success text-center'>You've been succesfully logged out</div>";
}

?>
<div class="background">

<h4 class = "text-center">Already a User? Login Here</h4>

  <form action = "login.php" method="POST"class="form-horizontal">
    <div class="form-group row">
      <label for = "username" class="control-label col-sm-2">Username:</label>
	  <div class="col-sm-8">
	    <input type = "text" id="username"name="username" max="20" class="form-control">
	  </div>
	</div>
	<div class="form-group row">
	  <label for = "password" class="control-label col-sm-2">Password:</label>
	  <div class="col-sm-8">
	    <input type = "password" id="password"name = "password" max="20" class="form-control">
	  </div>
	</div>
	<div class="form-group row">
	  <div class="col-sm-offset-2 col-sm-10">
	  <button type = "submit" name = "submit" class="btn btn-primary">Submit</button>
	  </div>
	</div>
  </form>
  
  <br>
  
  <div class="row">
  <div class="col-sm-offset-2 col-sm-10">
    <a href="register.php">Don't have an account? Sign-up here!</a>
  </div>
  </div>
  
</div>
