<?php
require_once("../config/dbl_config.php");
require_once('../class/class_query.php');
require_once("../class/class_function.php");
$sql_process = new function_query();
require_once('../class/class_user.php');
$auth_user = new USER();

$ipaddress = $_SERVER['REMOTE_ADDR']; //Get user IP 
$useragent=$_SERVER['HTTP_USER_AGENT']; //อุปกรณ์
$table="tbl_evaluation_cach";
if(isset($_POST['evalc_value']) && !empty($_POST['evalc_value'])){
$evalc_value=$_POST['evalc_value'];
$evalc_comment=isset($_POST['evalc_comment']) ? $_POST['evalc_comment'] : FALSE;
$eltda_id=strip_tags($_POST['eltda_id']);
$eltp_code=strip_tags($_POST['eltp']);
$evltp_code=strip_tags($_POST['evltp']);
$cmn_code=strip_tags($_POST['cmn_code']);
$evalc_code=strip_tags($_POST['evalc_code']);
$evalc_index=strip_tags($_POST['numpage']);
///เช็คว่าข้อนี้เคยทำหรือยัง
$chkansw_a =$sql_process->rowsQuery("SELECT eltp_code FROM tbl_evaluation_cach WHERE evalc_code ='$evalc_code' AND eltda_id='$eltda_id'  AND eltp_code ='$eltp_code' ");

  $count=count($evalc_value);
  for($i=0;$i<$count;$i++){
   $evalc_value_x = $evalc_value[$i];

  $fields = [
    'evalc_value' => $evalc_value_x,
    'evalc_comment' => $evalc_comment,
    'eltda_id' => $eltda_id,
    'eltp_code' => $eltp_code,
    'evltp_code' => $evltp_code,
    'cmn_code' => $cmn_code,
    'ip_device' => $ipaddress,
    'evalc_code'=> $evalc_code,
    'evalc_status'=>0,
    'evalc_index'=> $evalc_index
];

$fields1 = [
    'evalc_value' => $evalc_value_x,
    'evalc_comment' => $evalc_comment
];
$Where=['evalc_code' => $evalc_code,'eltda_id' => $eltda_id];
try {

    /*
     * Have used the word 'object' as I could not see the actual 
     * class name.
     */
    if($chkansw_a<=0){
        $sql_process->insert($table, $fields);
    }else{
        $sql_process->update($table, $fields1,$Where);
    }
   
  
    
   
  }catch(ErrorException $exception) {
  
     $exception->getMessage();  // Should be handled with a proper error message.
  
  }
  }
  echo "<script>";
  echo "location.href = '$actual_link_site/m/?zone=EvaStart&eltp=$eltp_code&evltp=$evltp_code'";
  echo "</script>";
// header('Location: '.$_SERVER['HTTP_REFERER']);


}elseif(isset($_POST['chktxt'])){
    // header('Location: '.$_SERVER['HTTP_REFERER']."&chktxt=".$_POST["chktxt"]);
    $eltp_code=strip_tags($_POST['eltp']);
$evltp_code=strip_tags($_POST['evltp']);
    $chktxt=strip_tags($_POST['chktxt']);
    $numpage=strip_tags($_POST['numpage']);
    echo "<script>";
    echo "location.href = '$actual_link_site/m/?zone=EvaStart&eltp=$eltp_code&evltp=$evltp_code&chktxt=$chktxt&numpage=$numpage'";
    echo "</script>";
}



