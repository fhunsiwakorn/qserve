
<?php
$total_data =$sql_process->rowsQuery("SELECT eltda_id FROM tbl_evaluation_data WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND is_delete='1'");
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
// $sql_process->fastQuery("UPDATE  tbl_evaluation_cach SET evalc_status='1'   WHERE evalc_status='0' AND eltp_code='$eltp_code_get' AND evltp_code='$evltp_code_get'  AND evalc_code='$evalc_code'");   
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

$chktype= $sql_process->lookupfild("eltp_suggestion","tbl_evaluation_topic","eltp_code","$eltp_code_get"); 
?>

    
  <center>  <h4 style="display: block; margin: auto;"> &nbsp;&nbsp;<?=$dataRow["eltp_name"]?></h4>
<br>
    <div  id='box_css3_raduis' >
  
  
 
    <form method="post" style="width:100%;" autocomplete="off" action="m_chk.php">
<input type="hidden" name="eltp" value="<?=$eltp_code_get?>"  /> 
<input type="hidden" name="evltp" value="<?=$evltp_code_get?>"  /> 
<input type="hidden" name="evalc_code" value="<?=$evalc_code?>"  /> 
<input type="hidden" name="cmn_code" id="cmn_code"  value="<?=$cmn_codex?>"/>
<input type="hidden" name="text_send" value="<?=$text_send?>"  /> 
<input type="hidden" name="country_id" value="<?=$country_id?>"  /> 
<center>
<?php if($chktype==1){?>
<div class="form-group" >
    
<textarea class="form-control" rows="3"  name="evltp_remark" id="transcript"  placeholder="<?=$auth_user->mf("J0BKXPW97I49LILIXAV",$country_id)?>"></textarea>
                       
<!-- <button type="button" id="start_button" class="btn btn-default"><img src="../images/images_web/microphone-3404243_960_720.png" style="display: block; margin: auto;height:45px; width:45px;"/></button>
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
                        <script type="text/javascript" src="../plugins/web_speech_api/script.js"></script>   -->
					
                    </div>
<?php }?>                  
<div class="form-group" >
    
                        <input  class="form-control" type="number" name="evltp_phone" id="evltp_phone" required placeholder="<?=$auth_user->mf("GP6O3BIAC2HIIDYAEQG6",$country_id)?>"  >
                       
					
					</div>
                    </center>
          <div class="form-group">
          <button type="button" onclick="window.location.href='?zone=EvaStart&eltp=<?=$eltp_code_get?>&evltp=<?=$evltp_code_get?>&numpage=<?=$total_data?>'" class="btn btn-success" >
            <<<	<?=$txt15?>
            
                        </button>

						<button type="submit" class="btn btn-success" name="Add-Eva" id="Add-Eva">
              <!-- บันทึกข้อมูล -->
              <?=$auth_user->mf("N7DNEI0JTJFKRRAT5F9",$country_id)?>
						</button>
          </div>

          </form>   
         


</div>	



