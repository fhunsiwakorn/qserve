<?php
$stmt = $sql_process->runQuery("SELECT
tbl_user.user_id,
tbl_user.user_name,
tbl_user.user_password,
tbl_user.user_password_shows,
tbl_user.user_prefix,
tbl_user.user_firstname,
tbl_user.user_lastname,
tbl_user.user_email,
tbl_company.cmn_name,
tbl_user_detail.cmn_code
FROM
tbl_user ,
tbl_user_detail ,
tbl_company
WHERE
tbl_user.user_code = tbl_user_detail.user_code AND
tbl_user_detail.cmn_code = tbl_company.cmn_code AND
tbl_user.user_id=:user_id_param
");
$stmt->execute(array(":user_id_param"=>$_GET['UserAdminEdit']));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);

?>
<form method="post">
<input type="hidden" class="form-control"  name="user_id" id="user_id"   value="<?=$_GET['UserAdminEdit'];?>">
<h4 class="card-title">แบบฟอร์ม :: แก้ไข</h4>
 
<div class="form-group">
 <label>User Name</label>
<input type="text" class="form-control"  name="user_name" id="user_name" required placeholder="User Name" value="<?=$dataRow["user_name"];?>">
 </div>

 
 <div class="form-group">
 <label>User Password</label>
<input type="text" class="form-control"  name="user_password" id="user_password" required placeholder="User Password" value="<?=$dataRow["user_password_shows"];?>">
 </div>

 <div class="form-group">

<label>คำนำหน้า</label>   <label style="color:red;">*</label> 
                  
                  <select   class="form-control select2" style="width: 100%;" name="user_prefix" id="user_prefix" required>
                  <option value="">-- คำนำหน้า --</option>
                  <?php
                  $qa7 = $sql_process->runQuery(
                  "SELECT
                  tbl_master_titlename.title_name
                  FROM
                  tbl_master_titlename
                  WHERE
                  tbl_master_titlename.is_delete = '1' AND
                  tbl_master_titlename.title_status= '1'
                  ORDER BY
                  tbl_master_titlename.title_id ASC");
                  $qa7->execute();
                  while($rowH= $qa7->fetch(PDO::FETCH_OBJ)) {
                //   echo "<option value='$rowH->title_name'>$rowH->title_name</option>";
                echo"<option value='$rowH->title_name'";
                if ($dataRow['user_prefix'] == $rowH->title_name)
                {
                  echo "SELECTED";
                }
                echo ">$rowH->title_name</option>\n";
                    
                                   }
                  ?>
                                   
                  </select>
                </div>  

 <div class="form-group">
 <label>ชื่อ</label>
<input type="text" class="form-control"  name="user_firstname" id="user_firstname" required placeholder="ชื่อ" value="<?=$dataRow["user_firstname"];?>">
 </div>



 <div class="form-group">
 <label>นามสกุล</label>
<input type="text" class="form-control"  name="user_lastname" id="user_lastname" required placeholder="นามสกุล" value="<?=$dataRow["user_lastname"];?>">
 </div>

 <div class="form-group">
 <label>อีเมล</label>
<input type="text" class="form-control"  name="user_email" id="user_email" value="<?=$dataRow["user_email"];?>">
 </div>

 <div class="form-group">
                  <label>บริษัท /องค์กร</label>
                  <select class="form-control" name="cmn_code" required>
                    <option value="">--เลือก บริษัท /องค์กร--</option>
  <?php
$qa = $sql_process->runQuery(
"SELECT
cmn_code,
cmn_name
FROM
tbl_company
ORDER BY
tbl_company.cmn_name  ASC");
$qa->execute();
while($rowA= $qa->fetch(PDO::FETCH_OBJ)) {
// echo "<option value='$rowA->cmn_code'>$rowA->cmn_name</option>";
echo"<option value='$rowA->cmn_code'";
if ($dataRow["cmn_code"] == $rowA->cmn_code)
{
  echo "SELECTED";
}
echo ">$rowA->cmn_name</option>\n";

}
?>

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
                            title: "ลบข้อมูล <?=$dataRow["user_firstname"]?> และข้อมูลที่เกี่ยวข้องออกจากระบบ",
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
                            location.href = '?zone=<?=$zone?>&DELuserid=<?=$_GET['UserAdminEdit']?>';
                            } else {
                              swal("ยกเลิกการทำรายการ", "ปิดหน้าต่างนี้เพื่อทำรายการใหม่", "error");
                            }
                          });
                        }
               </script>