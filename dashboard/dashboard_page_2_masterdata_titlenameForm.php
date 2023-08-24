<form method="post">
<h4 class="card-title">แบบฟอร์ม</h4>
 
<div class="form-group">
 <label>คำนำหน้า</label>
<input type="text" class="form-control"  name="title_name" id="title_name" required placeholder="คำนำหน้า">
 </div>

 <div class="form-group">
                   <label>เลือกภาษา</label>
                   <select name="language_status" id="language_status"  class="form-control">
                   <option value="1">ภาษาไทย</option>
                   <option value="2">ภาษาต่างชาติ</option>
                 </select>
        
              </div>
                
                <div class="form-group">
                   <label>สถานะการใช้งาน</label>
                   <select name="title_status" id="title_status"  class="form-control">
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