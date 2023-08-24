<?php
session_start();
require_once("../config/dbl_config.php");
require_once('../class/class_user.php');
require_once('../class/class_query.php');
$sql_process = new function_query();
$login = new USER();

if($login->is_loggedin()!="")
{
//    $login->redirect('../dashboard');
if($_SESSION['user_status']=='1'){  ///ถ้าสำหรับเจ้าหน้าที่ ADMIN ใหญ๋
	$login->redirect('../dashboard');
  }elseif($_SESSION['user_status']=='2' || $_SESSION['user_status']=='3' || $_SESSION['user_status']=='4' || $_SESSION['user_status']=='5'){ ////ผู้บริหาร
	$login->redirect('../index');  
  } 
}

if(isset($_POST['btn-submit']))
{
$username = strip_tags(trim($_POST['loginname']));
$password = strip_tags(trim($_POST['loginpass']));

	if($login->doLogin($username,$password))
	{

		// $login->redirect('../dashboard');
		if($_SESSION['user_status']=='1'){  ///ถ้าสำหรับเจ้าหน้าที่ ADMIN ใหญ๋
			$login->redirect('../dashboard');
		  }elseif($_SESSION['user_status']!='1'){ ////ผู้บริหาร เจ้าหน้าที่
		$login->redirect('../index/?option=main');  
		  } 
	}
	else
	{
		$alert_login_con="ท่านกรอกข้อมูลไม่ถูกต้อง";
  }
}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=$name_system?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../images/images_web/105719.jpg"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/Login_v9/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/Login_v9/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/Login_v9/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/Login_v9/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../plugins/Login_v9/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/Login_v9/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/Login_v9/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../plugins/Login_v9/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../plugins/Login_v9/css/util.css">
	<link rel="stylesheet" type="text/css" href="../plugins/Login_v9/css/main.css">
<!--===============================================================================================-->
<script src="../plugins/sweetalert_master/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="../plugins/sweetalert_master/sweetalert.css">
</head>
<body>
<?php  if(isset($alert_login_con))
    {
      ?>
      <script>
       swal("<?=$alert_login_con?>", "ปิดหน้าต่างนี้!", "error");
      </script>
  <?php } ?>
	
  <form class="login100-form validate-form" method="post" autocomplete="off">
	<div class="container-login100" style="background-image: url('../images/images_web/bg-01.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
		
				<span class="login100-form-title p-b-37">
				<?=$name_system?> .	Sign In
				</span>

				<div class="wrap-input100 validate-input m-b-20" data-validate="Enter Username">
					<input class="input100" type="text" name="loginname" placeholder="Username">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" name="loginpass" placeholder="Password">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn" type="submit" name="btn-submit">
						Sign In
					</button>
				</div>
			
		</div>
	</div>
	
	</form>

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="../plugins/Login_v9/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/Login_v9/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/Login_v9/vendor/bootstrap/js/popper.js"></script>
	<script src="../plugins/Login_v9/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/Login_v9/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/Login_v9/vendor/daterangepicker/moment.min.js"></script>
	<script src="../plugins/Login_v9/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/Login_v9/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="../plugins/Login_v9/js/main.js"></script>

</body>
</html>