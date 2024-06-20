<?php
session_start();
error_reporting(0);
include("includes/config.php");
if(isset($_POST['submit']))
{
$ret=mysqli_query($bd, "SELECT * FROM users WHERE userEmail='".$_POST['username']."' and password='".md5($_POST['password'])."'");
$num=mysqli_fetch_array($ret);
if($num>0)
{
$extra="dashboard.php";//
$_SESSION['login']=$_POST['username'];
$_SESSION['id']=$num['id'];
$host=$_SERVER['HTTP_HOST'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($bd, "insert into userlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$_SESSION['login']=$_POST['username'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
mysqli_query($bd, "insert into userlog(username,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$errormsg="Invalid username or password";
$extra="login.php";

}
}



if(isset($_POST['change']))
{
   $email=$_POST['email'];
    $contact=$_POST['contact'];
    $password=md5($_POST['password']);
$query=mysqli_query($bd, "SELECT * FROM users WHERE userEmail='$email' and contactNo='$contact'");
$num=mysqli_fetch_array($query);
if($num>0)
{
mysqli_query($bd, "update users set password='$password' WHERE userEmail='$email' and contactNo='$contact' ");
$msg="Password Changed Successfully";

}
else
{
$errormsg="Invalid email id or Contact no";
}
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>User Login</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
<script type="text/javascript">
function valid()
{
 if(document.forgot.password.value!= document.forgot.confirmpassword.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.forgot.confirmpassword.focus();
return false;
}
return true;
}
</script>
  </head>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- <div class="container"> -->
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <!-- Logo -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="http://localhost:81/Complaint%20Management%20System/users/">
    <img src="assets/img/CampusCareLogo.png" alt="Logo" style="margin: auto; width: 150px; height: auto;">
</a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="http://localhost:81/Complaint Management System/users/">User Login</a>
                    </li>
                    <li>
                        <a href="http://localhost:81/Complaint Management System/users/registration.php">User Registration</a>
                    </li>
                    <li>
                        <a href="http://localhost:81/Complaint Management System/admin/">Admin</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-6">
            <div id="login-page">

		      <form class="form-login" name="login" method="post">
		        <h2 class="form-login-heading">sign in now</h2>
		        <p style="padding-left:4%; padding-top:2%;  color:red">
		        	<?php if($errormsg){
echo htmlentities($errormsg);
		        		}?></p>

		        		<p style="padding-left:4%; padding-top:2%;  color:green">
		        	<?php if($msg){
echo htmlentities($msg);
		        		}?></p>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="username" placeholder="Email"  required autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" required placeholder="Password">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a data-toggle="modal" href="login.html#myModal"> Forgot Password?</a>

		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" name="submit" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
		           </form>
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="registration.php">
		                    Create an account
		                </a>
		            </div>
					</div>
</div>

		        </div>

		          <!-- Modal -->
		           <form class="form-login" name="forgot" method="post">
		          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		              <div class="modal-dialog">
		                  <div class="modal-content">
		                      <div class="modal-header">
		                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                          <h4 class="modal-title">Forgot Password ?</h4>
		                      </div>
		                      <div class="modal-body">
		                          <p>Enter your details below to reset your password.</p>
<input type="email" name="email" placeholder="Email" autocomplete="off" class="form-control" required><br >
<input type="text" name="contact" placeholder="contact No" autocomplete="off" class="form-control" required><br>
 <input type="password" class="form-control" placeholder="New Password" id="password" name="password"  required ><br />
<input type="password" class="form-control unicase-form-control text-input" placeholder="Confirm Password" id="confirmpassword" name="confirmpassword" required >


		                      </div>
		                      <div class="modal-footer">
		                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
		                          <button class="btn btn-theme" type="submit" name="change" onclick="return valid();">Submit</button>
		                      </div>
		                  </div>
		              </div>
		          </div>
		          <!-- modal -->
		          </form>



	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $(document).ready(function() {
            // Replace 'v1.mp4' with the correct path to your video file
            $.backstretch("assets/img/login-bg.png");
        });
    </script>


  </body>
</html>
