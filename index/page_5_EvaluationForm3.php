<?php
$eltp_code_get=strip_tags($_GET["eltp"]);
$stmt = $sql_process->runQuery("SELECT eltp_name,eltp_status_topic FROM tbl_evaluation_topic WHERE eltp_code=:eltp_code_param");
$stmt->execute(array(":eltp_code_param"=>$eltp_code_get));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
      <div class="row">
 <div class="col-4">
 <button type="button" class="btn btn-icons btn-rounded btn-primary" onclick="window.location.href='?zone=EvaluationForm1E&eltp=<?=$eltp_code_get?>'">
 1
 </button>
 <label><?=$auth_user->mf("URC9PALSXATW6GOEUV12",$country_idx);?></label>
<hr>



 </div>

 <div class="col-4">
 <button type="button" class="btn btn-icons btn-rounded btn-primary"  onclick="window.location.href='?zone=EvaluationForm2&eltp=<?=$eltp_code_get?>'">
2
 </button>
 <label><?=$auth_user->mf("8M8DOJ7P9N2XQTP3WU1V",$country_idx);?></label>
<hr>
 </div>

 <div class="col-4">
 <button type="button" class="btn btn-icons btn-rounded btn-primary">
3
 </button>
 <label><?=$auth_user->mf("Y6ID3K217W7UWP3N5S",$country_idx);?></label>
<hr>
 </div>

</div>
     
<div class="col-12">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">
                  <!-- ขั้นตอนที่ 3 : สร้างเนื้อหาแบบประเมินหัวข้อ -->
                  <?=$auth_user->mf("LT5FAVG8MA4WCDUIZGFX",$country_idx);?>
                   <b><?=$dataRow["eltp_name"]?></b> </h4>
                <div class="table-responsive">
                <form method="post" action="page_5_EvaluationFormChk.php" autocomplete="off" autocomplete="off">
                <input type="hidden" class="form-control" name="eltp_code" id="eltp_code"  value="<?=$eltp_code_get?>">
     <input type="hidden" name="cmn_code" id="cmn_code"  value="<?=$cmn_codex?>"/>
                     <div class="form-group">
                    <label>
                      <!-- กรอกเนื้อหา -->
                      <?=$auth_user->mf("FKX34YOQ5LRTALKZJVYP",$country_idx);?>
                    </label>
                        <input type="text" class="form-control" name="eltda_name" id="eltda_name"   required placeholder="<?=$auth_user->mf("28UNC0YD7R8RER91PLM",$country_idx);?>">
                      </div>
                </form>

                <iframe src="page_5_EvaluationForm3_Sort.php?eltp_code=<?=$eltp_code_get?>&country_id=<?=$country_idx?>"  style="width:100%; height:700px ;  border:thin; background-color:#fff">
                </iframe>

                </div>
              </div>
            </div>
          </div>

  