<?php
require_once("../config/dbl_config.php");
require_once('../class/class_query.php');
require_once("../class/class_function.php");
$sql_process = new function_query();

$table="tbl_evaluation_topic";
if(isset($_POST['btn-submit-add']) && strip_tags($_GET["form"])==1 )
{  
    $eltp_code = random_password(20);
    $eltp_name = strip_tags($_POST['eltp_name']);
    $eltp_description = isset($_POST['eltp_description']) ? $_POST['eltp_description'] : FALSE;
    $eltp_status_topic = strip_tags($_POST['eltp_status_topic']);
    $eltp_suggestion = strip_tags($_POST['eltp_suggestion']);
    $eltp_remark = strip_tags($_POST['eltp_remark']);
    $eltp_status = strip_tags($_POST['eltp_status']);
    $crt_by=strip_tags($_POST['crt_by']);
    $cmn_code=strip_tags($_POST['cmn_code']);
    $crt_date=date("Y-m-d H:i:s");
    
  $fields = [
    'eltp_code' => $eltp_code,
    'eltp_name' => $eltp_name,
    'eltp_description' => $eltp_description,
    'eltp_status_topic' => $eltp_status_topic,
    'eltp_suggestion' => $eltp_suggestion,
    'eltp_remark' => $eltp_remark,
    'crt_by' => $crt_by,
    'crt_date' => $crt_date,
    'upd_by' => $crt_by,
    'eltp_status' => $eltp_status,
    'cmn_code' => $cmn_code
];

try {

    /*
     * Have used the word 'object' as I could not see the actual 
     * class name.
     */
    $sql_process->insert($table, $fields);
  
   
  }catch(ErrorException $exception) {
  
     $exception->getMessage();  // Should be handled with a proper error message.
  
  }

  /////เพิ่มส่วนเสริม
  if(isset($_POST['eta']) && !empty($_POST['eta'])){
    $count=count($_POST['eta']);
    for($i=0;$i<$count;$i++){
     $eta=$_POST['eta'][$i];
     $array_eta= explode(".",$eta);
      $eta_level=$array_eta[0];
      $eta_addon=$array_eta[1];
      $sql_process->fastQuery("INSERT INTO tbl_evaluation_topic_addon (eta_level,eta_addon,eltp_code,cmn_code) VALUES('$eta_level','$eta_addon','$eltp_code','$cmn_code')");

    } 
}
  // echo "<script>";
  // echo "location.href = '$actual_link_site/index/?zone=EvaluationForm2&eltp=$eltp_code'";
  // echo "</script>";
  $url="$actual_link_site/index/?zone=EvaluationForm2&eltp=$eltp_code";
	header("Location: $url");
}

