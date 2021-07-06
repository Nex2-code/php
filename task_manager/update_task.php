<?php 
	include('config/constants.php');
	if(isset($_GET['task_id']))                      
 	{
	 	$task_id=$_GET['task_id'];                    
		$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
		$db_select=mysqli_select_db($conn,DB_NAME);
		$sql="SELECT * FROM tbl_task WHERE task_id=$task_id"; 
		$result=mysqli_query($conn,$sql);

		if($result==true)
		{
			$row=mysqli_fetch_assoc($result);
			$task_name=$row['task_name'];                    
			$task_description=$row['task_description'];
			$list_id=$row['list_id'];
			$priority=$row['priority'];
			$deadline=$row['deadline'];

		}
	}
	else
	{
		header('location:'.SITEURL);
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
	
	<h3>Update Task Page</h3>
	<p>
		<?php 

			 if(isset($_SESSION['task_update_fail']))
			 {
			 	//display session message   
			 	echo $_SESSION['task_update_fail'];
			 	//remove the message after once 
			 	unset($_SESSION['task_update_fail']);
			 }

		 ?>
	</p>

	<!-- Form to update task starts here -->

	<form method="POST" action="">
		<table>
			<tr>
				<td>Task Name:</td>
				<td><input type="text" name="task_name" value="<?php echo $task_name; ?>" required="required"></td>
			</tr>
			<tr>
				<td>Task Description:</td>
				<td><textarea name="task_description">
					<?php echo $task_description; ?>
				</textarea></td>
			</tr>
			<tr>
			<td>Select List</td>
			<td>
				<select name="list_id">

					<?php 
						$conn2=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
						$db_select2=mysqli_select_db($conn2,DB_NAME);
						$sql2="SELECT * FROM tbl_list";
						$result2=mysqli_query($conn2,$sql2);
						if($result2==true)
						 {
						 	$count_row2=mysqli_num_rows($result2);

						 	if($count_row2>0)
						 	{
						 		while($row=mysqli_fetch_assoc($result2))
						 		{
						 			$list_id2=$row['list_id'];
						 			$list_name=$row['list_name'];
						 			?>
									<option <?php if($list_id2==$list_id){echo "selected='selected'";} ?> value="<?php echo $list_id2; ?>"><?php echo $list_name; ?></option>
									<?php
								}								
						 	}
						 	else
						 	{
						 		?>
						 		<option <?php if($list_id=0){echo "selected='selected'";} ?>value="0">None</option>
						 		<?php
						 	}
						 }

					 ?>
				</select>
			</td>
			</tr>
			<tr>
			<td>Priority</td>
			<td>
				<select name="priority">
					<option <?php if($priority=="High"){echo "selected='selected'";} ?>value="High">High</option>
					<option <?php if($priority=="Medium"){echo "selected='selected'";} ?>value="Medium">Medium</option>
					<option <?php if($priority=="Low"){echo "selected='selected'";} ?>value="Low">Low</option>
				</select>
			</td>
			</tr>
			<tr>
				<td>Deadline</td>
				<td><input type="date" name="deadline" value="<?php echo $deadline; ?>" /></td>
			</tr>
			<tr>
				<td><input class="btn-primary btn-lg" type="submit" name="submit" value="save"></td>
			</tr>
		</table>
	</form>
</div>
</div>

	<!-- Form to update task ends here -->

</body>
</html>
<?php 
	
	if(isset($_POST['submit']))
	{

		$task_name=$_POST['task_name'];
		$task_description=$_POST['task_description'];
		$list_id=$_POST['list_id'];
		$priority=$_POST['priority'];
		$deadline=$_POST['deadline'];
		$conn3=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
		$db_select3=mysqli_select_db($conn3,DB_NAME);
		$sql3= "UPDATE tbl_task SET task_name='$task_name',
										task_description='$task_description',list_id=$list_id,priority='$priority',deadline='$deadline' WHERE task_id=$task_id";
		$result3=mysqli_query($conn3,$sql3);
		if($result3==true)
		{
			$_SESSION['task_update']="Task updated Succesfully";
			header('location:'.SITEURL);	 
		}
		else
		{
			$_SESSION['task_update_fail']="Fail to added";
			header('location:'.SITEURL.'update_task.php');
		}
	}
 ?>