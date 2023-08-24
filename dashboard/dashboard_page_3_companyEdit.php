<?php
$table="tbl_company";

if(isset($_POST['btn-submit-add']))
{  

  if(isset($_FILES['imageupload']['tmp_name']) && !empty($_FILES['imageupload']['tmp_name']))
  {
  $newimage=add_images($_FILES['imageupload']['tmp_name'],$_FILES['imageupload']['name'],"../images/images_company/");
$del_img_file=delfile($_POST['before_img'],"../images/images_company/");
  }else{
$newimage=$_POST['before_img'];

  }
  
  $cmn_code = strip_tags($_POST['cmn_code']);
  $cmn_logo=$newimage;
  $cmn_name = strip_tags($_POST['cmn_name']);
  $cmn_phone = strip_tags($_POST['cmn_phone']);
  $cms_address = strip_tags($_POST['cms_address']);
  $cmn_line = strip_tags($_POST['cmn_line']);
  // $cmn_mail = strip_tags($_POST['cmn_mail']);
  $cmn_mail = isset($_POST['cmn_mail']) ? $_POST['cmn_mail'] : FALSE; 
  $cmn_status = strip_tags($_POST['cmn_status']);
  $upd_by=$_SESSION['userSession'];  

  $fields = [
    'cmn_logo' => $cmn_logo,
    'cmn_name' => $cmn_name,
    'cmn_phone' => $cmn_phone,
    'cms_address' => $cms_address,
    'cmn_line' => $cmn_line,
    'cmn_mail' => $cmn_mail,
    'upd_by' => $upd_by,
    'cmn_status' => $cmn_status
];
$Where=['cmn_code' => $cmn_code];
try {

  /*
   * Have used the word 'object' as I could not see the actual 
   * class name.
   */
  $sql_process->update($table, $fields,$Where);

}catch(ErrorException $exception) {

   $exception->getMessage();  // Should be handled with a proper error message.

}
  

  echo "<script>";
  echo "location.href = '?zone=CompanyData&success'";
  echo "</script>";
}

if(isset($_GET['success'])){
    echo "<script>";
    echo 'swal("ทำรายการสำเร็จ !", "ปิดหน้าต่างนี้ !", "success")';
    echo "</script>";
}


$cmn_code_get = $_GET['cmned'];	
$stmt = $sql_process->runQuery("SELECT * FROM tbl_company WHERE cmn_code=:cmn_code_param");
$stmt->execute(array(":cmn_code_param"=>$cmn_code_get));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
if(!empty($dataRow["cmn_logo"])){
    $pathimg="../images/images_company/".$dataRow["cmn_logo"];
}else{
    $pathimg="../images/images_web/no-logo1.png";
}

?>


<!-- PRIVIEW PICTURE -->
<script language=Javascript>
           function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
      </script>

  <form class="forms-sample" method="post" autocomplete="off" enctype="multipart/form-data">
  <input type="hidden" name="cmn_code" id="cmn_code" value="<?=$cmn_code_get?>"/>
  <input type="hidden" name="before_img" id="before_img" value="<?=$dataRow['cmn_logo']?>"/>
<div class="row">

            
                <div class="col-8">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">แบบฟอร์มกรอกข้อมูลบริษัท /องค์กร</h4>
                     
                    

                   
 
                        <div class="form-group">
                          <label>ชื่อบริษัท / องค์กร</label> <label style="color:red;">*</label>
                          <input type="text" class="form-control" id="cmn_name" name="cmn_name" value="<?=$dataRow['cmn_name']?>" required>
                        </div>
                        
                        <div class="form-group">
                          <label>เบอร์โทร</label> <label style="color:red;">*</label>
                          <input type="text" class="form-control" id="cmn_phone" name="cmn_phone" value="<?=$dataRow['cmn_phone']?>" required>
                        </div>

                        <div class="form-group">
                          <label>ที่อยู่</label> <label style="color:red;">*</label>
                          <input type="text" class="form-control" id="cms_address" name="cms_address" value="<?=$dataRow['cms_address']?>" required>
                        </div>


                        <div class="form-group">
                          <label>ไลน์ (รหัส Token)</label> <label style="color:red;">*</label>
                          <input type="text" class="form-control" id="cmn_line" name="cmn_line" required value="<?=$dataRow['cmn_line']?>">
                        </div>

                        <div class="form-group">
                          <label>อีเมล</label> 
                          <input type="text" class="form-control" id="cmn_mail" name="cmn_mail" value="<?=$dataRow['cmn_mail']?>" >
                        </div>
                
<div class="form-group">

<label>สถานะการใช้งาน</label>
<select name="cmn_status" id="cmn_status"  class="form-control">
<option value="1" <?php if($dataRow['cmn_status']=='1'){echo "SELECTED";} ?>>เปิด</option>
<option value="0"  <?php if($dataRow['cmn_status']=='0'){echo "SELECTED";} ?>>ปิด</option>

</select>
</div>
              <div class="form-group">
    <center>
                        <button type="submit" class="btn btn-success mr-2" name="btn-submit-add">บันทึกข้อมูล</button>
                        </center>
                        </div>                 
                    

                    </div>
                  </div>
                </div>
              
          
                <div class="col-md-4 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">รูปโลโก้บริษัท</h4>
                      <center>
                      <div class="form-group" >
<ul class="gallery">
<input type="file" name="imageupload" id="imageupload" onchange="readURL(this);"    style="display:none">
<li><img  src="<?=base64_encode_image($pathimg)?>" alt="อัพโหลดได้เฉพาะไฟล์รูปภาพ !" id="blah"  width="300" height="70"/>
<!-- <a href="#" data-toggle="tooltip" title="คลิ๊กเพื่ออัพโหลดรูปภาพ" name="uploadbutton" onclick="imageupload.click()">
<span class="photo"></span></a> -->
</li>
  </ul>
  <button type="button" class="btn btn-primary submit-btn btn-block" title="คลิ๊กเพื่ออัพโหลดรูปภาพ" name="uploadbutton" onclick="imageupload.click()">อัพโหลดรูป</button>
  </div>
  </center>

                    </div>
                  </div>
                </div>
            
              </div>
            </div>

          

            </div>
            </form>