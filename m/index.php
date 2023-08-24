<?php
///ตัวแปรที่รับมา
$eltp_code_get=isset($_GET['eltp']) ? $_GET['eltp'] : NULL;  /////โค้ดหัวข้อแบบประเมิน
$evltp_code_get = isset($_GET['evltp']) ? $_GET['evltp'] : NULL; ///ใช้แทน user_code,ctgm_code,ctgs_code	
if($eltp_code_get==NULL ){
	exit(); 
}
require_once("../config/dbl_config.php");
require_once("../class/class_function.php");
require_once('../class/class_query.php');
session_start();
ob_start();
$date_current=date("Y-m-d");
$sql_process = new function_query();
$cre_evalc_code_session = isset($_SESSION['cre_evalc_code']) ? $_SESSION['cre_evalc_code'] : NULL;

///ภาษา
require_once('set_language.php');

$url="$actual_link_site/public/?eltp=$eltp_code_get&evltp=$evltp_code_get";
//ตรวจสอบอุปกรณ์ถ้าไม่ใช่โทรศัพท์ให้ทำงานทันที
if(!isMobile()){
    header("Location:$url");	
	exit(); 
	// echo "PC";
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
//  $strFileImgCompany=base64_encode_image($pathcompanyimg);
 $cmn_codex=$dataRow["cmn_code"];
 $cmn_name=$dataRow["cmn_name"];
 require_once("select_general_data.php");
 $zone = isset($_GET['zone']) ? $_GET['zone'] : NULL;


$ipaddress = $_SERVER['REMOTE_ADDR']; //Get user IP 
$useragent=$_SERVER['HTTP_USER_AGENT']; //อุปกรณ์
if(!isset($_GET['cre_evalc_code']) && $cre_evalc_code_session==NULL){
	$cre_evalc_code =random_password(20);
	$_SESSION['cre_evalc_code']=$cre_evalc_code;
	// echo "<script>";
  // echo "location.href = '?eltp=$eltp_code_get&evltp=$evltp_code_get&cre_evalc_code=$cre_evalc_code'";
  // echo "</script>";
  $url="?eltp=$eltp_code_get&evltp=$evltp_code_get&cre_evalc_code=$cre_evalc_code";
  header("Location: $url");
}

$evalc_code=$_SESSION['cre_evalc_code'];
if($evalc_code==NULL){
  $cre_evalc_code =random_password(20);
  $_SESSION['cre_evalc_code']=$cre_evalc_code;
  $url="?eltp=$eltp_code_get&evltp=$evltp_code_get&cre_evalc_code=$cre_evalc_code";
  header("Location: $url");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?=$name_system?></title>
  <meta charset="UTF-8">


	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="../images/images_web/105719.jpg"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">


<link rel="stylesheet" href="../plugins/image_circle.css">

<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">




  
<style>
#box_css3_raduis {
    border:solid 1px #ffffff;
    width:100%;
    height:100%;
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:25px;
	background:#ffffff;
	padding:20px;

}
body {
	padding:20px;
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
      /* Dropdown Menu */
      .dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
</style>
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
</head>
<body style="background-color: #FFB85A;">




<div align="right">

<div class="dropdown">
  <button class="dropbtn">
  <img src="../images/images_flag/<?=$flag_user?>"  style="height25px; width:30px;"  />  <?=$flag_name?>
  </button>

  <div class="dropdown-content" align="left">
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
  // $path_flag=base64_encode_image("../images/images_flag/$lanData->country_flag")
  $path_flag="../images/images_flag/$lanData->country_flag";
?>

  <a href="Choose_language.php?setlanguage=<?=$lanData->country_id?>">
  <img src="<?=$path_flag?>"  style="height25px; width:30px;"  />  <?=$lanData->country_name?>
</a>
<?php } ?>
  </div>

</div>

</div>

<div align="center"> <img style="display: block; margin: auto;height:100px; width:100px;" src="<?=$pathcompanyimg?>" class="circle" /></div>


	<?php
// echo  $evalc_code;
switch($dataRow['eltp_status_topic']) {
    case "1" : require("m_2_Company.php");
    break;
    case "2" : require("m_2_CategoryMain.php");
    break;
    case "3" : require("m_2_CategorySub.php");
    break;
    case "4" : require("m_2_Personal.php");
    break;
}
?>
<br>
<table style="text-align: left; width: 100%;" border="0"
 cellpadding="0" cellspacing="0">
  <tbody>
    <tr valign="bottom">
      <td align="left"><img style="display: block; margin: auto;height:75px; width:75px;" src="../images/images_web/Q_Serve.png"  /></td>
      <td  align="right"><p>&copy; Copyright by ID Drives<p>
        <p><?=$version?></p>
      </td>
    </tr>
  </tbody>
</table>


</body>
</html>