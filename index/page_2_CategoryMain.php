<?php

if(isset($_GET['DELCategoryMain'])) {
    $ctgm_code = $_GET['DELCategoryMain'];
    $Del_1= $sql_process->fastQuery("UPDATE  tbl_category_main SET is_delete='0'   WHERE ctgm_code='$ctgm_code'");
      echo "<script>";
      echo "location.href = '?zone=CategoryMain&success'";
      echo "</script>";
    }
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 

$t1=$auth_user->mf("ZIWW44Y5AGX96X0NNUR",$country_idx);
$t2=$auth_user->mf("ZGURMBI4JPVS1ZE25DRM",$country_idx);
$t3=$auth_user->mf("45P3W32QRK9PLR67TQC",$country_idx);

$f1=$auth_user->mf("4U9N0HPRKM852Y9B5II",$country_idx);
$f2=$auth_user->mf("2UNYAQB1Q9W3FENTR11",$country_idx);
$f3=$auth_user->mf("8K5I8PYX4GYZRH172V46",$country_idx);
$f4=$auth_user->mf("JVB8N1P7S5FGQNTK9ME",$country_idx);
$f5=$auth_user->mf("2CDRDYXKYFKBVUSJZUZ",$country_idx);
$f6=$auth_user->mf("M5QUYH4ACMGV6FOVP2CS",$country_idx);
$f7=$auth_user->mf("2GGETH683C8MNNCCZX05",$country_idx);

$open= $auth_user->mf("1TIY9D1HPCVIDFOSHPH",$country_idx);
$close= $auth_user->mf("W9911FENKYG5KP3G4YF",$country_idx);
?>
<?php if(isset($_GET['success'])){ ?>
<script>
swal("<?=$g3?> !", "<?=$g4?> !", "success")
</script>
<?php } ?>

                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title"><?=$ctgm_name_main_x?>
                      <div align="right"> <button type="button" onclick="window.location.href='?zone=CategoryMainForm'" class="btn btn-success mr-2">
                      <!-- เพิ่มข้อมูล -->
                      <?=$auth_user->mf("7NFFJ34RJ2K9TQKMYYR8",$country_idx)?>
                    </button>
                  </div>
                    </h4>
                     


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
 <div  style="width: 100%;overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">

 <table id="example1" class="table table-bordered table-striped">
    <thead >
      <tr >
      <th><?=$ctgm_name_main_x?></th>
        <th><?=$t1?></th>
        <th><?=$t2?></th>
        <th><?=$t3?></th>
      </tr>
      </thead>
      <tbody>
<?php


if($q != NULL ){
  $stateSQL="AND tbl_category_main.ctgm_name LIKE '%$q%'";
}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT tbl_category_main.ctgm_code FROM tbl_category_main WHERE tbl_category_main.is_delete ='1'AND tbl_category_main.cmn_code='$cmn_codex' $stateSQL");
$rows='10';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);

$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_category_main.ctgm_code,
tbl_category_main.ctgm_name,
tbl_category_main.ctgm_description,
tbl_category_main.ctgm_status
FROM
tbl_category_main 
WHERE
tbl_category_main.is_delete ='1' AND
tbl_category_main.cmn_code=:cmn_code_param
$stateSQL
ORDER BY
tbl_category_main.ctgm_id DESC
limit $start,$rows
");
$qg->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;
$cgimg_code=$rowData->ctgm_code;
?>
      <tr>
     
        <td><?=$rowData->ctgm_name?></td>
        <td align="center" >
            <?php
            if($rowData->ctgm_status=='1'){
              echo '<label class="badge badge-success">';
              echo $open;
              echo "</label>";
            }elseif ($rowData->ctgm_status=='0') {
              echo '<label class="badge badge-danger">';
              echo $close;
              echo "</label>";
            }
             ?>

          </td>
          <td >
          <?=$rowData->ctgm_description?>
        </td>
            <td align="center">
            <button type="button" onclick="window.location.href='?zone=CategoryMainEdit&cc=<?=$rowData->ctgm_code?>'"  class="btn btn-info mr-2"><?=$f1?></button>
  <button type="button" onclick="move<?=$rowData->ctgm_code?>();" class="btn btn-danger mr-2"><?=$f2?></button>


  
  <script>
                        function move<?=$rowData->ctgm_code?>() {
                          swal({
                            title: "<?=$f2?> <?=$rowData->ctgm_name?>",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "<?=$f3?>",
                            cancelButtonText: "<?=$f4?>",
                            closeOnConfirm: false,
                            closeOnCancel: false
                          },
                          function(isConfirm){
                            if (isConfirm) {
                              swal("<?=$f5?>", "<?=$f6?>", "success");
                            location.href = '?zone=<?=$zone?>&DELCategoryMain=<?=$rowData->ctgm_code?>';
                            } else {
                              swal("<?=$f7?>", "<?=$f6?>", "error");
                            }
                          });
                        }
               </script>

            </td>
      </tr>

   

<?php } ?>
      </tbody>
      <tfoot>
      <tr>
      <th><?=$ctgm_name_main_x?></th>
      <th><?=$t1?></th>
        <th><?=$t2?></th>
        <th><?=$t3?></th>
      </tr>
      </tfoot>
    </table>  
        
    </div>               

    <?php  require("paging.php"); ?>


                    </div>
                  </div>
            