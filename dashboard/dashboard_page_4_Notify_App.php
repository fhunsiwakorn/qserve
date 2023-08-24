<?php

if(isset($_POST['cgr_id'])){
    $count=count($_POST['cgr_id']);
    for($i=0;$i<$count;$i++){
  $cgr_id=$_POST['cgr_id'][$i];
  $cgr_value=$_POST['cgr_value'][$i];
        $sql_process->fastQuery("UPDATE tbl_config_general SET cgr_value='$cgr_value'   WHERE cgr_id='$cgr_id'");
    }

    echo "<script>";
    echo "location.href = '?zone=Notify-App&success'";
    echo "</script>";

  }

if(isset($_GET['success'])){
    echo "<script>";
    echo 'swal("ทำรายการสำเร็จ !", "ปิดหน้าต่างนี้ !", "success")';
    echo "</script>";
}


?>



  <form   method="post" autocomplete="off">


            
             
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">ตั้งค่าเสริมแจ้งเตือน</h4>
                     
                      <?php

$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
*
FROM
tbl_config_general

ORDER BY
cgr_id ASC 
");
$qg->execute();
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;

?>

<div class="form-group">
                          <label><?=$rowData->cgr_name?></label> <label style="color:red;">*</label>
                          <input type="hidden" class="form-control" id="cgr_id[]" name="cgr_id[]" value="<?=$rowData->cgr_id?>">
                          <input type="text" class="form-control" id="cgr_value[]" name="cgr_value[]" value="<?=$rowData->cgr_value?>">
                        </div>

<?php } ?>

                   
<div class="form-group">
    <center>
                        <button type="submit" class="btn btn-success mr-2" name="btn-submit-add">บันทึกข้อมูล</button>
                        </center>
                        </div>          
                    

                    </div>
                  </div>
            
            </form>