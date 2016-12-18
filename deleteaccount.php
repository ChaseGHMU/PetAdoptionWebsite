<?php 
include("pieces/start.php");
include("pieces/header.php");
include("/var/www/html/private/private.php");

$db = mysqli_connect(HOST,USERNAME,PASSWORD,DBNAME);
  
if(!$db){
  echo "Error Connecting to database";
}

$user = $_SESSION['userid'];
echo $user;

$stmt=mysqli_prepare($db,"DELETE FROM assoc WHERE userid = ?");
mysqli_stmt_bind_param($stmt,"s",$user);
mysqli_stmt_execute($stmt);

$stmt = mysqli_prepare($db,"DELETE FROM users WHERE userid = ?");
mysqli_stmt_bind_param($stmt,"s",$user);
mysqli_stmt_execute($stmt);

session_start();
session_destroy();
session_start();
$_SESSION["success"] = [];
$_SESSION["success"][] = "You have successfully logged out.";
$_SESSION['user'] = null;
 
 header("Location: index.php?message=delete");