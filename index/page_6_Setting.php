 <?php
$table="tbl_company";

if(isset($_POST['btn-submit-Form1']))
{  

  if(isset($_FILES['imageupload']['tmp_name']) && !empty($_FILES['imageupload']['tmp_name']))
  {
  $newimage=add_images($_FILES['imageupload']['tmp_name'],$_FILES['imageupload']['name'],"../images/images_company/");
$del_img_file=delfile($_POST['before_img'],"../images/images_company/");
  }else{
$newimage=$_POST['before_img'];

  }
  

  $cmn_logo=$newimage;
  $cmn_name = strip_tags($_POST['cmn_name']);
  $cmn_phone = strip_tags($_POST['cmn_phone']);
  $cms_address = strip_tags($_POST['cms_address']);
  $cmn_line = strip_tags($_POST['cmn_line']);

  $cmn_name_main = strip_tags($_POST['cmn_name_main']);
  $cmn_name_sub = strip_tags($_POST['cmn_name_sub']);
  // $cmn_mail = strip_tags($_POST['cmn_mail']);
  $cmn_mail = isset($_POST['cmn_mail']) ? $_POST['cmn_mail'] : FALSE; 
  $upd_by=$_SESSION['userSession'];  

  $fields = [
    'cmn_logo' => $cmn_logo,
    'cmn_name' => $cmn_name,
    'cmn_phone' => $cmn_phone,
    'cms_address' => $cms_address,
    'cmn_line' => $cmn_line,
    'cmn_mail' => $cmn_mail,
    'cmn_name_main' => $cmn_name_main,
    'cmn_name_sub' => $cmn_name_sub,
    'upd_by' => $upd_by
];
$Where=['cmn_code' => $cmn_codex];
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
    echo "location.href = '?zone=Setting&success'";
    echo "</script>";
  }


$stmt = $sql_process->runQuery("SELECT * FROM tbl_company WHERE cmn_code=:cmn_code_param");
$stmt->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
  ?>
<?php if(isset($_GET['success'])){ ?>
<script>
swal("<?=$g3?> !", "<?=$g4?> !", "success")
</script>
<?php } ?>
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
   <form method="post" autocomplete="off" enctype="multipart/form-data">

   <input type="hidden" name="before_img" id="before_img" value="<?=$dataRow['cmn_logo']?>"/>
 <div class="row">
 <div class="col-8">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">
                        <!-- เกี่ยวกับบริษัท /องค์กร -->
                        <?=$auth_user->mf("COUDXA6MOIM3GX69P4AA",$country_idx);?>
                      </h4>
                     
                      <div class="form-group" >

<input type="file" name="imageupload" id="imageupload" onchange="readURL(this);"    style="display:none">
<img  src="<?=$strFileImgCompany?>" alt="อัพโหลดได้เฉพาะไฟล์รูปภาพ !" id="blah"  width="300" height="70"/>
<!-- <a href="#" data-toggle="tooltip" title="คลิ๊กเพื่ออัพโหลดรูปภาพ" name="uploadbutton" onclick="imageupload.click()">
<span class="photo"></span></a> -->

<button type="button" class="btn btn-info btn-fw" onclick="imageupload.click()">
<i class="mdi mdi-upload"></i>
<!-- อัพโหลดรูป -->
<?=$auth_user->mf("5NJRBSNPEG0WCJHYQKI",$country_idx);?>
</button>
  </div>      

                   
 
                      
  <div class="form-group">
                          <label>
                            <!-- ชื่อบริษัท / องค์กร -->
                            <?=$auth_user->mf("1T39TK6ZCE0803DONX",$country_idx);?>
                          </label> <label style="color:red;">*</label>
                          <input type="text" class="form-control" id="cmn_name" name="cmn_name" value="<?=$dataRow['cmn_name']?>" required>
                        </div>
                        
                        <div class="form-group">
                          <label>
                            <!-- เบอร์โทร -->
                            <?=$auth_user->mf("G899PO8RRBZ819F3LVUP",$country_idx);?>
                          </label> 
                          
                          <label style="color:red;">*</label>
                          <input type="text" class="form-control" id="cmn_phone" name="cmn_phone" value="<?=$dataRow['cmn_phone']?>" required>
                        </div>

                        <div class="form-group">
                          <label>
                            <!-- ที่อยู่ -->
                            <?=$auth_user->mf("HTJRZDQRI1IR7ET68HL",$country_idx);?>
                          </label>
                          
                          <label style="color:red;">*</label>
                          <input type="text" class="form-control" id="cms_address" name="cms_address" value="<?=$dataRow['cms_address']?>" required>
                        </div>


                        <div class="form-group">
                          <label>
                            <!-- ไลน์ (รหัส Token) -->
                            <?=$auth_user->mf("KJTD8TCS5JMV2K0XLEL",$country_idx);?>
                          </label> <label style="color:red;">*</label>
                          <input type="text" class="form-control" id="cmn_line" name="cmn_line" required value="<?=$dataRow['cmn_line']?>">
                        </div>

                        <div class="form-group">
                          <label>
                            <!-- อีเมล -->
                            <?=$auth_user->mf("5FUF9OWQXK7GSBOFK51Z",$country_idx);?>
                          </label> 
                          <input type="text" class="form-control" id="cmn_mail" name="cmn_mail" value="<?=$dataRow['cmn_mail']?>" >
                        </div>
  

                    </div>
                  </div>
                </div>
              


                <div class="col-md-4 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">

                    
<h4 class="card-title">
  <!-- ตั้งค่าแบบเรียกหมวดหมู่ -->
  <?=$auth_user->mf("QTI8QNW9EBQTI4RQRAH6",$country_idx);?>
</h4>
 
<div class="form-group">
 <label>
   <!-- หมวดหมู่หลัก -->
   <?=$auth_user->mf("6LDBJKDD3SXFR29N14M",$country_idx);?>
 </label>
<input type="text" class="form-control"  name="cmn_name_main" id="cmn_name_main" required value="<?=$ctgm_name_main_x?>">
 </div>

 <div class="form-group">
 <label>
   <!-- หมวดหมู่ย่อย -->
   <?=$auth_user->mf("051CHXK74A55QJ8EJDZ",$country_idx);?>
 </label>
<input type="text" class="form-control"  name="cmn_name_sub" id="cmn_name_sub" required value="<?=$ctgs_name_main_x?>">
 </div>




                    

                    </div>
                  </div>
                </div>
            
              </div>
            </div>
        </div>
        <div class="form-group">
<center>   
  <hr>
  <button type="submit" class="btn btn-success mr-2" name="btn-submit-Form1"><?=$auth_user->mf("N7DNEI0JTJFKRRAT5F9",$country_idx);?></button>
  </center>
  </div>  
        </form>