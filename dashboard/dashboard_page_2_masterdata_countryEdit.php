<?php
$country_id_get=strip_tags($_GET['CountryEdit']);
$stmt = $sql_process->runQuery("SELECT * FROM tbl_master_country WHERE country_id=:country_id_param");
$stmt->execute(array(":country_id_param"=>$country_id_get));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
$chk=$sql_process->rowsQuery("SELECT tbl_system_language.country_id FROM tbl_system_language WHERE tbl_system_language.country_id ='$country_id_get'");
?>

<form method="post" enctype="multipart/form-data">
<input type="hidden" name="country_id" id="country_id"  value="<?=$country_id_get?>"/>
<input type="hidden" name="before_img" id="before_img"  value="<?=$dataRow["country_flag"]?>"/>
<h4 class="card-title">แบบฟอร์ม :: แก้ไข</h4>
 
 
 

 <div class="form-group">
<label>ประเทศ</label>
   <input type="text" class="form-control" name="country_name" id="country_name" required   value="<?=$dataRow["country_name"]?>">
 </div> 

 <div class="form-group">
<label>รูปธงชาติ</label>
<input type="file" id="imageupload" name="imageupload"   >
</div> 

                
                <div class="form-group">
                   <label>สถานะการใช้งาน</label>
                   <select name="country_status" id="country_status"  class="form-control">
                   <option value="1" <?php if($dataRow['country_status']=='1'){echo "SELECTED";} ?>>เปิด</option>
                   <option value="0" <?php if($dataRow['country_status']=='0'){echo "SELECTED";} ?>>ปิด</option>
                 </select>
        
              </div>


<div class="form-group">
<center>
  <button type="submit" class="btn btn-success mr-2" name="btn-submit-edit">บันทึกข้อมูล</button>
  <button type="button" onclick="move()" class="btn btn-danger mr-2" name="btn-submit-edit" <?php if($chk>=1) { echo "disabled";} ?>>ลบ</button>
  </center>
  </div>  
  </form>

  <script>
                        function move() {
                          swal({
                            title: "ลบประเทศ <?=$dataRow["country_name"]?> และข้อมูลที่เกี่ยวข้องออกจากระบบ",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "ใช่!",
                            cancelButtonText: "ไม่ใช่!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                          },
                          function(isConfirm){
                            if (isConfirm) {
                              swal("ทำรายการเรียบร้อย!", "ปิดหน้าต่างนี้เพื่อทำรายการใหม่", "success");
                            location.href = '?zone=<?=$zone?>&DELcountry=<?=$_GET['CountryEdit']?>';
                            } else {
                              swal("ยกเลิกการทำรายการ", "ปิดหน้าต่างนี้เพื่อทำรายการใหม่", "error");
                            }
                          });
                        }
               </script>