<?php
require_once("pieces/start.php");
require_once("pieces/header.php");
include("/var/www/html/private/private.php");
 
$db = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);	

$stmt = mysqli_prepare($db,"select name, age, assoc.dogid, breed, username, CONCAT(fname,' ',lname) as fullname from dogs inner join assoc on dogs.dogid=assoc.dogid
							inner join users on users.userid=assoc.userid where users.userid = ?");
$user = $_SESSION['userid'];
$name = $_POST['name'];

if(!(mysqli_stmt_bind_param($stmt,"i",$user)))
	echo "Cant Bind Param";
else if(!(mysqli_stmt_execute($stmt)))
	echo "Cant execute";
else if(!($result = mysqli_stmt_get_result($stmt)))
	echo "Cant get result";

if(isset($_POST['submit'])){
	$stmt = mysqli_prepare($db,"delete from assoc where dogid=?");
	
if(!(mysqli_stmt_bind_param($stmt,"i",$_POST['dogid'])))
	echo "Cant Bind Param";
else if(!(mysqli_stmt_execute($stmt)))
	echo "Cant execute";

header("Location: account.php?name=$name");
}
?>
<?php
if(isset($_GET['name'])){ 
    $name=$_GET['name'];
	echo "<div class='alert alert-success text-center'>You no longer love $name</div>";
} ?>

<div class = "jumbotron">
  <div class="mainParagraph">
    <h2 class="text-center">Edit Account Information</h2>
  </div>
	  <div class="left col-sm-6">
	    <label for="first">First Name:</label>
	    <div>
	      <input type = "text" class="form-control" readonly value="<?php echo $_SESSION['user']; ?>">
	    </div>
		<br><br>
		<label for="id">User ID:</label>
		<div>
		  <input type="text" class="form-control" readonly value="<?php echo $_SESSION['userid']; ?>">
		</div>
	  </div>
	  <div class="left col-sm-6">
	    <label for="last">Last Name:</label>
	    <div>
	      <input type = "text" class="form-control" readonly value="<?php echo $_SESSION['lname']; ?>">
		</div>
		<br><br>
		<label for = "username">Username:</label>
		<div>
		  <input type = "text" class="form-control" readonly value="<?php echo $_SESSION['username']; ?>">
		</div>
	  </div>
	  <br><br><br><br><br><br><br><br>
</div>
<div class="container-fluid">
  <div class="row">
	<div class="col-sm-10 col-sm-offset-1">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="text-center">Animals You've Adopted</h4>
		</div>
		<table class="table">
		  <tr>
			<th align="center">Name</th>
			<th>Age</th>
			<th>Breed</th>
			<th>Owned By</th>
			<th>ID</th>
			<th>Unadopt</th>
		  </tr>
		  <?php while($row = mysqli_fetch_assoc($result)){ ?>
		  <tr>
		    <td><?php echo $row["name"]; ?></td>
		    <td><?php echo $row["age"]; ?></td>
		    <td><?php echo $row["breed"]; ?></td>
			<td><?php echo $row['fullname'];?></td>
			<td><?php echo $row['dogid'];?></td>
			<td>
			<form method="post" action="account.php">
			<input type="hidden" value="<?php echo $row['dogid']?>" name="dogid">
			<input type="hidden" value="<?php echo $row['name']?>" name="name">
			<input class="btn btn-danger" type = "submit" name="submit" value="Delete Animal">
			</form>
			<td>
		  </tr>
		  <?php } ?>
		</table>
		</div>
	</div>
  </div>
</div>