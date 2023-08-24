<?php
$open= $auth_user->mf("1TIY9D1HPCVIDFOSHPH",$country_idx);
$close= $auth_user->mf("W9911FENKYG5KP3G4YF",$country_idx);
?>

                  <div class="card">
                    <div class="card-body">
               
               
                    <h4 class="card-title"><?=$ctgs_name_main_x?></h4>
 
                    <form method="post" enctype="multipart/form-data" action="page_3_CategorySubChk.php">
      <input type="hidden" name="crt_by" id="crt_by"  value="<?=$user_id?>"/>
     <input type="hidden" name="cmn_code" id="cmn_code"  value="<?=$cmn_codex?>"/>


<div class="form-group">
<label><?=$ctgs_name_main_x?></label>
<input type="text" class="form-control"  name="ctgs_name" id="ctgs_name" required placeholder="<?=$ctgs_name_main_x?>">
</div>   
<div class="form-group">
<label> <!-- รายละเอียด -->
  <?=$auth_user->mf("ZGURMBI4JPVS1ZE25DRM",$country_idx)?>
</label>
<input type="text" class="form-control" name="ctgs_description" id="ctgs_description" >
</div>  

<div class="form-group">
<label><?=$ctgm_name_main_x?></label>
<select name="ctgm_code" id="ctgm_code"  class="form-control" required>
<option value="">--<?=$ctgm_name_main_x?>--</option>
<?php
$qa = $sql_process->runQuery(
"SELECT
ctgm_code,
ctgm_name
FROM
tbl_category_main
WHERE
ctgm_status='1'AND
is_delete='1' AND
cmn_code=:cmn_code_param
ORDER BY
tbl_category_main.ctgm_name  ASC");
$qa->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowA= $qa->fetch(PDO::FETCH_OBJ)) {
echo "<option value='$rowA->ctgm_code'>$rowA->ctgm_name</option>";
}
?>

</select>    
</div>

<div class="form-group">
<label>
  <!-- อัพโหลดรูป (อัพได้ทีละ 5 รูป) -->
  <?=$auth_user->mf("FPB25T5TR3YPKJTJSEWR",$country_idx)?>
</label>
<input type="file" id="imageupload" name="imageupload[]"   multiple>
</div> 

<div class="form-group">
<label>
  <!-- สถานะการใช้งาน -->
  <?=$auth_user->mf("ZIWW44Y5AGX96X0NNUR",$country_idx)?>
</label>
<select name="ctgs_status" id="ctgs_status"  class="form-control">
<option value="1"><?=$open?></option>
<option value="0"><?=$close?></option>

</select>    
</div>



<div class="form-group">
<center>
  <button type="submit" class="btn btn-success mr-2" name="btn-submit-add"><?=$auth_user->mf("N7DNEI0JTJFKRRAT5F9",$country_idx)?></button>
  </center>
  </div>  
  </form>







                    </div>
                  </div>
              