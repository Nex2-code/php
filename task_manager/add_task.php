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
	
	<h3>Add Task Page</h3>
	<p>
		<?php 

			 if(isset($_SESSION['task_fail']))
			 {
			 	//display session message   
			 	echo $_SESSION['task_fail'];
			 	//remove the message after once 
			 	unset($_SESSION['task_fail']);
			 }

		 ?>
	</p>

	<!-- Form to Add Task starts here -->

	<form method="POST" action="">
		<table>
			<tr>
				<td>Task Name:</td>
				<td><input type="text" name="task_name" placeholder="type task name" required="required"></td>
			</tr>
			<tr>
				<td>Task Description:</td>
				<td><textarea name="task_description" placeholder="type task details" required="required"></textarea></td>
			</tr>
			<tr>
			<td>Select List</td>
			<td>
				<select name="list_id">

					<?php 
						 $conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
						 $db_select=mysqli_select_db($conn,DB_NAME);
						 $sql="SELECT * FROM tbl_list";
						 $result=mysqli_query($conn,$sql);

						 if($result==true)
						 {
						 	$count_row=mysqli_num_rows($result);

						 	if($count_row>0)
						 	{
						 		while($row=mysqli_fetch_assoc($result))
						 		{
						 			$list_id=$row['list_id'];
						 			$list_name=$row['list_name'];
						 			?>
									<option value="<?php echo $list_id; ?>"><?php echo $list_name; ?></option>
									<?php
								}								
						 	}
						 	else
						 	{
						 		?>
						 		<option value="0">None</option>
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
					<option value="High">High</option>
					<option value="Medium">Medium</option>
					<option value="Low">Low</option>
				</select>
			</td>
			</tr>
			<tr>
				<td>Deadline</td>
				<td><input type="date" name="deadline"></td>
			</tr>
			<tr>
				<td><input class="btn-primary btn-lg" type="submit" name="submit" value="save"></td>
			</tr>
		</table>
	</form>
</div>
</div>

	<!-- Form to Add Task ends here -->

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
		$conn2=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD) or die(mysqli_error());
		$db_select2=mysqli_select_db($conn2,DB_NAME);
		$sql2= "INSERT INTO tbl_task SET task_name='$task_name',
										task_description='$task_description',list_id=$list_id,priority='$priority',deadline='$deadline'";
		$result2=mysqli_query($conn2,$sql2);
		if($result2==true)
		{
			$_SESSION['task_add']="Task added Succesfully";
			header('location:'.SITEURL);	 
		}
		else
		{
			$_SESSION['task_fail']="Fail to added";
			header('location:'.SITEURL.'add_task.php');
		}
	}
 ?>