if(isset($_POST['btn-submit-edit']))
{  
    $eltp_code = strip_tags($_POST['eltp_code']);
    $eltp_name = strip_tags($_POST['eltp_name']);
    $eltp_description = isset($_POST['eltp_description']) ? $_POST['eltp_description'] : FALSE;
    $eltp_status_topic = strip_tags($_POST['eltp_status_topic']);
    $eltp_suggestion = strip_tags($_POST['eltp_suggestion']);
    $eltp_remark = strip_tags($_POST['eltp_remark']);
    $eltp_status_topic_before = strip_tags($_POST['eltp_status_topic_before']);
    $eltp_status = strip_tags($_POST['eltp_status']);
    $upd_by=strip_tags($_POST['upd_by']);
    $cmn_code=strip_tags($_POST['cmn_code']);
  $fields = [
    'eltp_name' => $eltp_name,
    'eltp_description' => $eltp_description,
    'eltp_status_topic' => $eltp_status_topic,
    'eltp_suggestion' => $eltp_suggestion,
    'eltp_remark' => $eltp_remark,
    'eltp_status' => $eltp_status,
    'upd_by' => $upd_by
];
$Where=['eltp_code' => $eltp_code];
try {

    /*
     * Have used the word 'object' as I could not see the actual 
     * class name.
     */
    $sql_process->update($table, $fields,$Where);
  
   
  }catch(ErrorException $exception) {
  
     $exception->getMessage();  // Should be handled with a proper error message.
  
  }

//   ตรวจสอบว่าส่วนการประเมินนี้เคยกำหนดมาแล้วหรือไม่ ถ้าไม่ให้ทำการลบการกำหนดสิทธิ์ทิ้ง
 if($eltp_status_topic != $eltp_status_topic_before){
    $sql_process->fastQuery("DELETE FROM tbl_evaluation_permission WHERE  eltp_code ='$eltp_code'"); 
 }
 $sql_process->fastQuery("DELETE FROM tbl_evaluation_topic_addon WHERE  eltp_code ='$eltp_code'"); 
   /////เพิ่มส่วนเสริม
   if(isset($_POST['eta']) && !empty($_POST['eta'])){
    
    $count=count($_POST['eta']);
    for($i=0;$i<$count;$i++){
     $eta=$_POST['eta'][$i];
     $array_eta= explode(".",$eta);
      $eta_level=$array_eta[0];
      $eta_addon=$array_eta[1];
      $sql_process->fastQuery("INSERT INTO tbl_evaluation_topic_addon (eta_level,eta_addon,eltp_code,cmn_code) VALUES('$eta_level','$eta_addon','$eltp_code','$cmn_code')");

    } 
}

  // echo "<script>";
  // echo "location.href = '$actual_link_site/index/?zone=EvaluationForm2&eltp=$eltp_code'";
  // echo "</script>";
  $url="$actual_link_site/index/?zone=EvaluationForm2&eltp=$eltp_code";
	header("Location: $url");
}

///กำหนดสิทธิ์หมวดหมู่หลัก
//เพิ่มสิทธิ์
if(isset($_GET["evltp_code_add"]) && !empty($_GET["evltp_code_add"])){
    $evltp_code = strip_tags($_GET['evltp_code_add']);
    $eltp_code_get=strip_tags($_GET["eltp"]);
    $cmn_code=strip_tags($_GET["cmn_code"]);
    $chk_data =$sql_process->rowsQuery("SELECT evltp_code FROM tbl_evaluation_permission WHERE cmn_code='$cmn_code' AND eltp_code ='$eltp_code_get' AND evltp_code='$evltp_code'");
    if($chk_data<=0){
      $sql_process->fastQuery("INSERT INTO tbl_evaluation_permission (cmn_code,eltp_code,evltp_code) VALUES('$cmn_code','$eltp_code_get','$evltp_code')");
    }
    
    header('Location: '.$_SERVER['HTTP_REFERER']);
    }

    //ยกเลิกสิทธิ์
if(isset($_GET["evltp_code_del"]) && !empty($_GET["evltp_code_del"])){
    $eltp_code_get=strip_tags($_GET["eltp"]);
    $evltp_code = strip_tags($_GET['evltp_code_del']);
    $cmn_code=strip_tags($_GET["cmn_code"]);
      $sql_process->fastQuery("DELETE FROM tbl_evaluation_permission WHERE cmn_code='$cmn_code' AND eltp_code ='$eltp_code_get' AND evltp_code='$evltp_code'"); 
      header('Location: '.$_SERVER['HTTP_REFERER']);
    }

