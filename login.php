	<?php
	session_start();
	require_once "user.php";
	if(isset($_GET['user'])){
		$user1 = new User($_GET['user'],$_GET['pass']);
		if($user1->login()){
			if(isset($_GET['remember'])){
				setcookie('user',$_GET['user'],time()+3600);
				setcookie('pass',$_GET['pass'],time()+3600);
			}
			//echo "Logged in successfully";
			//Luu thong tin vao session
			$_SESSION['user']=$_GET['user'];
			header('location:index.php');
		}
	}
	?>
	<!DOCTYPE html>
	<html style="background: #9dff002e;">
	<head>
		<title>Login</title>
	</head>
	<body>
	<form action="" method="get" style="text-align: center; padding-top: 257px; margin-right: 67px;">
		<h1 style="padding-left: 54px; font-family: cursive;">Nhóm 9</h1>
		<a style="font-family: cursive;">Username: </a> <input type="text" name="user" value="<?php echo isset($_COOKIE['user'])?$_COOKIE['user']:"" ?>"><br><br>
		<a style="font-family: cursive;"> Password: </a><input type="Password" name="pass"><br><br>
		<input style="margin-left: 69px;" type="checkbox" name="remember">Remember
		<input style="font-family: monospace; " type="submit" name="" value="Submit">
	</form>
	</body>
	</html>