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

	<h3>Manage List Page</h3>

		<p>
		<?php 

			 if(isset($_SESSION['add']))
			 {
			 	//display session message   
			 	echo $_SESSION['add'];
			 	//remove the message after once 
			 	unset($_SESSION['add']);
			 }
			 if(isset($_SESSION['delete']))
			 {
			 	//display session message   
			 	echo $_SESSION['delete'];
			 	//remove the message after once 
			 	unset($_SESSION['delete']);
			 }
			 if(isset($_SESSION['delete_fail']))
			 {
			 	//display session message   
			 	echo $_SESSION['delete_fail'];
			 	//remove the message after once 
			 	unset($_SESSION['delete_fail']);
			 }
			  if(isset($_SESSION['update']))
			 {
			 	//display session message   
			 	echo $_SESSION['update'];
			 	//remove the message after once 
			 	unset($_SESSION['update']);
			 }

		 ?>
	</p>
</div>

	<!--Table to display list starts here-->

	<div class="all-lists">

		<a class="btn-primary" href="<?php echo SITEURL; ?>add_list.php">Add List</a>
	<table class="tbl-full">
		<tr>
			<th>S.No</th>
			<th>List Name</th>
			<th>Actions</th>
		</tr>

		<?php 
			$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
			$db_select=mysqli_select_db($conn,DB_NAME);
			$sql="SELECT * FROM tbl_list";
			$result=mysqli_query($conn,$sql);
			if($result==true)
			{
				$count_rows=mysqli_num_rows($result);
				$sn=1;
				if($count_rows>0)
				{
					while($row=mysqli_fetch_assoc($result))
					{
						$list_id=$row['list_id'];
						$list_name=$row['list_name'];
					?>
					<tr>
						<td><?php echo $sn++; ?></td>
						<td><?php echo $list_name; ?></td>
						<td>
							<a href="<?php echo SITEURL; ?>update_list.php?list_id=<?php echo $list_id ?>">Update</a>
							<a href="<?php echo SITEURL; ?>delete_list.php?list_id=<?php echo $list_id ?>">Delete</a>

						</td>

					</tr>

					<?php
					}
				}
				else
				{
					?>

					<tr>
						<td colspan="3">No List Added Yet</td>
					</tr>
					<?php
				}
			}
		 ?>
	</table>
</div>
</div>

	<!--Table to display list ends here-->
</body>
</html>