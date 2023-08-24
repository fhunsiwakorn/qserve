<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 

// 
if(isset($_GET['DELeltp'])) {
    $eltp_code = $_GET['DELeltp'];
    $Del_1= $sql_process->fastQuery("UPDATE  tbl_evaluation_topic SET is_delete='0'   WHERE eltp_code='$eltp_code'");
      echo "<script>";
      echo "location.href = '?zone=EvaluationData&success'";
      echo "</script>";
    }
  

  $t1 =  $auth_user->mf("WVA0K7KJQ0KR5O524AG",$country_idx);
  $t2 =  $auth_user->mf("ZGURMBI4JPVS1ZE25DRM",$country_idx);
  $t3 =  $auth_user->mf("4NM48ST6Y18XWHU7LK",$country_idx);
  $t4 =  $auth_user->mf("06B2D339GGZUOT5CB6AL",$country_idx);
  $t5 =  $auth_user->mf("7T7UZADUU8I4XOW0AWD",$country_idx);
  $t6 =  $auth_user->mf("ZPSDY8NUIJ7IQBMRJG3M",$country_idx);

  $company =  $auth_user->mf("XSBMHS8Q0OJOT7VRTLNA",$country_idx);
  $personal =  $auth_user->mf("82BS90L39GV79H0CHXJ",$country_idx);

$yes= $auth_user->mf("8K5I8PYX4GYZRH172V46",$country_idx);
$no= $auth_user->mf("JVB8N1P7S5FGQNTK9ME",$country_idx);

$success= $auth_user->mf("2CDRDYXKYFKBVUSJZUZ",$country_idx);
$error= $auth_user->mf("2GGETH683C8MNNCCZX05",$country_idx);
$close= $auth_user->mf("M5QUYH4ACMGV6FOVP2CS",$country_idx);
$del= $auth_user->mf("2UNYAQB1Q9W3FENTR11",$country_idx);
?>
<?php if(isset($_GET['success'])){ ?>
<script>
swal("<?=$g3?> !", "<?=$g4?> !", "success")
</script>
<?php } ?>
<div class="row">
          

          <div class="col-lg-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">
                  <!-- ข้อมูลแบบประเมิน -->
                  <?=$auth_user->mf("BB7A2P36J5V0Y95TVPA",$country_idx);?>
                </h4>
                <div class="table-responsive">
            
                <div class="form-group">
  <form action="#" method="get"name="form1" class="sidebar-form" autocomplete="off">
      <input type="hidden" name="zone"  value="<?=$zone?>">
        <div class="input-group">
          <input type="text" name="q" id="q" class="form-control" placeholder="<?=$g5?>..." >
          <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><?=$g5?></i>
                </button>
              </span>
        </div>
      
      </form>   
      </div>  

                <div class="table-responsive">
                      <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr >
      <th>#</th>
        <th><?=$t1?></th>
        <th><?=$t2?></th>
        <th><?=$t3?></th>
        <th><?=$t4?></th>
        <th><?=$t5?></th>
        <th><?=$t6?></th>
      </tr>
      </thead>
      <tbody>
<?php


if($q != NULL ){
  $stateSQL="AND tbl_evaluation_topic.eltp_name LIKE '%$q%'";
}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT
tbl_evaluation_topic.eltp_id
FROM
tbl_evaluation_topic
WHERE
tbl_evaluation_topic.is_delete = '1' AND
tbl_evaluation_topic.cmn_code = '$cmn_codex'
$stateSQL");

$rows='10';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);
$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_evaluation_topic.eltp_code,
tbl_evaluation_topic.eltp_name,
tbl_evaluation_topic.eltp_description,
tbl_evaluation_topic.eltp_status_topic,
tbl_evaluation_topic.crt_by,
tbl_evaluation_topic.crt_date,
tbl_evaluation_topic.upd_by,
tbl_evaluation_topic.upd_date,
tbl_evaluation_topic.eltp_status,
tbl_evaluation_topic.eltp_id
FROM
tbl_evaluation_topic
WHERE
tbl_evaluation_topic.cmn_code=:cmn_code_param AND
tbl_evaluation_topic.is_delete = '1' 
$stateSQL
ORDER BY
tbl_evaluation_topic.eltp_id DESC
limit $start,$rows
");
$qg->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;
$chk_data =$sql_process->rowsQuery("SELECT eltda_id FROM tbl_evaluation_data WHERE eltp_code ='$rowData->eltp_code' ");
?>
      <tr >
      <td align="center">
        <div class="btn-group" role="group" aria-label="Basic example">
             <button type="button" class="btn btn-primary" onclick="window.location.href='?zone=Evaluation-QrCode&eltp=<?=$rowData->eltp_code?>'" <?php if($chk_data<=0) { echo "disabled";} ?>>    <i class="mdi mdi-qrcode"></i></button>
             <button type="button" class="btn btn-primary" onclick="window.location.href='?zone=EvaluationForm1E&eltp=<?=$rowData->eltp_code?>'"> <i class="mdi mdi-grease-pencil"></i></button>
             <button type="button" class="btn btn-primary" onclick="move<?=$num_gen?>()">    <i class="mdi mdi-delete"></i></button>
        </div>

        <script>
                        function move<?=$num_gen?>() {
                          swal({
                            title: "<?=$del?> <?=$rowData->eltp_name?>",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "<?=$yes?>",
                            cancelButtonText: "<?=$no?>",
                            closeOnConfirm: false,
                            closeOnCancel: false
                          },
                          function(isConfirm){
                            if (isConfirm) {
                              swal("<?=$success?>", "<?=$close?>", "success");
                            location.href = '?zone=<?=$zone?>&DELeltp=<?=$rowData->eltp_code?>';
                            } else {
                              swal("<?=$error?>", "<?=$close?>", "error");
                            }
                          });
                        }
               </script>

        </td>
         <td><?=$rowData->eltp_name?></td>
        <td><?=$rowData->eltp_description?></td>
        <td>
<?php
if($rowData->eltp_status_topic==1){
//  echo "บริษัท / หน่วยงาน";
echo  $company;
}elseif($rowData->eltp_status_topic==2){
  echo $ctgm_name_main_x;
}elseif($rowData->eltp_status_topic==3){
  echo $ctgs_name_main_x;
}elseif($rowData->eltp_status_topic==4){
  // echo "บุคลากร/เจ้าหน้าที่";
  echo $personal;
}

?>

        </td>
        <td align="center"><?=$sql_process->rowsQuery("SELECT eltp_code FROM tbl_evaluation_data WHERE eltp_code ='$rowData->eltp_code' AND is_delete='1' ");?></td>
        <td><?=DatetoDMYTime($rowData->crt_date)?></td>
        <td><?=DatetoDMYTime($rowData->upd_date)?></td>
      
     
        
      </tr>
      
   
    
<?php } ?>
      </tbody>
      <tfoot>
      <tr>
      <th>#</th>
      <th><?=$t1?></th>
        <th><?=$t2?></th>
        <th><?=$t3?></th>
        <th><?=$t4?></th>
        <th><?=$t5?></th>
        <th><?=$t6?></th>
       
      </tr>
      </tfoot>
    </table>          
    </div>               

    <?php  require("paging.php"); ?>


                </div>
              </div>
            </div>
          </div>

        </div>