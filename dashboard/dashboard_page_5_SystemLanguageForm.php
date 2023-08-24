<div class="card">
                    <div class="card-body">
               
               
                    <h4 class="card-title">แบบฟอร์มเพิ่มข้อมูลจัดการภาษาระบบ</h4>
 
                    <form method="post" enctype="multipart/form-data" action="dashboard_page_5_SystemLanguageChk.php" autocomplete="off">
                    <input type="hidden" class="form-control" name="stlg_code" value="<?=random_password(20)?>">
<?php foreach ($sql_process->fechdata("tbl_master_country","country_status ='1'  AND is_delete='1'") as $value) {  ?>

<div class="form-group">
<label><?=$value["country_name"]?></label>
                        <div class="input-group"> 
                          <div class="input-group-prepend">
                            <span class="input-group-text"><img src="../images/images_flag/<?=$value["country_flag"]?>" style="height:30px; width:40px;"/></span>
                          </div>
                          <input type="hidden" class="form-control" name="country_id[]" value="<?=$value["country_id"]?>">
                          <input type="text" class="form-control" name="stlg_text[]" placeholder="<?=$value["country_name"]?>">
                        </div>
                      </div>

<?php } ?>


<div class="form-group">
<center>
  <button type="submit" class="btn btn-success mr-2" name="btn-submit-add">บันทึกข้อมูล</button>
  </center>
  </div>  
  </form>





                    </div>
                  </div>
              