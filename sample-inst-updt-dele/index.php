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
	table, tr, th {
		border: 2px solid black;
		border-collapse: collapse;
		padding: 1%;
	}
	.footer{
		background-color: Black;
		color: white;
		padding: 1%;
		text-align: center;
	}
</style>
<body>
	<header class="header">
		<h1>Insert Details</h1>
	</header>
	<div class="main">
		<h2>Add First and Last name</h2>
		<br />
		<form method="post" action="add_action.php">
			<table>
				<tr>
					<td>First Name:</td>
					<td><input type="text" name="first_name" placeholder="Fist name"></td>
				</tr>
				<tr>
					<td>Last Name:</td>
					<td><input type="text" name="last_name" placeholder="Last name"></td>
				</tr>
				<tr>
					<td>&nbsp</td>
					<td><input type="submit" name="submit" value="Add member"></td>
				</tr>
			</table>
		</form>
		<br />
		<hr />
		<br />
		<h2>List names</h2>
		<br />
		<table>
			<tr>
				<th>S.No</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Actions</th>
			</tr>
			<?php
			  $conn=mysqli_connect('localhost','root','') or die(mysqli_error());
              $select_db=mysqli_select_db($conn,'test') or die(mysqli_error());
              $sql="SELECT * FROM td_user";
              $result=mysqli_query($conn,$sql) or die(mysqli_error($conn));
              $sn=1;
              if($result==true)
              {
              	while($row=mysqli_fetch_assoc($result))
              	{
              		$id=$row['id'];
              		$first_name=$row['first_name'];
              		$last_name=$row['last_name'];
              		?>
		          	<tr>
						<td><?php echo $sn++; ?></td>
						<td><?php echo $first_name;?></td>
						<td><?php echo $last_name; ?></td>
						<td>
							<a href="edit.php?id=<?php echo $id; ?>"><button type="button">UPDATE</button></a>
							<a href="delete.php?id=<?php echo $id;?>"><button type="button">DELETE</button></a>
						</td>
					</tr>
					<?php
              	}
              }
			?>
		</table>
	</div>
	<footer class="footer">
		All right &copy; 2021 Adarsh Negi
	</footer>
</body>
</html>