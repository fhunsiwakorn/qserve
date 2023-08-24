<?php
 require_once("../library/set_evaluation.php");

$eltp_code_get=strip_tags($_GET["eltp"]);
$stmt = $sql_process->runQuery("SELECT * FROM tbl_evaluation_topic WHERE eltp_code=:eltp_code_param");
$stmt->execute(array(":eltp_code_param"=>$eltp_code_get));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>

 <div class="row">
 <div class="col-4">
 <button type="button" class="btn btn-icons btn-rounded btn-primary">
 1
 </button>
 <label><?=$auth_user->mf("URC9PALSXATW6GOEUV12",$country_idx);?></label>
<hr>



 </div>

 <div class="col-4">
 <button type="button" class="btn btn-icons btn-rounded btn-inverse-outline-primary">
2
 </button>
 <label><?=$auth_user->mf("8M8DOJ7P9N2XQTP3WU1V",$country_idx);?></label>
<hr>
 </div>

 <div class="col-4">
 <button type="button" class="btn btn-icons btn-rounded btn-inverse-outline-primary">
3
 </button>
 <label><?=$auth_user->mf("Y6ID3K217W7UWP3N5S",$country_idx);?></label>
<hr>
 </div>

</div>

   <form method="post" autocomplete="off" action="page_5_EvaluationFormChk.php?form=1">
   <input type="hidden" name="eltp_code" id="eltp_code"  value="<?=$eltp_code_get?>"/>
   <input type="hidden" name="eltp_status_topic_before" id="eltp_status_topic_before"  value="<?=$dataRow['eltp_status_topic']?>"/>
   <input type="hidden" name="upd_by" id="upd_by"  value="<?=$user_id?>"/>
   <input type="hidden" name="cmn_code" id="cmn_code"  value="<?=$cmn_codex?>"/>
 <div class="row">
 <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                   <h4 class="card-title"><?=$auth_user->mf("URC9PALSXATW6GOEUV12",$country_idx);?></h4>
                     
  
 
                        <div class="form-group">
                        <label>
                            <!-- หัวข้อ / ชื่อแบบประเมิน -->
                            <?=$auth_user->mf("3YXM2DYJA0757V0Y2",$country_idx);?>
                          </label> <label style="color:red;">*</label>
                          <input type="text" class="form-control" id="eltp_name" name="eltp_name" value="<?=$dataRow["eltp_name"]?>"  required>
                        </div>
                        
                        <div class="form-group">
                        <label>
                        <!-- รายละเอียด -->
                      <?=$auth_user->mf("ZGURMBI4JPVS1ZE25DRM",$country_idx);?>
                      </label>
                      <textarea class="form-control" id="exampleTextarea1" rows="2" name="eltp_description"><?=$dataRow["eltp_description"]?></textarea>
                    </div>

                        <div class="form-group">
                        <label> <?=$auth_user->mf("NYB10XVCMYCEB27SUG3",$country_idx);?></label>
                        <select name="eltp_status_topic" id="eltp_status_topic"  class="form-control">
                        <option value="1" <?php if($dataRow['eltp_status_topic']=='1'){echo "SELECTED";} ?>><?=$auth_user->mf("XSBMHS8Q0OJOT7VRTLNA",$country_idx);?></option>
                        <option value="2" <?php if($dataRow['eltp_status_topic']=='2'){echo "SELECTED";} ?>><?=$ctgm_name_main_x?></option>
                        <option value="3" <?php if($dataRow['eltp_status_topic']=='3'){echo "SELECTED";} ?>><?=$ctgs_name_main_x?></option>
                        <option value="4" <?php if($dataRow['eltp_status_topic']=='4'){echo "SELECTED";} ?>><?=$auth_user->mf("82BS90L39GV79H0CHXJ",$country_idx);?></option>
                        </select>    
                        </div>
                    
     

