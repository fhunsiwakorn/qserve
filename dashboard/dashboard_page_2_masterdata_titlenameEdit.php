
<?php
$stmt = $sql_process->runQuery("SELECT title_name,language_status,title_status FROM tbl_master_titlename WHERE title_id=:title_id_param");
$stmt->execute(array(":title_id_param"=>$_GET['TitlenameEdit']));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<form method="post">
<input type="hidden" name="title_id" id="title_id"  value="<?=$_GET['TitlenameEdit']?>"/>
<h4 class="card-title">แบบฟอร์ม :: แก้ไข</h4>

<div class="form-group">
<label>คำนำหน้า</label>
<input type="text" class="form-control"  name="title_name" id="title_name" required  value="<?=$dataRow["title_name"]?>">
</div>   
 
<div class="form-group">
<label>เลือกภาษา</label>
<select name="language_status" id="language_status"  class="form-control">
<option value="1" <?php if($dataRow['language_status']=='1'){echo "SELECTED";} ?>>ภาษาไทย</option>
<option value="2" <?php if($dataRow['language_status']=='2'){echo "SELECTED";} ?>>ภาษาต่างชาติ</option>

</select>    
</div>

<div class="form-group">
<label>สถานะการใช้งาน</label>
<select name="title_status" id="title_status"  class="form-control">
<option value="1" <?php if($dataRow['title_status']=='1'){echo "SELECTED";} ?>>เปิด</option>
<option value="0" <?php if($dataRow['title_status']=='0'){echo "SELECTED";} ?>>ปิด</option>

</select>    
</div>
<div class="form-group">
<center>
  <button type="submit" class="btn btn-success mr-2" name="btn-submit-edit">บันทึกข้อมูล</button>
  <button type="button" onclick="move()" class="btn btn-danger mr-2" name="btn-submit-edit">ลบ</button>
  </center>
  </div>  

  
   

  </form>

  <script>
                        function move() {
                          swal({
                            title: "ลบ  <?=$dataRow["title_name"]?> และข้อมูลที่เกี่ยวข้องออกจากระบบ",
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
                            location.href = '?zone=<?=$zone?>&DELtitle_id=<?=$_GET['TitlenameEdit']?>';
                            } else {
                              swal("ยกเลิกการทำรายการ", "ปิดหน้าต่างนี้เพื่อทำรายการใหม่", "error");
                            }
                          });
                        }
               </script>