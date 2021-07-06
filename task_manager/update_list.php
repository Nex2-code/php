<?php 
	include('config/constants.php');
	if(isset($_GET['list_id']))       
 	{
	 	$list_id=$_GET['list_id'];
		$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
		$db_select=mysqli_select_db($conn,DB_NAME);
		$sql="SELECT * FROM tbl_list WHERE list_id=$list_id";   
		$result=mysqli_query($conn,$sql);

		if($result==true)
		{
			$row=mysqli_fetch_assoc($result);
			$list_name=$row['list_name'];                     
			$list_description=$row['list_description'];        

		}
		else
		{
			header('location:'.SITEURL.'manager_list.php');
		}
 	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Task Manager</title>
	<link rel="stylesheet" href="<?php echo SITEURL; ?>CSS/style.css">
</head>
<body>
	<div class="wrapper">
	<h1>Task Manager</h1>
	<div class="menu">
	<a href="<?php echo SITEURL; ?>">Home</a>
	<a href="<?php echo SITEURL; ?>manage_list.php">Manage List</a>
	
	<h3>Update List Page</h3>
	<p>
		<?php 

			 if(isset($_SESSION['update_fail']))
			 {
			 	//display session message   
			 	echo $_SESSION['update_fail'];
			 	//remove the message after once 
			 	unset($_SESSION['update_fail']);
			 }

		 ?>
	</p>

	<!-- Form to update List starts here -->

	<form method="POST" action="">
		<table>
			<tr>
				<td>List Name:</td>
				<td><input type="text" name="list_name" value="<?php echo $list_name; ?>" required="required"></td>
			</tr>
			<tr>
				<td>List Description:</td>
				<td><textarea name="list_description;">
					<?php  echo $list_description;?>

				</textarea></td>
			</tr>
			<tr>
				<td><input class="btn-primary btn-lg" type="submit" name="submit" value="save"></td>

			</tr>
		</table>
	</form>
</div>
</div>
	
	<!-- Form to update List ends here -->

</body>
</html>
<?php 
	
	if(isset($_POST['submit']))
	{
		$list_name=$_POST['list_name'];
		$list_description=$_POST['list_description'];
		$conn2=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
		$db_select2=mysqli_select_db($conn2,DB_NAME);
		$sql2="UPDATE tbl_list SET list_name='$list_name',list_description='$list_description' WHERE list_id=$list_id"; 
		$result2=mysqli_query($conn2,$sql2);
		if($result2==true)
		{
			$_SESSION['update']="List updated Succesfully";
			header('location:'.SITEURL.'manage_list.php');
			//create a session variable to display	 
		}
		else
		{
			$_SESSION['update_fail']="Fail to update";
			header('location:'.SITEURL.'update_list.php?list_id='.$list_id);
		}
	}
 ?>