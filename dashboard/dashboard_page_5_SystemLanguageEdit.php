<?php
$stlg_code_get=strip_tags($_GET["stlg"]);
$stmt = $sql_process->runQuery("SELECT * FROM tbl_system_language WHERE stlg_code=:stlg_code_param");
$stmt->execute(array(":stlg_code_param"=>$stlg_code_get));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<div class="card">
                    <div class="card-body">
               
               
                    <h4 class="card-title">แบบฟอร์มเพิ่มข้อมูลจัดการภาษาระบบ</h4>
 
                    <form method="post" enctype="multipart/form-data" action="dashboard_page_5_SystemLanguageChk.php" autocomplete="off">
                    <input type="hidden" class="form-control" name="stlg_code" value="<?=$stlg_code_get?>">
<?php foreach ($sql_process->fechdata("tbl_master_country","country_status ='1'  AND is_delete='1'") as $value) {  
    $stlg_text= $sql_process->lookupfild3("stlg_text","tbl_system_language","stlg_code='$stlg_code_get' AND country_id='".$value["country_id"]."'");
    ?>

<div class="form-group">
<label><?=$value["country_name"]?></label>
                        <div class="input-group"> 
                          <div class="input-group-prepend">
                            <span class="input-group-text"><img src="../images/images_flag/<?=$value["country_flag"]?>" style="height:30px; width:40px;"/></span>
                          </div>
                          <input type="hidden" class="form-control" name="country_id[]" value="<?=$value["country_id"]?>">
                          <input type="text" class="form-control" name="stlg_text[]" placeholder="<?=$value["country_name"]?>" value="<?=$stlg_text?>" <?php if($value["country_id"] ==1){ echo "readonly";} ?> >
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
              