// กำหนดสิทธิ์แบบอัตโนมัติ 
// หมวดหมู่หลัก 
if(strip_tags($_GET["eltp_status_topic"]) == 2 && strip_tags($_GET["status"]) == "ADD"){
    $eltp_code_get=strip_tags($_GET["eltp"]);
    $cmn_code=strip_tags($_GET["cmn_code"]);
    $q=strip_tags($_GET["q"]);

//ถ้ามีการค้นหา
if($q != NULL ){
    $stateSQL="AND tbl_category_main.ctgm_name LIKE '%$q%'";
  }else{
    $stateSQL=NULL;
  }
 
        $qgX = $sql_process->runQuery(
          "SELECT
        tbl_category_main.ctgm_code
          FROM
          tbl_category_main 
          WHERE
          tbl_category_main.ctgm_status = '1' AND
          tbl_category_main.is_delete = '1' AND
          tbl_category_main.cmn_code=:cmn_code_param
          $stateSQL
          ORDER BY
          tbl_category_main.ctgm_id DESC
          ");
          $qgX->execute(array(":cmn_code_param"=>$cmn_code));
          while($rowDataX= $qgX->fetch(PDO::FETCH_OBJ)) {
      
        $evltp_code =$rowDataX->ctgm_code;
        $chk_data =$sql_process->rowsQuery("SELECT evltp_code FROM tbl_evaluation_permission WHERE cmn_code='$cmn_code' AND eltp_code ='$eltp_code_get' AND evltp_code='$evltp_code'");
        if($chk_data<=0){
          $sql_process->fastQuery("INSERT INTO tbl_evaluation_permission (cmn_code,eltp_code,evltp_code) VALUES('$cmn_code','$eltp_code_get','$evltp_code')");
        }
        
        }
        header('Location: '.$_SERVER['HTTP_REFERER']);


// หมวดหมู่ย่อย
}elseif(strip_tags($_GET["eltp_status_topic"]) == 3  && strip_tags($_GET["status"]) == "ADD"){
  $eltp_code_get=strip_tags($_GET["eltp"]);
  $cmn_code=strip_tags($_GET["cmn_code"]);
  $q=strip_tags($_GET["q"]);
//ถ้ามีการค้นหา
if($q != NULL ){
  $stateSQL="AND (tbl_category_sub.ctgs_name LIKE '%$q%' OR tbl_category_main.ctgm_name LIKE '%$q%')";
}else{
  $stateSQL=NULL;
}

  $qgX = $sql_process->runQuery(
    "SELECT
  tbl_category_sub.ctgs_code
    FROM
    tbl_category_sub ,
    tbl_category_main
    WHERE
    tbl_category_sub.ctgm_code=tbl_category_main.ctgm_code AND
    tbl_category_sub.ctgs_status = '1' AND
    tbl_category_sub.is_delete = '1' AND
    tbl_category_sub.cmn_code=:cmn_code_param
    $stateSQL
    ORDER BY
    tbl_category_sub.ctgs_id DESC
    ");
    $qgX->execute(array(":cmn_code_param"=>$cmn_code));
    while($rowDataX= $qgX->fetch(PDO::FETCH_OBJ)) {

  $evltp_code =$rowDataX->ctgs_code;
  $chk_data =$sql_process->rowsQuery("SELECT evltp_code FROM tbl_evaluation_permission WHERE cmn_code='$cmn_code' AND eltp_code ='$eltp_code_get' AND evltp_code='$evltp_code'");
  if($chk_data<=0){
    $sql_process->fastQuery("INSERT INTO tbl_evaluation_permission (cmn_code,eltp_code,evltp_code) VALUES('$cmn_code','$eltp_code_get','$evltp_code')");
  }
  
  }
  header('Location: '.$_SERVER['HTTP_REFERER']);

  // ผู้คน
} elseif(strip_tags($_GET["eltp_status_topic"]) == 4  && strip_tags($_GET["status"]) == "ADD"){
  $eltp_code_get=strip_tags($_GET["eltp"]);
  $cmn_code=strip_tags($_GET["cmn_code"]);
  $q=strip_tags($_GET["q"]);

//ถ้ามีการค้นหา
if($q != NULL ){
  $stateSQL="AND (tbl_user.user_firstname LIKE '%$q%' OR tbl_user.user_lastname LIKE '%$q%' OR tbl_category_main.ctgm_name LIKE '%$q%' OR tbl_category_sub.ctgs_name LIKE '%$q%')";
}else{
  $stateSQL=NULL;
}

  $qgX = $sql_process->runQuery(
    "SELECT
    tbl_user.user_code
    FROM
    tbl_user ,
    tbl_user_detail ,
    tbl_category_main ,
    tbl_category_sub
    WHERE
    tbl_user.is_delete = '1' AND
    tbl_user.user_status = '3' AND
    tbl_user.user_code = tbl_user_detail.user_code AND
    tbl_user_detail.ctgm_code = tbl_category_main.ctgm_code AND
    tbl_user_detail.ctgs_code = tbl_category_sub.ctgs_code AND
    tbl_user_detail.cmn_code=:cmn_code_param
    $stateSQL
    ORDER BY
    tbl_user.user_firstname ASC
      ");
      $qgX->execute(array(":cmn_code_param"=>$cmn_code));
      while($rowDataX= $qgX->fetch(PDO::FETCH_OBJ)) {
  
    $evltp_code =$rowDataX->user_code;
  $chk_data =$sql_process->rowsQuery("SELECT evltp_code FROM tbl_evaluation_permission WHERE cmn_code='$cmn_code' AND eltp_code ='$eltp_code_get' AND evltp_code='$evltp_code'");
  if($chk_data<=0){
    $sql_process->fastQuery("INSERT INTO tbl_evaluation_permission (cmn_code,eltp_code,evltp_code) VALUES('$cmn_code','$eltp_code_get','$evltp_code')");
  }
  
  }
  header('Location: '.$_SERVER['HTTP_REFERER']);
} 





// ยกเลิกสิทธิ์แบบอัตโนมัติ
// หมวดหมู่หลัก 
if(strip_tags($_GET["eltp_status_topic"]) == 2 && strip_tags($_GET["status"]) == "DEL"){
  $eltp_code_get=strip_tags($_GET["eltp"]);
  $cmn_code=strip_tags($_GET["cmn_code"]);
  $q=strip_tags($_GET["q"]);

//ถ้ามีการค้นหา
if($q != NULL ){
  $stateSQL="AND tbl_category_main.ctgm_name LIKE '%$q%'";
}else{
  $stateSQL=NULL;
}

      $qgX = $sql_process->runQuery(
        "SELECT
      tbl_category_main.ctgm_code
        FROM
        tbl_category_main ,
        tbl_evaluation_permission
        WHERE
        tbl_category_main.ctgm_code= tbl_evaluation_permission.evltp_code AND
        tbl_category_main.ctgm_status = '1' AND
        tbl_category_main.is_delete = '1' AND
        tbl_category_main.cmn_code=:cmn_code_param
        $stateSQL
        ORDER BY
        tbl_category_main.ctgm_id DESC
        ");
        $qgX->execute(array(":cmn_code_param"=>$cmn_code));
        while($rowDataX= $qgX->fetch(PDO::FETCH_OBJ)) {
    
      $sql_process->fastQuery("DELETE FROM tbl_evaluation_permission WHERE cmn_code='$cmn_code' AND eltp_code ='$eltp_code_get' AND evltp_code='$rowDataX->ctgm_code'"); 
      }
      header('Location: '.$_SERVER['HTTP_REFERER']);


// หมวดหมู่ย่อย
}elseif(strip_tags($_GET["eltp_status_topic"]) == 3  && strip_tags($_GET["status"]) == "DEL"){
  $eltp_code_get=strip_tags($_GET["eltp"]);
  $cmn_code=strip_tags($_GET["cmn_code"]);
  $q=strip_tags($_GET["q"]);
//ถ้ามีการค้นหา
if($q != NULL ){
  $stateSQL="AND (tbl_category_sub.ctgs_name LIKE '%$q%' OR tbl_category_main.ctgm_name LIKE '%$q%')";
}else{
  $stateSQL=NULL;
}

  $qgX = $sql_process->runQuery(
    "SELECT
  tbl_category_sub.ctgs_code
    FROM
    tbl_category_sub ,
    tbl_category_main,
    tbl_evaluation_permission
    WHERE
    tbl_category_sub.ctgs_code= tbl_evaluation_permission.evltp_code AND
    tbl_category_sub.ctgm_code=tbl_category_main.ctgm_code AND
    tbl_category_sub.ctgs_status = '1' AND
    tbl_category_sub.is_delete = '1' AND
    tbl_category_sub.cmn_code=:cmn_code_param
    $stateSQL
    ORDER BY
    tbl_category_sub.ctgs_id DESC
    ");
    $qgX->execute(array(":cmn_code_param"=>$cmn_code));
    while($rowDataX= $qgX->fetch(PDO::FETCH_OBJ)) {
      $sql_process->fastQuery("DELETE FROM tbl_evaluation_permission WHERE cmn_code='$cmn_code' AND eltp_code ='$eltp_code_get' AND evltp_code='$rowDataX->ctgs_code'"); 
  }
  header('Location: '.$_SERVER['HTTP_REFERER']);

    // ผู้คน
} elseif(strip_tags($_GET["eltp_status_topic"]) == 4  && strip_tags($_GET["status"]) == "DEL"){
  $eltp_code_get=strip_tags($_GET["eltp"]);
  $cmn_code=strip_tags($_GET["cmn_code"]);
  $q=strip_tags($_GET["q"]);

//ถ้ามีการค้นหา
if($q != NULL ){
  $stateSQL="AND (tbl_user.user_firstname LIKE '%$q%' OR tbl_user.user_lastname LIKE '%$q%' OR tbl_category_main.ctgm_name LIKE '%$q%' OR tbl_category_sub.ctgs_name LIKE '%$q%')";
}else{
  $stateSQL=NULL;
}

  $qgX = $sql_process->runQuery(
    "SELECT
    tbl_user.user_code
    FROM
    tbl_user ,
    tbl_user_detail ,
    tbl_category_main ,
    tbl_category_sub,
    tbl_evaluation_permission
    WHERE
    tbl_user.user_code= tbl_evaluation_permission.evltp_code AND
    tbl_user.is_delete = '1' AND
    tbl_user.user_status = '3' AND
    tbl_user.user_code = tbl_user_detail.user_code AND
    tbl_user_detail.ctgm_code = tbl_category_main.ctgm_code AND
    tbl_user_detail.ctgs_code = tbl_category_sub.ctgs_code AND
    tbl_user_detail.cmn_code=:cmn_code_param
    $stateSQL
    ORDER BY
    tbl_user.user_firstname ASC
      ");
      $qgX->execute(array(":cmn_code_param"=>$cmn_code));
      while($rowDataX= $qgX->fetch(PDO::FETCH_OBJ)) {
        $sql_process->fastQuery("DELETE FROM tbl_evaluation_permission WHERE cmn_code='$cmn_code' AND eltp_code ='$eltp_code_get' AND evltp_code='$rowDataX->user_code'"); 
  }
  header('Location: '.$_SERVER['HTTP_REFERER']);
} 


///เนื้อหาประเมิน
if(isset($_POST["eltda_name"]) && !empty($_POST["eltda_name"])){
  $eltp_code = strip_tags($_POST['eltp_code']);
  $eltda_name = strip_tags(addslashes($_POST['eltda_name']));
  $cmn_code = strip_tags($_POST['cmn_code']);
  $Count_Data=$sql_process->rowsQuery("SELECT eltda_id FROM tbl_evaluation_data WHERE eltp_code='$eltp_code' AND cmn_code='$cmn_code'");
 $eltda_index=$Count_Data+1;
  $sql_process->fastQuery("INSERT INTO tbl_evaluation_data (eltda_name,eltda_index,eltp_code,cmn_code) VALUES('$eltda_name','$eltda_index','$eltp_code','$cmn_code')");
  header('Location: '.$_SERVER['HTTP_REFERER']);

}