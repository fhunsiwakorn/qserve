<?php
$table="tbl_evaluation_cach";
//ตรวจการทำแบบประเมิน
$total_data =$sql_process->rowsQuery("SELECT eltda_id FROM tbl_evaluation_data WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND is_delete='1'");
$Chek_start =$sql_process->rowsQuery("SELECT evalc_id FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='$evltp_code_get' AND evalc_code='$evalc_code'  AND evalc_status='0'");

///หาเปอร์เซ็น
$avg_per=($Chek_start/$total_data)*100;
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
 LIMIT $Chek_start,1");
$stmt2->execute(array(":cmn_code_param"=>$cmn_codex,":eltp_code_param"=>$eltp_code_get));
$dataRow2=$stmt2->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['evalc_value']) && !empty($_POST['evalc_value'])){
$evalc_value=$_POST['evalc_value'];
$evalc_comment=isset($_POST['evalc_comment']) ? $_POST['evalc_comment'] : FALSE;
$eltda_id=strip_tags($_POST['eltda_id']);
$eltp_code=strip_tags($_POST['eltp']);
$evltp_code=strip_tags($_POST['evltp']);

$evalc_index=strip_tags($_POST['numpage']);
  $count=count($evalc_value);
  for($i=0;$i<$count;$i++){
   $evalc_value_x = $evalc_value[$i];
   
   

  $fields = [
    'evalc_value' => $evalc_value_x,
    'evalc_comment' => $evalc_comment,
    'eltda_id' => $eltda_id,
    'eltp_code' => $eltp_code,
    'evltp_code' => $evltp_code,
    'cmn_code' => $cmn_codex,
    'ip_device' => $ipaddress,
    'evalc_code'=> $evalc_code,
    'evalc_status'=>0,
    'evalc_index'=> $evalc_index
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


    }
  

  echo "<script>";
  echo "location.href = '?zone=EvaStart&eltp=$eltp_code&evltp=$evltp_code'";
  echo "</script>";



}
  ///ถ้าทำครบแล้วให้กรอกเบอร์โทร
if($Chek_start >= $total_data){
  echo "<script>";
  echo "location.href = '?zone=EvaAddScore&eltp=$eltp_code_get&evltp=$evltp_code_get'";
  echo "</script>";
  }
?>

<form method="post" autocomplete="off" style="width:100%;" name="proce<?=$number?>" id="proce<?=$number?>">
<input type="hidden" name="eltda_id" value="<?=$dataRow2['eltda_id']?>"  /> 
<input type="hidden" name="eltp" value="<?=$eltp_code_get?>"  /> 
<input type="hidden" name="evltp" value="<?=$evltp_code_get?>"  /> 
<input type="hidden" name="numpage" value="<?=$Chek_start+1?>"  /> 
<div class="row" >
<div class="wrap-input100 validate-input" >
<div class="progress">
  <div class="progress-bar" role="progressbar" style="width: <?=$avg_per?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <?=round($avg_per)?>%</div>
</div>
<h2><?=$dataRow["eltp_name"]?> </h2>

<h4>
 <?=$Chek_start+1?>. <?=$dataRow2["eltda_name"]?>

</h4>
          </div>
          
<?php for($i=1; $i<6; $i++) { ?>
  <table align="center">
  <tbody>
    <tr onclick="check<?=$i?>()"  style="cursor:pointer;">
      <td> 
      <img src="<?=base64_encode_image("../images/emoji/$i.png")?>" >
      </td>
    </tr>
    <tr>
      <td align="center">
      <?=$i?>
      </td>    
    </tr>
    <tr>
      <td align="center"  >
      <div class="radio" >
            <label style="font-size: 1.5em">
                <input type="radio" name="evalc_value[]" id="evalc_value_<?=$i?>" value="<?=$i?>" >
                <span class="cr"  style="cursor:pointer;"><i class="cr-icon fa fa-circle"></i></span>
            </label>
          
        </div>

      </td>    
    </tr>

  </tbody>
</table>
<?php } ?>

</div>

<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="evalc_comment" id="transcript" placeholder="<?=$txt9?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-comment" aria-hidden="true"></i>
            </span>
					</div>

       <div align="center">
       <button id="start_button" type="button" class="btn btn-default"><img src="../images/images_web/microphone-3404243_960_720.png" style="display: block; margin: auto;height:45px; width:45px;"/></button>
                        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>  
                        <script type="text/javascript" src="../plugins/web_speech_api/script.js"></script>
       </div>

          <div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn" name="Add-Eva" id="Add-Eva">
              <!-- ถัดไป -->
              <?=$txt7?>
						</button>
          </div>

          </form>  

          <div style="color:blue;"><br>
         <!-- ประเมินให้กับ --> <?=$txt6?> : <?=$ctgm_name_main_x?>  <?=$dataRow1["ctgm_name"]?>
          <br>
          <font size="-1" color="blue">
                        <a href="?eltp=<?=$eltp_code_get?>&evltp=<?=$evltp_code_get?>" >
                        <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
                          <!-- กลับไปยังหน้าก่อนหน้า -->
                          <?=$txt8?>
                        </a>
						</font>
          </div>
         

          <div class="login100-form validate-form" style="width:100%;">
          <?php include("footer.php");?>
          </div>