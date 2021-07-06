<?php 
 	$id=$_POST['id'];
 	$first_name=$_POST['first_name'];
 	$last_name=$_POST['last_name'];
 	$conn=mysqli_connect('localhost','root','') or die(mysqli_error());
	$select_db=mysqli_select_db($conn,'test') or die(mysqli_error());
	$sql="UPDATE td_user SET first_name='$first_name',last_name='$last_name' WHERE id='$id'"; 
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