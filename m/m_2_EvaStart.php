<?php
$table="tbl_evaluation_cach";
//ตรวจการทำแบบประเมิน
$total_data =$sql_process->rowsQuery("SELECT eltda_id FROM tbl_evaluation_data WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND is_delete='1'");
$Chek_start =$sql_process->rowsQuery("SELECT evalc_id FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='$evltp_code_get' AND  evalc_code='$evalc_code' AND evalc_status='0'");

$numpage = isset($_GET['numpage']) ? $_GET['numpage'] : 1; 
///หาเปอร์เซ็น
$avg_per=($Chek_start/$total_data)*100;

$rows='1';

$total_page=ceil($total_data/$rows);
if($numpage>=$total_page)$numpage=$total_page;

if($numpage==1 && !isset($_GET['numpage'])){
    $start=$Chek_start;
    $numpage =$Chek_start+1;
}else{
    $start=positive_number(($numpage-1)*$rows);
}


$stmt2 = $sql_process->runQuery("SELECT
 eltda_id,
 eltda_name
 FROM 
 tbl_evaluation_data 
 WHERE
 is_delete='1' AND
 cmn_code=:cmn_code_param AND
 eltp_code=:eltp_code_param
 ORDER BY
 eltda_index ASC
 LIMIT $start,$rows
 ");
$stmt2->execute(array(":cmn_code_param"=>$cmn_codex,":eltp_code_param"=>$eltp_code_get));
$dataRow2=$stmt2->fetch(PDO::FETCH_ASSOC);

  ///ถ้าทำครบแล้วให้กรอกเบอร์โทร
if($Chek_start >= $total_data && !isset($_GET['numpage'])){
  echo "<script>";
  echo "location.href = '?zone=EvaAddScore&eltp=$eltp_code_get&evltp=$evltp_code_get'";
  echo "</script>";
  }

  ///เช็คว่าข้อนี้เคยทำหรือยัง
  $chkansw_a =$sql_process->rowsQuery("SELECT eltp_code FROM tbl_evaluation_cach WHERE evalc_code ='$evalc_code' AND eltda_id='".$dataRow2['eltda_id']."'  AND eltp_code ='$eltp_code_get' ");

$chktxt=isset($_GET["chktxt"]) ? $_GET["chktxt"] : NULL;
?>
<center>

<iframe  src="progrss.php?avg_per=<?=$avg_per?>" style="width:100%; height:75px ;  border:thin; background-color:#FFB85A" ></iframe>
</center>
   
  <!-- Sumit Form  -->
<script>
function myFunction() {
    document.getElementById("form_chk").submit();
}
function myFunction1() {
    document.getElementById("form_chk2").submit();
}

</script>

<div  id='box_css3_raduis' >
<h2><?=$dataRow["eltp_name"]?> </h2>

<h4>
 <?=$start+1?>. <?=$dataRow2["eltda_name"]?>
</h4>

</div>
<br>


<div  id='box_css3_raduis' >
<form method="post" autocomplete="off" style="width:100%;" name="form_chk" id="form_chk" action="m_chk.php">
<input type="hidden" name="eltda_id" value="<?=$dataRow2['eltda_id']?>"  /> 
<input type="hidden" name="eltp" value="<?=$eltp_code_get?>"  /> 
<input type="hidden" name="evltp" value="<?=$evltp_code_get?>"  /> 
<input type="hidden" name="cmn_code" id="cmn_code"  value="<?=$cmn_codex?>"/>
<input type="hidden" name="evalc_code" id="evalc_code"  value="<?=$evalc_code?>"/>
<input type="hidden" name="numpage" id="numpage"  value="<?=$numpage?>"/>

<table style="text-align: left; width: 100%;" border="0"
 cellpadding="2" cellspacing="2">
  <tbody>
    <tr align="center">
    <?php for($i=1; $i<=5; $i++) {
        // คำสั่งหาว่ามีการกำหนดเงื่อนไขหรือไม่
        $chktype =$sql_process->rowsQuery("SELECT eltp_code FROM tbl_evaluation_topic_addon WHERE eltp_code ='$eltp_code_get' AND eta_level='$i' AND eta_addon='1'");
        ///ตรวจสอบว่าเคยทำหรือไม่
        $chkansw =$sql_process->rowsQuery("SELECT eltp_code FROM tbl_evaluation_cach WHERE evalc_code ='$evalc_code' AND eltda_id='".$dataRow2['eltda_id']."' AND evalc_value='$i' AND eltp_code ='$eltp_code_get' ");
        ?>
      <td onclick="check<?=$i?>();myFunction()"  style="cursor:pointer;">
      <h4>
        
          <?php if($chktype>=1){ 
              //เช็คว่าประเมินในระดับนี้มีการกำหนดเงื่อนไขหรือไม่ เช่น คอมเม้น
         
                 if($chktxt == $i && $chkansw <=0 ){ 
                  $ck= "checked";
               
                
                }elseif($chkansw >=1 && $chktxt!=$i){ 
                   $ck= "checked";  
                  } elseif($chkansw >=1 && $chktxt==$i){ 
                    $ck= "checked";  
                   }
                  else{
                    $ck=NULL;
                  }
              ?>
            <input type="radio" name="chktxt" <?=$ck?> id="evalc_value_<?=$i?>" value="<?=$i?>"  style="display: block; margin: auto;height:30px; width:30px;">
          <?php }else{ ?>
            <input type="radio" name="evalc_value[]" id="evalc_value_<?=$i?>" value="<?=$i?>" <?php if($chkansw >=1 && $chktxt==NULL){  echo "checked";  }  ?>   style="display: block; margin: auto;height:30px; width:30px;">
          <?php } ?>
      <?=$i?>   </h4>
      <hr> 
      <img src="../images/emoji/<?=$i?>.png"  style="display: block; margin: auto;height:40px; width:40px;" >
      
      </td>
      <?php } ?>
    </tr>
  </tbody>
</table>
</form>    


<form method="post" autocomplete="off" style="width:100%;" name="form_chk2" id="form_chk2" action="m_chk.php">
<input type="hidden" name="eltda_id" value="<?=$dataRow2['eltda_id']?>"  /> 
<input type="hidden" name="eltp" value="<?=$eltp_code_get?>"  /> 
<input type="hidden" name="evltp" value="<?=$evltp_code_get?>"  /> 
<input type="hidden" name="cmn_code" id="cmn_code"  value="<?=$cmn_codex?>"/>
<input type="hidden" name="evalc_code" id="evalc_code"  value="<?=$evalc_code?>"/>
<input type="hidden" name="numpage" id="numpage"  value="<?=$numpage?>"/>
<div  align="center" >
            <?php 
  $txtchk= $sql_process->lookupfild3("evalc_comment","tbl_evaluation_cach","evalc_code ='$evalc_code' AND eltda_id='".$dataRow2['eltda_id']."' AND eltp_code ='$eltp_code_get'"); 
  $valchk= $sql_process->lookupfild3("evalc_value","tbl_evaluation_cach","evalc_code ='$evalc_code' AND eltda_id='".$dataRow2['eltda_id']."' AND eltp_code ='$eltp_code_get'"); 
  if(isset($_GET["chktxt"]) ||  $txtchk!=NULL ) { 
                $chktxt=isset($_GET["chktxt"]) ? $_GET["chktxt"] : $valchk;
                ?>
               
                <input type="hidden" name="evalc_value[]"  value="<?=$chktxt?>" >
                        <textarea class="form-control" rows="3"  name="evalc_comment" id="transcript" placeholder="<?=$txt9?>..." ><?=$txtchk?></textarea>

                        <!-- <button type="button" id="start_button" class="btn btn-default"><img src="../images/images_web/microphone-3404243_960_720.png" style="display: block; margin: auto;height:45px; width:45px;"/></button>
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
                        <script type="text/javascript" src="../plugins/web_speech_api/script.js"></script>   -->
            <?php } ?>
					</div>

     
          </form>     



</div>	

<div align="center">
              <br>
						<button type="button" onclick="window.location.href='?zone=EvaStart&eltp=<?=$eltp_code_get?>&evltp=<?=$evltp_code_get?>&numpage=<?=$numpage-1?>'" class="btn btn-success" >
            <<<	<?=$txt15?>
            
                        </button>
                        <!-- onclick="myFunction1()" -->

                        <?php if($chkansw_a >=1 && $txtchk==NULL && $numpage  <  $total_data ){?>
                        <button type="button" onclick="window.location.href='?zone=EvaStart&eltp=<?=$eltp_code_get?>&evltp=<?=$evltp_code_get?>&numpage=<?=$numpage+1?>'" class="btn btn-success" >
							<?=$txt7?> >>>
                        </button>
                        <?php }elseif(isset($_GET["chktxt"]) ||  $txtchk!=NULL ){  ?>
                            <button type="button" onclick="myFunction1()" class="btn btn-success" >
              <?=$txt7?> >>>
                        </button>
                     
                        <?php }elseif(isset($_GET["numpage"]) && $numpage  >=  $total_data  ){  ?>
                            <button type="button"  onclick="window.location.href='?zone=EvaAddScore&eltp=<?=$eltp_code_get?>&evltp=<?=$evltp_code_get?>'"  class="btn btn-success" >
              <?=$txt7?> >>>
                        </button>
                        <?php } ?>
          </div>




