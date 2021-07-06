<?php 
	include('config/constants.php');
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
	
	<h3>Add List Page</h3>
	<p>
		<?php 
 
			 if(isset($_SESSION['add_fail']))
			 {
			 	//display session message   
			 	echo $_SESSION['add_fail'];
			 	//remove the message after once 
			 	unset($_SESSION['add_fail']);
			 }

		 ?>
	</p>

	<!-- Form to Add List starts here -->

	<form method="POST" action="">
		<table>
			<tr>
				<td>List Name:</td>
				<td><input type="text" name="list_name" placeholder="type list name" required="required"></td>
			</tr>
			<tr>
				<td>List Description:</td>
				<td><textarea name="list_description" placeholder="type list details" required="required"></textarea></td>
			</tr>
			<tr>
				<td><input class="btn-primary btn-lg" type="submit" name="submit" value="save"></td>

			</tr>
		</table>
	</form>
</div>
</div>

	<!-- Form to Add List ends here -->

</body>
</html>

<?php 
 

	if(isset($_POST['submit']))
	{

		$list_name=$_POST['list_name'];
		$list_description=$_POST['list_description'];
		$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
		$db_select=mysqli_select_db($conn,DB_NAME);
		$sql= "INSERT INTO tbl_list SET list_name='$list_name',
										list_description='$list_description'";
		$result=mysqli_query($conn,$sql);
		if($result==true)
		{
			//create a session variable to display
			$_SESSION['add']="List added Succesfully";
			header('location:'.SITEURL.'manage_list.php');	 
		}
		else
		{
			$_SESSION['add_fail']="Fail to added";
			header('location:'.SITEURL.'add_list.php');
		}
	}
 ?>