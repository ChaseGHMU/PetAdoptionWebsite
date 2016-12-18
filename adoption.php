<?php
require_once("pieces/start.php");
require_once("pieces/header.php");
include("/var/www/html/private/private.php");
 
$db = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);	
$stmt = $db->prepare("SELECT * FROM dogs");

if(!(mysqli_stmt_execute($stmt)))
	echo "Cant execute";
else if(!($result = mysqli_stmt_get_result($stmt)))
	echo "Cant get result";


$stmt->close();

if(isset($_POST['submit'])){

$name = $_POST['name'];
$stmt = mysqli_prepare($db,"insert into assoc(userid,dogid) values(?,?)");

if(!(mysqli_stmt_bind_param($stmt,"ss",$_SESSION['userid'],$_POST['id'])))
	echo "Cant Bind Param";
else if(!(mysqli_stmt_execute($stmt)))
	echo "Cant execute";

header("Location: adoption.php?name=$name");
}
?>
<?php if(isset($_GET['name'])){ ?>
	<div class = "alert alert-success text-center">You've successfully adopted <?php echo $_GET['name']; ?></div>
<?php } ?>
<div class="container-fluid">
  <div class="row">
	<div class="col-sm-10 col-sm-offset-1">
	  <div class="panel panel-default">
		<div class="panel-heading">
		  <h4 class="text-center">Available Dogs</h4>
		</div>
		<table class="table">
		  <tr>
			<th align="center">Name</th>
			<th>Age</th>
			<th>Breed</th>
			<th>Adopt?</th>
		  </tr>
		  <?php while($row = mysqli_fetch_assoc($result)){ ?>
		  <tr>
		    <td><?php echo $row["name"]; ?></td>
		    <td><?php echo $row["age"]; ?></td>
		    <td><?php echo $row["breed"]; ?></td>
			<form action="adoption.php" method="post">
			<input type = "hidden" value="<?php echo $row['dogid']; ?>" name="id">
			<input type = "hidden" value="<?php echo $row['name']; ?>" name="name">
			<td align = "left"><input class="btn btn-success" type="submit" name="submit" value="Adopt"></td>
			</form>
		  </tr>
		  <?php } ?>
		</table>
		</div>
	</div>
  </div>
</div>