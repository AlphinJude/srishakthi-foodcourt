<?php 
session_start();
$message="";

include("config-juice.php");

if(count($_POST)>0)
{
	$username = $_POST['username'];
	$password = $_POST['password'];

	$dpass=mysqli_query($conn,"SELECT * FROM `login` WHERE `username` = '$username' AND `password` = PASSWORD('$password')");
	$result=mysqli_fetch_array($dpass);
	if(is_array($result))
	{
		$_SESSION["username"] = $username;
		$_SESSION["role"] = $result['role'];

	}
	else
	{
		echo "<script>
					alert('Invalid Username or Password!');
					window.location = '../../';
				</script>";
	}
	if(isset($_SESSION["username"])) {
		$_SESSION["login_time_stamp"] = time();
		if($_SESSION["role"] == "admin"){
			header("location: select-store.php");
		}
		else
			header("location: homepage.php");
	}
}
?>