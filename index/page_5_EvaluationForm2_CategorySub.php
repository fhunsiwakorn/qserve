<?php
//ถ้ามีการค้นหา
if($q != NULL ){
  $stateSQL="AND (tbl_category_sub.ctgs_name LIKE '%$q%' OR tbl_category_main.ctgm_name LIKE '%$q%')";
}else{
  $stateSQL=NULL;
}
$button1=$auth_user->mf("F3LAM3S42TWX5UCRLCB",$country_idx);
$button2=$auth_user->mf("ZVUF8SYSAA43P81MDJU",$country_idx);
$t1=$auth_user->mf("45P3W32QRK9PLR67TQC",$country_idx);

// กำหนดสิทธิ์
$tx1=$auth_user->mf("OSOPVUILPY8Y21BCWRQZ",$country_idx);
// ยกเลิกข้อมูล
$tx2=$auth_user->mf("OYB3F05SHZ4ET89K0FU",$country_idx);
?>

 <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">
                        <!-- ขั้นตอนที่ 2 : กำหนดสิทธิ์แบบประเมินหัวข้อ  -->
                        <?=$auth_user->mf("I87BGAXL6XYC3K78WWRG",$country_idx);?> 
                        <b><?=$dataRow["eltp_name"]?></b> (<?=$ctgs_name_main_x ?>)</h4>
                    
                      <div class="form-group">
      <button  type="button" class="btn btn-outline-success" onclick="window.location.href='page_5_EvaluationFormChk.php?eltp_status_topic=<?=$dataRow['eltp_status_topic']?>&eltp=<?=$eltp_code_get?>&cmn_code=<?=$cmn_codex?>&q=<?=$q?>&status=ADD'" ><?=$button1?></button>
  <button  type="button" class="btn btn-outline-danger" onclick="window.location.href='page_5_EvaluationFormChk.php?eltp_status_topic=<?=$dataRow['eltp_status_topic']?>&eltp=<?=$eltp_code_get?>&cmn_code=<?=$cmn_codex?>&q=<?=$q?>&status=DEL'" ><?=$button2?></button>

  </div>             
                    
                      <div class="form-group">
  <form action="#" method="get"name="form1" class="sidebar-form" autocomplete="off">
      <input type="hidden" name="zone"  value="<?=$zone?>">
      <input type="hidden" name="eltp"  value="<?=$eltp_code_get?>">
        <div class="input-group">
          <input type="text" name="q" id="q" class="form-control" placeholder="<?=$g5?>..."  value="<?=$q?>">
          <span class="input-group-btn">
          <button type="submit"  class="btn btn-flat"><?=$g5?></i>
                </button>
              </span>
        </div>
      
      </form>   
      </div>  

                      
               

                      <div  style="width: 100%;overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
     <table id="example1" class="table table-bordered">
    <thead>
      <tr>
      <th><h5><?=$ctgs_name_main_x?></h5></th>
      <th><h5><?=$ctgm_name_main_x ?></h5></th>
        <th><h5><?=$t1?></h5></th>
      </tr>
      </thead>
      <tbody>
<?php


$total_data =$sql_process->rowsQuery("SELECT tbl_category_sub.ctgs_code FROM tbl_category_sub,tbl_category_main WHERE tbl_category_sub.ctgm_code=tbl_category_main.ctgm_code AND tbl_category_sub.ctgs_status ='1' AND tbl_category_sub.is_delete ='1' AND tbl_category_sub.cmn_code='$cmn_codex' $stateSQL");
$rows='5';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);

$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_category_sub.ctgs_name,
tbl_category_sub.ctgs_description,
tbl_category_sub.ctgs_status,
tbl_category_sub.ctgs_code,
tbl_category_main.ctgm_name
FROM
tbl_category_sub,
tbl_category_main
WHERE
tbl_category_sub.ctgm_code=tbl_category_main.ctgm_code AND
tbl_category_sub.is_delete ='1' AND
tbl_category_sub.ctgs_status='1' AND
tbl_category_sub.cmn_code=:cmn_code_param
$stateSQL
ORDER BY
tbl_category_main.ctgm_name ASC
limit $start,$rows
");
$qg->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;
$cgimg_code=$rowData->ctgs_code;
$Chk_permission =$sql_process->rowsQuery("SELECT tbl_evaluation_permission.evltp_id FROM tbl_evaluation_permission WHERE  cmn_code='$cmn_codex' AND  eltp_code ='$eltp_code_get' AND evltp_code='$rowData->ctgs_code'");
// class='table-success'
?>
      <tr <?php if($Chk_permission>=1){ echo "class='table-success'";} ?>   >
     
        <td><?=$rowData->ctgs_name?></td>
        <td><?=$rowData->ctgm_name?></td>
       
          <td align="center">
          <?php if($Chk_permission<=0){ ?>  
    

         <button type="button"  class="btn btn-icons btn-rounded btn-primary" onclick="window.location.href='page_5_EvaluationFormChk.php?cmn_code=<?=$cmn_codex?>&eltp=<?=$eltp_code_get?>&evltp_code_add=<?=$rowData->ctgs_code?>&page=<?=$page?>&q=<?=$q?>&#example1'" title="<?=$tx1?> <?=$rowData->ctgs_name?>" >
                          <i class="mdi mdi-key-plus"></i>
         </button>
          <?php } ?>
          <?php if($Chk_permission>=1){ ?>           
         <a  class="btn btn-icons btn-rounded btn-warning" href="page_5_EvaluationFormChk.php?cmn_code=<?=$cmn_codex?>&eltp=<?=$eltp_code_get?>&evltp_code_del=<?=$rowData->ctgs_code?>&page=<?=$page?>&q=<?=$q?>#example1"  onClick="javascript:return confirm('<?=$tx2?> <?=$rowData->ctgs_name?>');"  title="<?=$tx2?> <?=$rowData->ctgs_name?>">
                          <i class="mdi mdi-delete"></i>
         </a>
         <?php } ?>
        </td>
      
      </tr>

   

<?php } ?>
      </tbody>
      <tfoot>
      <tr>
      <th><h5><?=$ctgs_name_main_x?></h5></th>
      <th><h5><?=$ctgm_name_main_x ?></h5></th>
        <th><h5><?=$t1?></h5></th>
      </tr>
      </tfoot>
    </table>             
    </div>               

    <?php  require("pagingForEvalusationForm.php"); ?>
                    

                    </div>
                  </div>
                </div>
                
              

                