      <?php
     $open= $auth_user->mf("1TIY9D1HPCVIDFOSHPH",$country_idx);
     $close= $auth_user->mf("W9911FENKYG5KP3G4YF",$country_idx);
      ?>
      
            <div class="card">
                    <div class="card-body">
               
               
                    <h4 class="card-title"><?=$ctgm_name_main_x?></h4>
 
                    <form method="post" enctype="multipart/form-data" action="page_2_CategoryMainChk.php">
     <input type="hidden" name="crt_by" id="crt_by"  value="<?=$user_id?>"/>
     <input type="hidden" name="cmn_code" id="cmn_code"  value="<?=$cmn_codex?>"/>



<div class="form-group">
<label><?=$ctgm_name_main_x?></label>
<input type="text" class="form-control"  name="ctgm_name" id="ctgm_name" required placeholder="<?=$ctgm_name_main_x?>">
</div>   
<div class="form-group">
<label>
  <!-- รายละเอียด -->
  <?=$auth_user->mf("ZGURMBI4JPVS1ZE25DRM",$country_idx)?>
</label>
<input type="text" class="form-control" name="ctgm_description" id="ctgm_description">
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
<select name="ctgm_status" id="ctgm_status"  class="form-control">
<option value="1"><?=$open?></option>
<option value="0"><?=$close?></option>

</select>    
</div>
<div class="form-group">
<center>
  <button type="submit" class="btn btn-success mr-2" name="btn-submit-add"> <?=$auth_user->mf("N7DNEI0JTJFKRRAT5F9",$country_idx)?></button>
  </center>
  </div>  
  </form>





                    </div>
                  </div>
              