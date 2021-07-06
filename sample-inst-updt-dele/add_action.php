<?php
//get values form
$first_name=$_POST['first_name'];
$last_name=$_POST['last_name'];
//connect database
$conn=mysqli_connect('localhost','root','') or die(mysqli_error());
//select db 
$select_db=mysqli_select_db($conn,'test') or die(mysqli_error());
//sql suerry to insert data 
$sql="INSERT INTO td_user SET first_name='$first_name',last_name='$last_name'";
//EXECUTE QUERRY 
$result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
 if($result==true)
 {
 	header('location:index.php');
 }
 else
 {
 	echo "fail";
 }
 ?>
