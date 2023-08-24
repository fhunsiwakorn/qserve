<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 

$col1=$auth_user->mf("0L20HQ576Q0V5NOBXZD2",$country_idx);
$col2=$auth_user->mf("4NM48ST6Y18XWHU7LK",$country_idx);
$col3=$auth_user->mf("C337ZWNQ9GSC62UE5OT",$country_idx);
$col4=$auth_user->mf("CI7HB4AA31EAKSYBOS",$country_idx);
$col5=$auth_user->mf("C1CYSHCU106Q3E6T33OP",$country_idx);
$col6=$auth_user->mf("HDBE4D7IB9LX4FOREH5W",$country_idx);

$g1=$auth_user->mf("XSBMHS8Q0OJOT7VRTLNA",$country_idx);
$g2=$auth_user->mf("82BS90L39GV79H0CHXJ",$country_idx);
?>
<div class="row"> 
          

          <div class="col-lg-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">
                <!-- ประวัติการประเมิน -->
                <?=$auth_user->mf("YIGVXMUW7S4CHJY0DMOT",$country_idx)?>
                </h4>
                <div class="table-responsive">
            
                <div class="form-group">
  <form action="#" method="get"name="form1" class="sidebar-form" autocomplete="off">
      <input type="hidden" name="zone"  value="<?=$zone?>">
        <div class="input-group">
        <select name="q" id="q" class="form-control" required onchange="submit();">
<option value="" >--<?=$auth_user->mf("5PNAE6GIA1FHVNZCCE0",$country_idx)?>--</option>
<?php 
$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_evaluation_topic.eltp_name,
tbl_evaluation_topic.eltp_code
FROM
tbl_evaluation_topic 
WHERE
tbl_evaluation_topic.eltp_status='1' AND
tbl_evaluation_topic.is_delete='1' AND
tbl_evaluation_topic.cmn_code=:cmn_code_param
ORDER BY
tbl_evaluation_topic.eltp_id DESC
");
$qg->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;
echo"<option value='$rowData->eltp_code'";
if ($q == $rowData->eltp_code)
{
echo "SELECTED";
}
echo ">$rowData->eltp_name</option>\n";
}
?>

</select>
        </div>
      
      </form>   
      </div>  

                <div  style="width: 100%;overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
                      <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th><?=$col1?></th>
        <th>IP</th>
        <th><?=$col2?></th>
        <th><?=$col3?></th>
        <th><?=$col4?></th>
        <th><?=$col5?></th>
        <th><?=$col6?></th>
      </tr>
      </thead>
      <tbody>
<?php


if($q != NULL ){
  $stateSQL="AND tbl_evaluation_result.eltp_code = '$q'";
}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT
tbl_evaluation_result.evltr_id
FROM
tbl_evaluation_result
WHERE
tbl_evaluation_result.cmn_code = '$cmn_codex'
$stateSQL");

$rows='10';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);
$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_evaluation_result.evltr_avg,
tbl_evaluation_result.cmn_code,
tbl_evaluation_result.eltp_code,
tbl_evaluation_result.evltp_code,
tbl_evaluation_result.evltp_phone,
tbl_evaluation_result.evltp_ip,
tbl_evaluation_result.evltp_date,
tbl_evaluation_result.evltr_id,
tbl_evaluation_result.evltp_remark,
tbl_evaluation_topic.eltp_status_topic,
tbl_evaluation_topic.eltp_name
FROM
tbl_evaluation_result ,
tbl_evaluation_topic
WHERE
tbl_evaluation_result.eltp_code = tbl_evaluation_topic.eltp_code AND
tbl_evaluation_topic.cmn_code=:cmn_code_param 
$stateSQL
ORDER BY
tbl_evaluation_result.evltr_id DESC
limit $start,$rows
");
$qg->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;

?>
      <tr >

         <td><?=$rowData->evltp_phone?></td>
        <td><?=$rowData->evltp_ip?></td>
        <td>
<?php
if($rowData->eltp_status_topic==1){
//  echo "บริษัท / หน่วยงาน";
echo $g1;
}elseif($rowData->eltp_status_topic==2){
  echo $ctgm_name_main_x;
}elseif($rowData->eltp_status_topic==3){
  echo $ctgs_name_main_x;
}elseif($rowData->eltp_status_topic==4){
  // echo "บุคลากร/เจ้าหน้าที่";
  echo $g2;
}

?>

        </td>
        <td><?=$rowData->eltp_name?></td>
        <td align="center"><?=number_format($rowData->evltr_avg,2)?></td>
        <td><?=$rowData->evltp_remark?></td>
        <td><?=DatetoDMYTime($rowData->evltp_date)?></td>
      
      </tr>
      
   
    
<?php } ?>
      </tbody>
      <tfoot>
      <tr>
      <th><?=$col1?></th>
        <th>IP</th>
        <th><?=$col2?></th>
        <th><?=$col3?></th>
        <th><?=$col4?></th>
        <th><?=$col5?></th>
        <th><?=$col6?></th>
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