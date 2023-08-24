<?php
$stmt1 = $sql_process->runQuery("SELECT
tbl_evaluation_permission.evltp_id,
tbl_evaluation_permission.cmn_code,
tbl_evaluation_permission.eltp_code,
tbl_evaluation_permission.evltp_code,
tbl_evaluation_topic.eltp_name,
tbl_evaluation_topic.eltp_status_topic,
tbl_category_sub.ctgs_name,
tbl_category_main.ctgm_name
FROM
tbl_evaluation_permission ,
tbl_evaluation_topic ,
tbl_category_sub,
tbl_category_main
WHERE
tbl_evaluation_permission.eltp_code = tbl_evaluation_topic.eltp_code AND
tbl_evaluation_permission.evltp_code = tbl_category_sub.ctgs_code AND
tbl_category_main.ctgm_code = tbl_category_sub.ctgm_code AND
tbl_category_sub.ctgs_code=:ctgs_code_param AND
tbl_evaluation_permission.eltp_code=:eltp_code_param  ");
$stmt1->execute(array(":eltp_code_param"=>$eltp_code_get,":ctgs_code_param"=>$evltp_code_get));
$dataRow1=$stmt1->fetch(PDO::FETCH_ASSOC);
$Chk_data=$stmt1->rowCount();
$ctgs_name=$dataRow1['ctgs_name'];
$ctgm_name=$dataRow1['ctgm_name'];
$eltp_name=$dataRow1['eltp_name'];

$text_send="$cmn_name
$ctgm_name_main_x : $ctgm_name
$ctgs_name_main_x : $ctgs_name
$eltp_name";
$cgimg_name1= $sql_process->QueryField1("tbl_category_img","cgimg_name","cgimg_code='$evltp_code_get'");
//user Image
   if(!empty($cgimg_name1)){
    $pathuserimg="../images/images_catagory/".$cgimg_name1;
  }else{
    $pathuserimg="../images/images_web/1547020644No_Image_Available.jpg";
  }
  $strFileImg=base64_encode_image($pathuserimg);

    if($Chk_data <=0){
   include ("m_2_CategorySubAll.php");
    }elseif(!isset($_GET["zone"])){
   include ("m_2_CategorySubEvaTopic.php");
   }else{
   switch($_GET["zone"]) {
   case "EvaTopic" : include ("m_2_CategorySubEvaTopic.php");
   break;
   case "EvaStart" : include ("m_2_EvaStart.php");
   break;
   case "EvaAddScore" : include ("m_2_avgScore.php");
   break;
   case "last_step" : include ("m_2_last_step.php");
   break;
   default :  include ("m_2_CategorySubEvaTopic.php");
     }
   }

// echo $Chk_data;
	
            
