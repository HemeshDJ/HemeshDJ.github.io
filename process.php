<?php 
	
	$db = mysqli_connect("localhost", "root", "", "taken");

	if(isset($_POST['register']))
	{
		$username = $_POST['username'];
		$email = $_POST['mail'];
		$password = $_POST['pwd'];

		$sql_u = "SELECT * FROM users WHERE username='$username'";
		$sql_e = "SELECT * FROM users WHERE mail='$email'";
		$res_u = mysqli_query($db, $sql_u) or die(mysqli_error($db));
		$res_e = mysqli_query($db, $sql_e) or die(mysqli_error($db));

		if(mysqli_num_rows($res_u) > 0)
		{
			echo "Username already taken!";
		}
		else if(mysqli_num_rows($res_e) > 0)
		{
			echo "Email id already registered!";
		}
		else
		{
			$query = "INSERT INTO users (username, mail, pwd) VALUES('$username', '$email', '$password') ";
			$result = mysqli_query($db, $query) or die(mysqli_error($db));
			echo "Saved";
			exit();
		}
	}

?>
