<?php
    $id=$_GET['id'];
    $conn=mysqli_connect('localhost','root','') or die(mysqli_error());
	$select_db=mysqli_select_db($conn,'test') or die(mysqli_error());
	$sql="DELETE FROM td_user WHERE id=".$id;
	$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
	if($result==true)
	{
		header('location:index.php');
	}
	else
	{
		echo "error";
	}
?>