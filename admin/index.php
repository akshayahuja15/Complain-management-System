<?php
session_start();
error_reporting(0);
include("include/config.php");
if(isset($_POST['submit']))
{
	$username=$_POST['username'];
	$password=md5($_POST['password']);
	$ret=mysqli_query($bd, "SELECT * FROM admin WHERE username='$username' and password='$password'");
	$num=mysqli_fetch_array($ret);
	if($num>0)
	{
		$extra="notprocess-complaint.php";//
		$_SESSION['alogin']=$_POST['username'];
		$_SESSION['id']=$num['id'];
		$host=$_SERVER['HTTP_HOST'];
		$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
	else
	{
		$_SESSION['errmsg']="Invalid username or password";
		$extra="index.php";
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
		header("location:http://$host$uri/$extra");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Campus Care Admin login</title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="css/theme.css" rel="stylesheet">
	<link href="images/icons/css/font-awesome.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	<style>
	body {
	    background-color: #f3f3f3;
	    font-family: 'Open Sans', sans-serif;
	}

	.wrapper {
	    margin-top: 50px;
	}

	.module-login {
	    background-color: #fff;
	    border-radius: 5px;
	    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	    padding: 20px;
	}

	.module-head {
	    border-bottom: 1px solid #ddd;
	    margin-bottom: 20px;
	    padding-bottom: 10px;
	}

	.module-head h3 {
	    margin: 0;
	    padding: 0;
	    font-weight: bold;
	    color: #333;
	}

	.module-body {
	    margin-bottom: 20px;
	}

	.module-body .control-group {
	    margin-bottom: 20px;
	}

	.module-body input[type="text"],
	.module-body input[type="password"] {
	    width: 100%;
	    padding: 10px;
	    border: 1px solid #ccc;
	    border-radius: 3px;
	    box-sizing: border-box;
	}

	.module-foot {
	    text-align: center;
	}

	.footer {
	    background-color: #333;
	    color: #fff;
	    padding: 10px 0;
	    text-align: center;
	    position: fixed;
	    bottom: 0;
	    width: 100%;
	}

	.footer a {
	    color: #fff;
	}

	.footer a:hover {
	    text-decoration: underline;
	}
	</style>
</head>
<body>

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
				<i class="icon-reorder shaded"></i>
			</a>

			<a class="brand" href="http://localhost:81/Complaint%20Management%20System/admin/">
			    <img src="images/adminlogo.png" alt="Logo" style="width: 150px; height: auto;">
			</a>

			<div class="nav-collapse collapse navbar-inverse-collapse">
				<ul class="nav pull-right">
					<li><a href="http://localhost:81/Complaint%20Management%20System/users/">
					Back to Portal
					</a></li>
				</ul>
			</div><!-- /.nav-collapse -->
		</div>
	</div><!-- /navbar-inner -->
</div><!-- /navbar -->

	<div class="container">
		<div class="row">
			<div class="module module-login span4 offset4">
				<form class="form-vertical" method="post">
					<div class="module-head">
					<img src="images/adminlogo.png" alt="Logo" style="width: 250px; height: auto;">
					</div>
					<span style="color:red;" ><?php echo htmlentities($_SESSION['errmsg']); ?><?php echo htmlentities($_SESSION['errmsg']="");?></span>
					<div class="module-body">
						<div class="control-group">
							<div class="controls row-fluid">
								<input class="span12" type="text" id="inputEmail" name="username" placeholder="Username">
							</div>
						</div>
						<div class="control-group">
							<div class="controls row-fluid">
								<input class="span12" type="password" id="inputPassword" name="password" placeholder="Password">
							</div>
						</div>
					</div>
					<div class="module-foot">
						<div class="control-group">
							<div class="controls clearfix">
								<button type="submit" class="btn btn-primary pull-right" name="submit">Login</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


<div class="footer">
	<div class="container">
		<b class="copyright">&copy;</b>Campus Care All rights reserved.
	</div>
</div>
<script src="scripts/jquery-1.9.1.min.js"></script>
<script src="scripts/jquery-ui-1.10.1.custom.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
