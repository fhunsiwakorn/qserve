<?php
$stmt = $sql_process->runQuery("SELECT * FROM tbl_location_zipcode WHERE zipcode_id=:zipcode_id_param");
$stmt->execute(array(":zipcode_id_param"=>$_GET['ZipcodeEdit']));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<script language=Javascript>
         function Inint_AJAX() {
            try { return new ActiveXObject("Msxml2.XMLHTTP");  } catch(e) {} //IE
            try { return new ActiveXObject("Microsoft.XMLHTTP"); } catch(e) {} //IE
            try { return new XMLHttpRequest();          } catch(e) {} //Native Javascript
            alert("XMLHttpRequest not supported");
            return null;
         };

         function dochange(src, val) {
              var req = Inint_AJAX();
              req.onreadystatechange = function () {
                   if (req.readyState==4) {
                        if (req.status==200) {
                             document.getElementById(src).innerHTML=req.responseText; //รับค่ากลับมา
                        }
                   }
              };
              req.open("GET", "../library/localtion.php?&province_idE=<?=$dataRow['province_id']?>&amphur_idE=<?=$dataRow['amphur_id']?>&district_idE=<?=$dataRow['district_id']?>&data="+src+"&val="+val); //สร้าง connection
              req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
              req.send(null); //ส่งค่า
         }
         
         window.onLoad=dochange('province_id', -1);
         window.onLoad=dochange('amphur_id', -1);
         window.onLoad=dochange('district_id', -1);
   
      
     </script>
<form method="post">

<input type="hidden" name="zipcode_id" id="zipcode_id"  value="<?=$_GET['ZipcodeEdit']?>"/>
<h4 class="card-title">แบบฟอร์ม</h4>
 
<div class="form-group">
                  <label for="exampleInputEmail1">ไปรษณีย์</label>
                  <input type="text" class="form-control" maxlength="5" name="zipcode" id="zipcode" value="<?=$dataRow['zipcode']?>" required placeholder="กรอกไปรษณีย์">
             </div>      
         
                <div class="form-group">
                <label>เลือกจังหวัด</label>
                <span id="province_id">
                <select class="form-control" required >
                <option value="" >- เลือกจังหวัด -</option>
                </select>
                </span>
                </div>   
                <div class="form-group">
                <label>เลือกอำเภอ</label>
                <span id="amphur_id">
                <select class="form-control" required >
                <option value="" >- เลือกอำเภอ -</option>
                </select>
                </span>
                </div>    
                <div class="form-group">
                <label>เลือกตำบล</label>
                <span id="district_id">
                <select class="form-control" required >
                <option value="" >- เลือกตำบล -</option>
                </select>
                </span>
                </div>  
                <div class="form-group">
                   <label>สถานะการใช้งาน</label>
                   <select name="zipcode_status" id="zipcode_status"  class="form-control">
                   <option value="1" <?php if($dataRow['zipcode_status']=='1'){echo "SELECTED";} ?>>เปิด</option>
                   <option value="0" <?php if($dataRow['zipcode_status']=='0'){echo "SELECTED";} ?>>ปิด</option>
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
                            title: "ลบ <?=$dataRow["zipcode"]?> และข้อมูลที่เกี่ยวข้องออกจากระบบ",
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
                            location.href = '?zone=<?=$zone?>&DELzipcode=<?=$_GET['ZipcodeEdit']?>';
                            } else {
                              swal("ยกเลิกการทำรายการ", "ปิดหน้าต่างนี้เพื่อทำรายการใหม่", "error");
                            }
                          });
                        }
               </script>