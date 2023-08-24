<?php
session_start();
require_once("../config/dbl_config.php");
require_once('../class/class_user.php');
require_once('../class/class_query.php');
require_once("../class/class_function.php");
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

if(isset($_POST['loginname']) && isset($_POST['loginpass']))
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


remove_dir("../temp");
$date_clear=date("Y-m-d");
$sql_process->fastQuery("DELETE FROM tbl_evaluation_cach WHERE DATE(tbl_evaluation_cach.evalc_date)!='$date_clear' AND evalc_status='0'");
 ?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<style>
	/* Coded with love by Mutiullah Samim */
    body,
		html {
			margin: 0;
			padding: 0;
			height: 100%;
			background: #60a3bc !important;
		}
		.user_card {
			height: 400px;
			width: 350px;
			margin-top: auto;
			margin-bottom: auto;
			background: #f39c12;
			position: relative;
			display: flex;
			justify-content: center;
			flex-direction: column;
			padding: 10px;
			box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			-moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
			border-radius: 5px;

		}
		.brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			background: #60a3bc;
			padding: 10px;
			text-align: center;
		}
		.brand_logo {
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
		}
		.form_container {
			margin-top: 100px;
		}
		.login_btn {
			width: 100%;
			background: #c0392b !important;
			color: white !important;
		}
		.login_btn:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.login_container {
			padding: 0 2rem;
		}
		.input-group-text {
			background: #c0392b !important;
			color: white !important;
			border: 0 !important;
			border-radius: 0.25rem 0 0 0.25rem !important;
		}
		.input_user,
		.input_pass:focus {
			box-shadow: none !important;
			outline: 0px !important;
		}
		.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
			background-color: #c0392b !important;
		}
</style>
<!DOCTYPE html>
<html>
<title><?=$name_system?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/png" href="<?=base64_encode_image("../images/images_web/105719.jpg")?>"/>
<head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
<!--===============================================================================================-->
<script type="text/javascript" src="<?=base64_encode_jspath("../plugins/sweetalert_master/sweetalert.min.js")?>"></script>
<link rel="stylesheet" type="text/css" href="<?=base64_encode_css("../plugins/sweetalert_master/sweetalert.css")?>">

<script> 
function myFunction() {
    document.getElementById("form_login").submit();
}
</script>
</head>
<!--Coded with love by Mutiullah Samim-->
<body>
<?php  if(isset($alert_login_con))
    {
      ?>
      <script>
       swal("<?=$alert_login_con?>", "ปิดหน้าต่างนี้!", "error");
      </script>
  <?php } ?>
	
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
				
						<img src="<?=base64_encode_image("../images/images_web/logo1.PNG")?>" class="brand_logo" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form name="form_login" id="form_login" method="post" autocomplete="off">
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="loginname" class="form-control input_user" required placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="loginpass" class="form-control input_pass" required placeholder="password">
						</div>
						<div class="form-group">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" class="custom-control-input" id="customControlInline">
								<label class="custom-control-label" for="customControlInline">Remember me</label>
							</div>
						</div>
					</form>
				</div>
				<div class="d-flex justify-content-center mt-3 login_container">
					<button type="button" name="button" class="btn login_btn" onclick="myFunction()">Login</button>
				</div>
				
				<!-- <div class="mt-4">
					<div class="d-flex justify-content-center links">
						Don't have an account? <a href="#" class="ml-2">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links">
						<a href="#">Forgot your password?</a>
					</div>
				</div> -->
			</div>
		</div>
	</div>
</body>
</html>
