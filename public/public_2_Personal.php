<?php
$stmt1 = $sql_process->runQuery("SELECT
tbl_evaluation_permission.evltp_id,
tbl_evaluation_permission.cmn_code,
tbl_evaluation_permission.eltp_code,
tbl_evaluation_permission.evltp_code,
tbl_evaluation_topic.eltp_name,
tbl_evaluation_topic.eltp_status_topic,
tbl_user.user_firstname,
tbl_user.user_lastname,
tbl_user.user_img,
tbl_category_main.ctgm_name,
tbl_category_sub.ctgs_name
FROM
tbl_evaluation_permission ,
tbl_evaluation_topic ,
tbl_user,
tbl_user_detail ,
tbl_category_main ,
tbl_category_sub
WHERE
tbl_evaluation_permission.eltp_code = tbl_evaluation_topic.eltp_code AND
tbl_evaluation_permission.evltp_code = tbl_user.user_code AND
tbl_user.user_code = tbl_user_detail.user_code AND
tbl_user.user_code=:user_code_param AND
tbl_user_detail.ctgm_code = tbl_category_main.ctgm_code AND
tbl_user_detail.ctgs_code = tbl_category_sub.ctgs_code AND
tbl_evaluation_permission.eltp_code=:eltp_code_param ");
$stmt1->execute(array(":eltp_code_param"=>$eltp_code_get,":user_code_param"=>$evltp_code_get));
$dataRow1=$stmt1->fetch(PDO::FETCH_ASSOC);
$Chk_data=$stmt1->rowCount();
$eltp_name=$dataRow1['eltp_name'];
$user_firstname=$dataRow1['user_firstname'];
$user_lastname=$dataRow1['user_lastname'];
$ctgm_name=$dataRow1['ctgm_name'];
$ctgs_name=$dataRow1['ctgs_name'];
$text_send="$cmn_name
$ctgm_name_main_x : $ctgm_name
$ctgs_name_main_x : $ctgs_name
$user_firstname $user_lastname
$eltp_name
";
//user Image
   if(!empty($dataRow1["user_img"])){
    $pathuserimg="../images/images_user/".$dataRow1["user_img"];
  }else{
    $pathuserimg="../images/images_web/user.png";
  }
  $strFileImg=base64_encode_image($pathuserimg);

    if($Chk_data <=0){
   include ("public_2_PersonalAll.php");
    }elseif(!isset($_GET["zone"])){
   include ("public_2_PersonalEvaTopic.php");
   }else{
   switch($_GET["zone"]) {
   case "EvaTopic" : include ("public_2_PersonalEvaTopic.php");
   break;
   case "EvaStart" : include ("public_2_PersonalEvaStart.php");
   break;
   case "EvaAddScore" : include ("public_2_avgScore.php");
   break;
   case "last_step" : include ("public_2_last_step.php");
   break;
   default :  include ("public_2_PersonalEvaTopic.php");
     }
   }

// echo $Chk_data;
	
            
