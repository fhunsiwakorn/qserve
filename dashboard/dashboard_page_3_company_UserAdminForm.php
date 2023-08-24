<form method="post">
  <h4 class="card-title">แบบฟอร์ม</h4>

  <div class="form-group">
    <label>User Name</label>
    <input type="text" class="form-control" name="user_name" id="user_name" required placeholder="User Name" maxlength="20">
  </div>


  <div class="form-group">
    <label>User Password</label>
    <input type="text" class="form-control" name="user_password" id="user_password" required placeholder="User Password" maxlength="20">
  </div>

  <div class="form-group">

    <label>คำนำหน้า</label> <label style="color:red;">*</label>

    <select class="form-control select2" style="width: 100%;" name="user_prefix" id="user_prefix" required>
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
                  tbl_master_titlename.title_id ASC"
      );
      $qa7->execute();
      while ($rowH = $qa7->fetch(PDO::FETCH_OBJ)) {
        echo "<option value='$rowH->title_name'>$rowH->title_name</option>";
      }
      ?>

    </select>
  </div>

  <div class="form-group">
    <label>ชื่อ</label>
    <input type="text" class="form-control" name="user_firstname" id="user_firstname" required placeholder="ชื่อ">
  </div>



  <div class="form-group">
    <label>นามสกุล</label>
    <input type="text" class="form-control" name="user_lastname" id="user_lastname" required placeholder="นามสกุล">
  </div>

  <div class="form-group">
    <label>อีเมล</label>
    <input type="text" class="form-control" name="user_email" id="user_email">
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
tbl_company.cmn_name  ASC"
      );
      $qa->execute();
      while ($rowA = $qa->fetch(PDO::FETCH_OBJ)) {
        echo "<option value='$rowA->cmn_code'>$rowA->cmn_name</option>";
      }
      ?>

    </select>
  </div>


  <div class="form-group">
    <center>
      <button type="submit" class="btn btn-success mr-2" name="btn-submit-add">บันทึกข้อมูล</button>
    </center>
  </div>
</form>