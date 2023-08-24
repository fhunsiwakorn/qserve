<?php
$ctgs_code_get=strip_tags($_GET['csc']);
$stmt = $sql_process->runQuery("SELECT ctgs_name,ctgs_description,ctgs_status,ctgm_code FROM tbl_category_sub WHERE ctgs_code=:ctgs_code_param");
$stmt->execute(array(":ctgs_code_param"=>$ctgs_code_get));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);

if(isset($_GET['file'])){
    $file =$_GET['file']; 
    $cgimg_id =$_GET['cgimg_id'];
   
    $Del_1= $sql_process->fastQuery("DELETE FROM tbl_category_img WHERE cgimg_id='$cgimg_id'");
    ///ลบไฟล๋ก่าทิ้ง
$del_img_file=delfile($file,"../images/images_catagory/");


echo "<script>";
echo "location.href = '?zone=$zone&csc=$ctgm_code_get'";
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
               
               
                    <h4 class="card-title"><?=$ctgs_name_main_x?></h4>
 
                    <form method="post" enctype="multipart/form-data" action="page_3_CategorySubChk.php">
<input type="hidden" name="ctgs_code" id="ctgs_code"  value="<?=$ctgs_code_get?>"/>
<input type="hidden" name="upd_by" id="upd_by"  value="<?=$user_id?>"/>
<h4 class="card-title">
    <!-- แบบฟอร์ม :: แก้ไข -->
    <?=$form?> :: <?=$edit?>

</h4>

<div class="form-group">
<label><?=$ctgs_name_main_x?></label>
<input type="text" class="form-control"  name="ctgs_name" id="ctgs_name" required placeholder="<?=$ctgs_name_main_x?>" value="<?=$dataRow["ctgs_name"]?>">
</div>   
<div class="form-group">
<label> <!-- รายละเอียด -->
  <?=$auth_user->mf("ZGURMBI4JPVS1ZE25DRM",$country_idx)?></label>
<input type="text" class="form-control" name="ctgs_description" id="ctgs_description"   value="<?=$dataRow["ctgs_description"]?>">
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
ctgm_status='1' AND
is_delete='1'AND
cmn_code=:cmn_code_param
ORDER BY
tbl_category_main.ctgm_name  ASC");
$qa->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowA= $qa->fetch(PDO::FETCH_OBJ)) {
// echo "<option value='$rowA->ctgm_code'>$rowA->ctgm_name</option>";
echo"<option value='$rowA->ctgm_code'";
if ($dataRow["ctgm_code"] == $rowA->ctgm_code)
{
  echo "SELECTED";
}
echo ">$rowA->ctgm_name</option>\n";
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
<option value="1" <?php if($dataRow['ctgs_status']=='1'){echo "SELECTED";} ?>><?=$open?></option>
<option value="0" <?php if($dataRow['ctgs_status']=='0'){echo "SELECTED";} ?>><?=$close?></option>

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
    $stm->execute(array(":cgimg_code_param"=>$ctgs_code_get));
    while($rs= $stm->fetch(PDO::FETCH_OBJ)) {
        $img++;
        $strFileIMG1=base64_encode_image("../images/images_catagory/$rs->cgimg_name");
      ?>
    <div class="col-2">
    <center>
    <a class="thumbnail" href="<?=$strFileIMG1?>" data-lightbox="example-set1-<?=$ctgs_code_get?>" data-title="<?=$dataRow["ctgs_name"]?>" >

      <img src="<?=$strFileIMG1?>" alt="Image : <?=$img?>" style="height:100px; width:100px">
    </a>
  <hr>
    <a  class="btn btn-icons btn-rounded btn-light" href="?zone=<?=$zone?>&csc=<?=$ctgs_code_get?>&cgimg_id=<?=$rs->cgimg_id?>&file=<?=$rs->cgimg_name?>"  onClick="javascript:return confirm('<?=$delimg?>');">
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
              