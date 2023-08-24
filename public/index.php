<?php

require_once("../config/dbl_config.php");
require_once("../class/class_function.php");
require_once('../class/class_query.php');

session_start();
ob_start();

$sql_process = new function_query();

///ภาษา
require_once('set_language.php');

///ตัวแปรที่รับมา
$date_current=date("Y-m-d");
$eltp_code_get=isset($_GET['eltp']) ? $_GET['eltp'] : NULL;  /////โค้ดหัวข้อแบบประเมิน
$evltp_code_get = isset($_GET['evltp']) ? $_GET['evltp'] : NULL; ///ใช้แทน user_code,ctgm_code,ctgs_code	
$cre_evalc_code_session = isset($_SESSION['cre_evalc_code']) ? $_SESSION['cre_evalc_code'] : NULL;

$url="$actual_link_site/m/?eltp=$eltp_code_get&evltp=$evltp_code_get";
////ตรวจสอบอุปกรณ์ถ้าเป็นโทรศัพท์ให้ทำงานทันที
if(isMobile()){
    header("Location:$url");	
	exit(); 
	// echo "PHONE";
}

///หาผลการประเมิน ถ้ามีผลการประเมินมากกว่า 1 ในหนุ่งวันให้ลบ cach ออก
$cout_day=1;
$strNewDate = date ("Y-m-d", strtotime("-$cout_day day", strtotime($date_current)));
$chk_per_cach =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE DATE(evltp_date)='$strNewDate' ");
if($chk_per_cach>=1){
	$sql_process->fastQuery("DELETE FROM tbl_evaluation_cach WHERE DATE(evalc_date)='$strNewDate' AND evalc_status='0'");
}
////////
$stmt = $sql_process->runQuery("SELECT 
tbl_evaluation_topic.eltp_name,
tbl_evaluation_topic.eltp_status_topic,
tbl_company.cmn_code,
tbl_company.cmn_name,
tbl_company.cmn_logo 
FROM 
tbl_evaluation_topic ,
tbl_company
WHERE
tbl_evaluation_topic.cmn_code = tbl_company.cmn_code AND
tbl_evaluation_topic.eltp_code=:eltp_code_param ");
$stmt->execute(array(":eltp_code_param"=>$eltp_code_get));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
//Company Image
   if(!empty($dataRow["cmn_logo"])){
    $pathcompanyimg="../images/images_company/".$dataRow["cmn_logo"];
  }else{
    $pathcompanyimg="../images/images_web/no-logo.png";
  }
 $strFileImgCompany=base64_encode_image($pathcompanyimg);
 $cmn_codex=$dataRow["cmn_code"];
 $cmn_name=$dataRow["cmn_name"];
 require_once("select_general_data.php");
 $zone = isset($_GET['zone']) ? $_GET['zone'] : NULL;


$ipaddress = $_SERVER['REMOTE_ADDR']; //Get user IP 
$useragent=$_SERVER['HTTP_USER_AGENT']; //อุปกรณ์
if(!isset($_GET['cre_evalc_code']) && $cre_evalc_code_session==NULL){
	$cre_evalc_code =random_password(20);
	$_SESSION['cre_evalc_code']=$cre_evalc_code;
	echo "<script>";
  echo "location.href = '?eltp=$eltp_code_get&evltp=$evltp_code_get&cre_evalc_code=$cre_evalc_code'";
  echo "</script>";
}

$evalc_code=$_SESSION['cre_evalc_code'];
if($evalc_code==NULL){
  $cre_evalc_code =random_password(20);
  $_SESSION['cre_evalc_code']=$cre_evalc_code;
  $url="?eltp=$eltp_code_get&evltp=$evltp_code_get&cre_evalc_code=$cre_evalc_code";
  header("Location: $url");
}

$actual_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?> 

<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=$name_system?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
<link rel="icon" type="image/png" href="<?=base64_encode_image("../images/images_web/105719.jpg")?>"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base64_encode_css("../plugins/Css_public/vendor/bootstrap/css/bootstrap.min.css")?>">
<!--===============================================================================================-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base64_encode_css("../plugins/Css_public/vendor/animate/animate.css")?>">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="<?=base64_encode_css("../plugins/Css_public/vendor/css-hamburgers/hamburgers.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base64_encode_css("../plugins/Css_public/vendor/select2/select2.min.css")?>">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="<?=base64_encode_css("../plugins/Css_public/css/util.css")?>">
	<link rel="stylesheet" type="text/css" href="<?=base64_encode_css("../plugins/Css_public/css/main.css")?>">
<!--===============================================================================================-->
<link rel="stylesheet" href="<?=base64_encode_css("../plugins/checkboxes.css")?>">
<link rel="stylesheet" href="<?=base64_encode_css("../plugins/lightbox2-master/dist/css/lightbox.min.css")?>">
<link rel="stylesheet" href="<?=base64_encode_css("../plugins/image_circle.css")?>">
<!-- select2 -->
<link href="<?=base64_encode_css("../plugins/select2-bootstrap4-theme-master/libs/select2.min.css")?>" rel="stylesheet" />
 <!-- select2-bootstrap4-theme -->
 <link href="<?=base64_encode_css("../plugins/select2-bootstrap4-theme-master/dist/select2-bootstrap4.min.css")?>" rel="stylesheet"> 
 <link href="<?=base64_encode_css("../plugins/select2-bootstrap4-theme-master/dist/select2-bootstrap4.css")?>" rel="stylesheet"> 
 <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
 <style>

body {

                font-family: 'Kanit', sans-serif;
                
            }
						h1 {
                font-family: 'Kanit', sans-serif;
            }
						h2 {
                font-family: 'Kanit', sans-serif;
            }
						h3 {
                font-family: 'Kanit', sans-serif;
            }
						h4 {
                font-family: 'Kanit', sans-serif;
            }
            h5 {
                font-family: 'Kanit', sans-serif;
            }
            span {
                font-family: 'Kanit', sans-serif;
              
			}
      div.frame3 {
  border:5px solid #F3E3D9;
  padding:1px;
  background-color:black;
}
</style>
</head>
<body style="background-color: #FFB85A;">
<script>
function check1() {
    document.getElementById("evalc_value_1").checked = true;
    document.getElementById("evalc_value_2").checked = false;
    document.getElementById("evalc_value_3").checked = false;
		document.getElementById("evalc_value_4").checked = false;
		document.getElementById("evalc_value_5").checked = false;
}
function check2() {
    document.getElementById("evalc_value_1").checked = false;
    document.getElementById("evalc_value_2").checked = true;
    document.getElementById("evalc_value_3").checked = false;
		document.getElementById("evalc_value_4").checked = false;
		document.getElementById("evalc_value_5").checked = false;
}
function check3() {
    document.getElementById("evalc_value_1").checked = false;
    document.getElementById("evalc_value_2").checked = false;
    document.getElementById("evalc_value_3").checked = true;
		document.getElementById("evalc_value_4").checked = false;
		document.getElementById("evalc_value_5").checked = false;
}
function check4() {
    document.getElementById("evalc_value_1").checked = false;
    document.getElementById("evalc_value_2").checked = false;
    document.getElementById("evalc_value_3").checked = false;
		document.getElementById("evalc_value_4").checked = true;
		document.getElementById("evalc_value_5").checked = false;
}
function check5() {
    document.getElementById("evalc_value_1").checked = false;
    document.getElementById("evalc_value_2").checked = false;
    document.getElementById("evalc_value_3").checked = false;
		document.getElementById("evalc_value_4").checked = false;
		document.getElementById("evalc_value_5").checked = true;
}
</script>
	<div class="limiter">
 
		<div class="container-login100">
      
			<div class="wrap-login100">
      <table style="text-align: left; width: 100%;" border="0"
 cellpadding="2" cellspacing="2">
  <tbody>
    <tr align="center">
      <td > 
      <div class="frame3" style="height:80px; width:310px" ><img src="<?=$strFileImgCompany?>" style="height:70px; width:300px" /> </div> </td>
    </tr>
    <tr align="right">
      <td > 

      <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <img src="<?=base64_encode_image("../images/images_flag/$flag_user")?>"  style="height25px; width:30px;"  />  <?=$flag_name?>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
  <?php
$qgl = $sql_process->runQuery(
"SELECT
tbl_master_country.country_name,
tbl_master_country.country_flag,
tbl_master_country.country_id
FROM
tbl_master_country ,
tbl_system_language
WHERE 
tbl_master_country.country_id = tbl_system_language.country_id  AND
tbl_master_country.is_delete='1'  AND
tbl_master_country.country_status='1' 
GROUP BY
tbl_system_language.country_id
ORDER BY
tbl_master_country.country_id ASC

");
$qgl->execute();
while($lanData= $qgl->fetch(PDO::FETCH_OBJ)) {
  $path_flag=base64_encode_image("../images/images_flag/$lanData->country_flag")
?>
    <button class="dropdown-item" type="button" onclick="window.location.href='Choose_language.php?setlanguage=<?=$lanData->country_id?>'" >
    <img src="<?=$path_flag?>"  style="height25px; width:30px;"  />  <?=$lanData->country_name?>
  </button>
<?php } ?>
  </div>
</div>

<br>
      
    </td>
    </tr>
  </tbody>
</table>


<?php
// echo  $evalc_code;
switch($dataRow['eltp_status_topic']) {
    case "1" : require("public_2_Company.php");
    break;
    case "2" : require("public_2_CategoryMain.php");
    break;
    case "3" : require("public_2_CategorySub.php");
    break;
    case "4" : require("public_2_Personal.php");
    break;
}
?>

			
                

			</div>
		</div>
	</div>
	
	

<!--===============================================================================================-->	
	<script src="<?=base64_encode_jspath("../plugins/Css_public/vendor/jquery/jquery-3.2.1.min.js")?>"></script>
<!--===============================================================================================-->
<script src="<?=base64_encode_jspath("../plugins/Css_public/vendor/bootstrap/js/popper.js")?>"></script>
<script src="<?=base64_encode_jspath("../plugins/Css_public/vendor/bootstrap/js/bootstrap.min.js")?>"></script>
<!--===============================================================================================-->

<script src="<?=base64_encode_jspath("../plugins/Css_public/vendor/select2/select2.min.js")?>"></script>
<!--===============================================================================================-->
<script src="<?=base64_encode_jspath("../plugins/Css_public/vendor/tilt/tilt.jquery.min.js")?>"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
<script src="<?=base64_encode_jspath("../plugins/Css_public/js/main.js")?>"></script>
<script src="<?=base64_encode_jspath("../plugins/lightbox2-master/dist/js/lightbox-plus-jquery.min.js")?>"></script>
<!-- select2 -->
<script src="<?=base64_encode_jspath("../plugins/select2-bootstrap4-theme-master/libs/select2.min.js")?>"></script>
  <!-- select2-bootstrap4-theme -->
<script src="<?=base64_encode_jspath("../plugins/select2-bootstrap4-theme-master/docs/script.js")?>"></script>
</body>
</html>