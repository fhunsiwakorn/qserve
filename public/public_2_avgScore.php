
<?php
$table="tbl_evaluation_result";
$stmt2 = $sql_process->runQuery("SELECT
AVG(evalc_value) AS evalc_value
FROM 
tbl_evaluation_cach 
WHERE
cmn_code=:cmn_code_param AND
eltp_code=:eltp_code_param AND
evltp_code=:evltp_code_param AND
ip_device='$ipaddress'
");
$stmt2->execute(array(":cmn_code_param"=>$cmn_codex,":eltp_code_param"=>$eltp_code_get,":evltp_code_param"=>$evltp_code_get));
$dataRow2=$stmt2->fetch(PDO::FETCH_ASSOC);
$evltr_avg=$dataRow2["evalc_value"];
$Chek_start =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='$evltp_code_get' AND  evltp_user_code='$evalc_code'");
$sql_process->fastQuery("UPDATE  tbl_evaluation_cach SET evalc_status='1'   WHERE evalc_status='0' AND eltp_code='$eltp_code_get' AND evltp_code='$evltp_code_get'  AND evalc_code='$evalc_code'");   
 if($Chek_start<=0){
  // evltp_user_code='$evalc_code'
    $fields = [
        'evltr_avg' => $evltr_avg,
        'cmn_code' => $cmn_codex,
        'eltp_code' => $eltp_code_get,
        'evltp_code' => $evltp_code_get,
        'evltp_phone' => FALSE,
        'evltp_remark' => FALSE,
        'evltp_ip' => $ipaddress,
        'evltp_user_agent' => $useragent,
        'evltp_user_code' => $evalc_code
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

//    echo "<meta http-equiv='refresh' content='3';url='?zone=EvaTopic&eltp=$eltp_code_get&evltp=$evltp_code_get'> ";
//    echo "<center>";
//    echo "<img src='$pathProgress' />";
//    echo "</center>";
    //   echo "<script>";
    //   echo "location.href = '?zone=EvaTopic&eltp=$eltp_code_get&evltp=$evltp_code_get'";
    //   echo "</script>";
 }
///$pathProgress=base64_encode_image("../images/images_web/loading.gif");
// echo "<meta http-equiv='refresh' content='1';url=?zone=EvaTopic&eltp=$eltp_code_get&evltp=$evltp_code_get'> ";
// echo "<meta http-equiv='refresh' content='3;URL=?zone=EvaTopic&eltp=$eltp_code_get&evltp=$evltp_code_get'>";
// echo "<center>";
// echo "<img src='$pathProgress' />";
// echo "</center>";
if(isset($_POST["evltp_phone"]) && !empty($_POST["evltp_phone"])){
  
$eltp_code=strip_tags($_POST['eltp']);
$evltp_code=strip_tags($_POST['evltp']);
$evltp_phone=strip_tags($_POST['evltp_phone']);
$text_send_form=strip_tags($_POST['text_send']);
$evltp_remark=isset($_POST['evltp_remark']) ? $_POST['evltp_remark'] : FALSE;
$sql_process->fastQuery("UPDATE  tbl_evaluation_result SET evltp_phone='$evltp_phone', evltp_remark='$evltp_remark'  WHERE eltp_code='$eltp_code' AND evltp_code='$evltp_code'  AND evltp_user_code='$evalc_code'");


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
   $qg->execute(array(":cmn_code_param"=>$cmn_codex,":evalc_code_param"=>$evalc_code,":eltp_code_param"=>$eltp_code));
   $total_data=$qg->rowCount();
    while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
        // $text_sent.="
        // $rowData->evalc_index.$rowData->eltda_name ($rowData->evalc_value คะแนน)
        // ความคิดเห็น $rowData->evalc_comment";
        $text_sent.="
        $rowData->evalc_index.$rowData->eltda_name ($rowData->evalc_value $txt13)
        $txt14 $rowData->evalc_comment";
    }

    
    // $text_sent.="
    // ข้อเสนอแนะ  $evltp_remark 
    // เบอร์ติดต่อ $evltp_phone";
    $text_sent.="
    $txt11  $evltp_remark 
    $txt12 $evltp_phone";
unset($_SESSION['cre_evalc_code']);
if($total_data>0){
  $token=  $sql_process->lookupfild("cmn_line","tbl_company","cmn_code","$cmn_codex");
    send_line_notify($text_sent,$token);
}
} 
      // echo "<script>";
      // echo "location.href = '?eltp=$eltp_code'";
      // echo "</script>";
      echo "<script>";
      echo "location.href = '?zone=last_step&eltp=$eltp_code&evltp=$evltp_code'";
      echo "</script>";
}

$chktype= $sql_process->lookupfild("eltp_suggestion","tbl_evaluation_topic","eltp_code","$eltp_code_get"); 
?>



<form method="post" style="width:100%;" autocomplete="off">
<input type="hidden" name="eltp" value="<?=$eltp_code_get?>"  /> 
<input type="hidden" name="evltp" value="<?=$evltp_code_get?>"  /> 
<input type="hidden" name="text_send" value="<?=$text_send?>"  /> 



<?php if($chktype==1){?>
  <div class="wrap-input100 validate-input" >
    <center>
    <!-- แสดงความคิดเห็น เช่น บริการดี,ควรปรับปรุง -->
<input class="input100" type="text" name="evltp_remark" id="transcript" placeholder="<?=$auth_user->mf("J0BKXPW97I49LILIXAV",$country_id)?>">

<button type="button" id="start_button" class="btn btn-default"><img src="../images/images_web/microphone-3404243_960_720.png" style="display: block; margin: auto;height:45px; width:45px;"/></button>
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
                        <script type="text/javascript" src="../plugins/web_speech_api/script.js"></script>  
                        </center>			
                    </div>
<?php }?>   

<div class="wrap-input100 validate-input" >
						<input class="input100" type="number" name="evltp_phone" id="evltp_phone" required placeholder="<?=$auth_user->mf("GP6O3BIAC2HIIDYAEQG6",$country_id)?>" maxlength="20">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>

          

          <div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" name="Add-Eva" id="Add-Eva">
              <!-- บันทึกข้อมูล -->
              <?=$auth_user->mf("N7DNEI0JTJFKRRAT5F9",$country_id)?>
						</button>
          </div>

          </form>   
         
        
         
          <div class="login100-form validate-form" style="width:100%;">
          <?php   include("footer.php")?>
          </div>
     