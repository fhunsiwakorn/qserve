<form method="post" enctype="multipart/form-data">
<h4 class="card-title">แบบฟอร์ม</h4>
 
<div class="form-group">
 <label>ประเทศ</label>
<input type="text" class="form-control"  name="country_name" id="country_name" required placeholder="ประเทศ">
 </div>

 
 <div class="form-group">
<label>รูปธงชาติ</label>
<input type="file" id="imageupload" name="imageupload"   required>
</div> 

                
                <div class="form-group">
                   <label>สถานะการใช้งาน</label>
                   <select name="country_status" id="country_status"  class="form-control">
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