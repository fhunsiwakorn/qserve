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
              req.open("GET", "../library/localtion.php?data="+src+"&val="+val); //สร้าง connection
              req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
              req.send(null); //ส่งค่า
         }
         
         window.onLoad=dochange('province_id', -1);
      
     </script>
<form method="post">
<h4 class="card-title">แบบฟอร์ม</h4>
 
<div class="form-group">
                  <label for="exampleInputEmail1">ไปรษณีย์</label>
                  <input type="text" class="form-control" maxlength="5" name="zipcode" id="zipcode" required placeholder="กรอกไปรษณีย์">
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
                   <option value="1">เปิด</option>
                   <option value="0">ปิด</option>
                 </select>
        
              </div>          


<div class="form-group">
<center>
  <button type="submit" class="btn btn-success mr-2" name="btn-submit-add">บันทึกข้อมูล</button>
  </center>
  </div>  
  </form>