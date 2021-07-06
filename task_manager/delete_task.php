<?php 
	include('config/constants.php');


	if(isset($_GET['task_id']))
	{
		$task_id=$_GET['task_id'];
		$conn=mysqli_connect(LOCALHOST,DB_USERNAME,DB_PASSWORD);
		$db_select=mysqli_select_db($conn,DB_NAME);
		$sql="DELETE FROM tbl_task WHERE task_id=$task_id";
		$result=mysqli_query($conn,$sql);

		if($result==true)
		{
			$_SESSION['task_delete']='Task deleted Succesfully';
			header('location:'.SITEURL);
		}
		else
		{
			$_SESSION['task_fail']='Failed to delete';
			header('location:'.SITEURL);
		}

	}

 ?>