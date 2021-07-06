<!DOCTYPE html>
<html>
<head>
	<title>Insert update and delete</title>
</head>
<style>
*{
	margin: 0;
}
	.header{
		background-color: green;
		color: white;
		padding: 1%;
		text-align: center;
	}
	.main{
		width: 80%;
		border: 1px solid black;
		margin: 1% auto;
		padding: 3%;

	}
	.footer{
		background-color: black;
		color: white;
		padding: 1%;
		text-align: center;
	}
	table, tr, th {
		border: 2px solid black;
		border-collapse: collapse;
		padding: 1%;
	}
</style>
<body>
	<header class="header">
		<h1>Insert Details</h1>
	</header>
	<div class="main">
		<h2>Updating First and Last name</h2>

		<?php
			//getting values from url
			$id=$_GET['id'];
			 $conn=mysqli_connect('localhost','root','') or die(mysqli_error());
             $select_db=mysqli_select_db($conn,'test') or die(mysqli_error());
             $sql="SELECT * FROM td_user WHERE id=".$id;
             $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
             if($result==true)
             {
             	$row=mysqli_fetch_assoc($result);
             	$first_name=$row['first_name'];
             	$last_name=$row['last_name'];
             }
		?>
		<form method="post" action="edit_action.php">
			<table>
				<tr>
					<td>First Name:</td>
					<td><input type="text" name="first_name" value="<?php echo $first_name;?>"></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><input type="text" name="last_name" value="<?php echo $last_name; ?>"></td>
				</tr>
				<tr>
					<td>&nbsp;<input type="hidden" name="id" value="<?php echo $id; ?>"></td>
					<td><input type="submit" name="submit" value="Update member"></td>
				</tr>
			</table>
		</form>
		<br />
		<hr />
		<br />
	</div>
	<footer class="footer">
		All right sreserved. &copy; 2021 Adarsh Negi
	</footer>
</body>
</html>