if(isset($_POST["evltp_phone"]) && !empty($_POST["evltp_phone"])){
    $eltp_code=strip_tags($_POST['eltp']);
    $evltp_code=strip_tags($_POST['evltp']);
    $evalc_code=strip_tags($_POST['evalc_code']);
    $evltp_phone=strip_tags($_POST['evltp_phone']);
    $cmn_code=strip_tags($_POST['cmn_code']);
    $evltp_remark=isset($_POST['evltp_remark']) ? $_POST['evltp_remark'] : FALSE;
    $text_send_form=strip_tags($_POST['text_send']);
    $country_id=strip_tags($_POST['country_id']);
    $sql_process->fastQuery("UPDATE  tbl_evaluation_result SET evltp_phone='$evltp_phone' ,evltp_remark='$evltp_remark'  WHERE eltp_code='$eltp_code' AND evltp_code='$evltp_code'  AND evltp_user_code='$evalc_code'");
    $sql_process->fastQuery("UPDATE  tbl_evaluation_cach SET evalc_status='1'   WHERE evalc_status='0' AND eltp_code='$eltp_code' AND evltp_code='$evltp_code'  AND evalc_code='$evalc_code'");   
    ///Wording
    // คะแนน
    $txt1=$auth_user->mf("1P4XW0PEALXC62585AB",$country_id);
    // ความคิดเห็น
    $txt2=$auth_user->mf("ZDVME14A7RA7KCJ3G3RN",$country_id);
    // ข้อเสนอแนะ
    $txt3=$auth_user->mf("C1CYSHCU106Q3E6T33OP",$country_id);
    // เบอร์ติดต่อ
    $txt4=$auth_user->mf("VCI6ZNFHXRURL4L1FAWN",$country_id);
    ////เตรียมส่งไลน์
    $sql=NULL;
  
    $n=0;
    $total_data =$sql_process->rowsQuery("SELECT eltp_code FROM tbl_evaluation_topic_addon WHERE eltp_code ='$eltp_code'  AND eta_addon='2'");
    foreach ($sql_process->fechdata("tbl_evaluation_topic_addon","eltp_code ='$eltp_code'  AND eta_addon='2'") as $value)
    { 
        $n++;
     $eta_level= $value["eta_level"];

     if($n<$total_data){
        $sql.="(tbl_evaluation_data.cmn_code=:cmn_code_param AND tbl_evaluation_data.is_delete='1' AND tbl_evaluation_cach.eltda_id = tbl_evaluation_data.eltda_id AND tbl_evaluation_cach.evalc_code=:evalc_code_param AND tbl_evaluation_cach.eltp_code=:eltp_code_param AND tbl_evaluation_cach.evalc_value='$eta_level') OR";
     }else{
        $sql.="(tbl_evaluation_data.cmn_code=:cmn_code_param AND tbl_evaluation_data.is_delete='1' AND tbl_evaluation_cach.eltda_id = tbl_evaluation_data.eltda_id AND tbl_evaluation_cach.evalc_code=:evalc_code_param AND tbl_evaluation_cach.eltp_code=:eltp_code_param AND tbl_evaluation_cach.evalc_value='$eta_level')";
     }
    
    
     }
    //  echo $sql;
    
     //ถ้า ไม่มีเงื่อนไอะไร ไม่ต้องทำงาน
     if($sql!=NULL){
     $text_sent="
     $text_send_form";
     $qg = $sql_process->runQuery(
        "SELECT
      tbl_evaluation_cach.evalc_value,
tbl_evaluation_cach.evalc_comment,
tbl_evaluation_cach.evalc_index,
tbl_evaluation_data.eltda_name
        FROM
        tbl_evaluation_cach ,
tbl_evaluation_data
        WHERE
    
        
        $sql

GROUP BY
tbl_evaluation_cach.eltda_id
        ORDER BY
        tbl_evaluation_cach.evalc_id ASC
        ");
       $qg->execute(array(":cmn_code_param"=>$cmn_code,":evalc_code_param"=>$evalc_code,":eltp_code_param"=>$eltp_code));
       $total_data=$qg->rowCount();
        while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
            // $text_sent.="
            // $rowData->evalc_index.$rowData->eltda_name ($rowData->evalc_value คะแนน)
            // ความคิดเห็น $rowData->evalc_comment";

            $text_sent.="
            $rowData->evalc_index.$rowData->eltda_name ($rowData->evalc_value $txt1)
            $txt2 $rowData->evalc_comment";
        }

        
        // $text_sent.="
        // ข้อเสนอแนะ  $evltp_remark 
        // เบอร์ติดต่อ $evltp_phone";
        $text_sent.="
        $txt3  $evltp_remark 
        $txt4 $evltp_phone";
    unset($_SESSION['cre_evalc_code']);
    if($total_data>0){
      $token=  $sql_process->lookupfild("cmn_line","tbl_company","cmn_code","$cmn_code");
        send_line_notify($text_sent,$token);
    }
} 
    //echo $text_sent;
          // echo "<script>";
          // echo "location.href = '?eltp=$eltp_code'";
          // echo "</script>";
          $url="$actual_link_site/m/?zone=last_step&eltp=$eltp_code&evltp=$evltp_code";
         header("Location: $url");
    }