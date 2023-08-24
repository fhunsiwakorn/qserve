
<?php
$stmt = $sql_process->runQuery("SELECT nationality_name,nationality_status FROM tbl_master_nationality WHERE nationality_id=:nationality_id_param");
$stmt->execute(array(":nationality_id_param"=>$_GET['NationalityEdit']));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<form method="post">
<input type="hidden" name="nationality_id" id="nationality_id"  value="<?=$_GET['NationalityEdit']?>"/>
<h4 class="card-title">แบบฟอร์ม :: แก้ไข</h4>

<div class="form-group">
<label>สัญชาติ</label>
<input type="text" class="form-control"  name="nationality_name" id="nationality_name" required  value="<?=$dataRow["nationality_name"]?>">
</div>   
 
<div class="form-group">
<label>สถานะการใช้งาน</label>
<select name="nationality_status" id="nationality_status"  class="form-control">
<option value="1" <?php if($dataRow['nationality_status']=='1'){echo "SELECTED";} ?>>เปิด</option>
<option value="0" <?php if($dataRow['nationality_status']=='0'){echo "SELECTED";} ?>>ปิด</option>

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
                            title: "ลบ  <?=$dataRow["nationality_name"]?> และข้อมูลที่เกี่ยวข้องออกจากระบบ",
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
                            location.href = '?zone=<?=$zone?>&DELnationality_id=<?=$_GET['NationalityEdit']?>';
                            } else {
                              swal("ยกเลิกการทำรายการ", "ปิดหน้าต่างนี้เพื่อทำรายการใหม่", "error");
                            }
                          });
                        }
               </script>