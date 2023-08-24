<?php
$ctgm_code_get=strip_tags($_GET['cc']);
$stmt = $sql_process->runQuery("SELECT ctgm_name,ctgm_description,ctgm_status FROM tbl_category_main WHERE ctgm_code=:ctgm_code_param");
$stmt->execute(array(":ctgm_code_param"=>$ctgm_code_get));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['file'])){
    $file =$_GET['file']; 
    $cgimg_id =$_GET['cgimg_id'];
   
    $Del_1= $sql_process->fastQuery("DELETE FROM tbl_category_img WHERE cgimg_id='$cgimg_id'");
    ///ลบไฟล๋ก่าทิ้ง
$del_img_file=delfile($file,"../images/images_catagory/");


    echo "<script>";
    echo "location.href = '?zone=$zone&cc=$ctgm_code_get'";
    echo "</script>";
}

$open= $auth_user->mf("1TIY9D1HPCVIDFOSHPH",$country_idx);
$close= $auth_user->mf("W9911FENKYG5KP3G4YF",$country_idx);

$form= $auth_user->mf("QSSSELDILR7KC8J5DKM",$country_idx);
$edit= $auth_user->mf("4U9N0HPRKM852Y9B5II",$country_idx);
$delimg=$auth_user->mf("S73FLCZD7NDXFSH9CGKQ",$country_idx);
?>
                  <div class="card">
                    <div class="card-body">
               
               
                    <h4 class="card-title"><?=$ctgm_name_main_x?></h4>
 
                    <form method="post" enctype="multipart/form-data" action="page_2_CategoryMainChk.php">
<input type="hidden" name="ctgm_code" id="ctgm_code"  value="<?=$ctgm_code_get?>"/>
<input type="hidden" name="upd_by" id="upd_by"  value="<?=$user_id?>"/>
<h4 class="card-title">
  <!-- แบบฟอร์ม :: แก้ไข -->
  <?=$form?> :: <?=$edit?>
</h4>

<div class="form-group">
<label><?=$ctgm_name_main_x?></label>
<input type="text" class="form-control"  name="ctgm_name" id="ctgm_name" required placeholder="<?=$ctgm_name_main_x?>" value="<?=$dataRow["ctgm_name"]?>">
</div>   
<div class="form-group">
<label> <!-- รายละเอียด -->
  <?=$auth_user->mf("ZGURMBI4JPVS1ZE25DRM",$country_idx)?></label>
<input type="text" class="form-control" name="ctgm_description" id="ctgm_description"    value="<?=$dataRow["ctgm_description"]?>">
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
<option value="1" <?php if($dataRow['ctgm_status']=='1'){echo "SELECTED";} ?>><?=$open?></option>
<option value="0" <?php if($dataRow['ctgm_status']=='0'){echo "SELECTED";} ?>><?=$close?></option>

</select>    
</div>

<div class="row">
  <?php
            $img=0;
  $stm= $sql_process->runQuery(
    "SELECT
    cgimg_id,
    cgimg_name
    FROM
    tbl_category_img 
    WHERE cgimg_code=:cgimg_code_param
    ORDER BY
    cgimg_id  ASC ");
    $stm->execute(array(":cgimg_code_param"=>$ctgm_code_get));
    while($rs= $stm->fetch(PDO::FETCH_OBJ)) {
        $img++;
        $strFileIMG1=base64_encode_image("../images/images_catagory/$rs->cgimg_name");
      ?>
    <div class="col-2">
    <center>
    <a class="thumbnail" href="<?=$strFileIMG1?>" data-lightbox="example-set1-<?=$ctgm_code_get?>" data-title="<?=$dataRow["ctgm_name"]?>" >

      <img src="<?=$strFileIMG1?>" alt="Image : <?=$img?>" style="height:100px; width:100px">
    </a>
  
 <hr>
    <a  class="btn btn-icons btn-rounded btn-light" href="?zone=<?=$zone?>&cc=<?=$ctgm_code_get?>&cgimg_id=<?=$rs->cgimg_id?>&file=<?=$rs->cgimg_name?>"  onClick="javascript:return confirm('<?=$delimg?>');">
      <i class="mdi mdi-delete"></i>
    </a>
    </center>
  </div>
  <?php } ?>
  
  </div> 

<div class="form-group">
<br>
<center>
  <button type="submit" class="btn btn-success mr-2" name="btn-submit-edit"><?=$auth_user->mf("N7DNEI0JTJFKRRAT5F9",$country_idx)?></button>
  </center>
  </div>  
  </form>





                    </div>
                  </div>
              