<div class="form-group">
<label>
  <!-- ตั้งค่าส่วนเสริมแบบประเมิน -->
  <?=$auth_user->mf("LVNQY3FPVBNRELIB02YN",$country_idx);?>
</label>
<div class="table-responsive">
                    <table class="table" style="text-align:center;">
                      <thead>
                        <tr>
                        <th><?=$auth_user->mf("0045YL4E8UFF54DTBD09",$country_idx);?></th>
                          <?php
                             for($i=0; $i<sizeof($evaluationOption); $i++) {
                              $i2=$i+1;
                              
                              ?>
                          <th><?=$evaluationOption[$i]?></th>
                             <?php } ?>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                      
                    
                      
                      for($i=1; $i<=5; $i++) { ?>
                        <tr>
                          <td ><?=$i?></td>
                          <?php
                             for($ia=0; $ia<sizeof($evaluationOption); $ia++) {
                              $ia2=$ia+1;
                              $chk_data =$sql_process->rowsQuery("SELECT eltp_code FROM tbl_evaluation_topic_addon WHERE eta_level='$i' AND eta_addon='$ia2' AND eltp_code ='$eltp_code_get'");
                              ////eta[] = ระดับประเมิน.ส่วนเสริม
                              ?>
                          <td align="center">
                         
                            <label class="form-check-label">
                              <input type="checkbox" name="eta[]" style="height:20px; width:20px;" value="<?=$i?>.<?=$ia2?>" <?php if($chk_data>=1){echo "checked";} ?>> 
                            </label>
                         
                          </td>
                             <?php } ?>
                        </tr>
                      <?php } ?>
                      </tbody>
                    </table>
                  </div>
                  </div>


                  <div class="form-group">
                  <label>
                            <!-- คำกล่าวหลังประเมินเสร็จ -->
                            <?=$auth_user->mf("IW9P8F8U4U4QXUSF5GKM",$country_idx);?>
                          </label> <label style="color:red;">*</label>
                          <input type="text" class="form-control" id="eltp_remark" name="eltp_remark"  required value="<?=$dataRow["eltp_remark"]?>">
                        </div>

                  <div class="form-group">
                  <label> 
  <!-- ข้อเสนอแนะหลังการประเมิน -->
  <?=$auth_user->mf("AT33LWQD5GDFZ89POCW6",$country_idx);?>
</label>
<select name="eltp_suggestion" id="eltp_suggestion"  class="form-control">
<option value="1" <?php if($dataRow['eltp_suggestion']=='1'){echo "SELECTED";} ?>><?=$auth_user->mf("0DKRFMKST1C4FOYEUQXZ",$country_idx);?></option>
<option value="0" <?php if($dataRow['eltp_suggestion']=='0'){echo "SELECTED";} ?>><?=$auth_user->mf("06EQD5NHZM3OH4J05R",$country_idx);?></option>

</select>    
</div>

<div class="form-group">
<label>
  <!-- สถานะการใช้งาน -->
  <?=$auth_user->mf("ZIWW44Y5AGX96X0NNUR",$country_idx);?>
</label>
<select name="eltp_status" id="eltp_status"  class="form-control">
<option value="1" <?php if($dataRow['eltp_status']=='1'){echo "SELECTED";} ?>><?=$auth_user->mf("1TIY9D1HPCVIDFOSHPH",$country_idx);?></option>
<option value="0" <?php if($dataRow['eltp_status']=='0'){echo "SELECTED";} ?>><?=$auth_user->mf("W9911FENKYG5KP3G4YF",$country_idx);?></option>

</select>    
</div>

  <div class="form-group">
<center> 
 
  <button type="submit" class="btn btn-success mr-" name="btn-submit-edit">
      <!-- ขั้นตอนถัดไป -->
      <?=$auth_user->mf("OHOLO47OQAO7CEXN5JMW",$country_idx);?>
      
  </button>
  </center>
  </div>  
  

                    </div>
                  </div>
                </div>
              


             
        </div>
    
        </form>