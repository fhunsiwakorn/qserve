<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
?>
<div align="center">
    <h3>
 <?=$dataRow["eltp_name"]?>
 </h3>
 </div>
<div class="wrap-input100 validate-input" >
<form mthod="get" style="width:100%;">
<input type="hidden" name="eltp" value="<?=$eltp_code_get?>"  /> 
<input type="hidden" name="evltp" value="<?=$evltp_code_get?>"  /> 
<div class="form-group">
<!-- <label>ประเมินบุคลากร</label> -->
<select name="q" id="q"  class="form-control" required onchange="submit();">
<option value="">--<?=$txt1?>--</option>
<?php
$qa = $sql_process->runQuery(
"SELECT
tbl_user.user_firstname,
tbl_user.user_lastname,
tbl_user.user_code
FROM
tbl_user ,
tbl_evaluation_permission
WHERE
tbl_user.user_code = tbl_evaluation_permission.evltp_code AND
tbl_evaluation_permission.eltp_code =:eltp_code_param AND
tbl_evaluation_permission.cmn_code=:cmn_code_param
ORDER BY
tbl_evaluation_permission.evltp_id DESC
");
$qa->execute(array(":eltp_code_param"=>$eltp_code_get,":cmn_code_param"=>$cmn_codex));
while($rowA= $qa->fetch(PDO::FETCH_OBJ)) {
// echo "<option value='$rowA->user_code'>$rowA->user_firstname $rowA->user_lastname</option>";
 echo"<option value='$rowA->user_code'";
 if ($q == $rowA->user_code)
 {
   echo "SELECTED";
 }
 echo ">$rowA->user_firstname $rowA->user_lastname</option>\n";
 }
?>

</select>  
</form>  
</div>


<div class="table-responsive">
                    <table class="table" style="width:100%;">
                      <thead>
                        <tr>
   
        <th><?=$txt2?></th>
         <th><?=$txt10?></th>
        <th><?=$ctgm_name_main_x?></th>
        <th><?=$ctgs_name_main_x?></th>
        <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                          
<?php


if($q != NULL ){
 $stateSQL="AND tbl_user.user_code='$q'";

}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT 
tbl_user.user_code
FROM
tbl_evaluation_permission ,
tbl_user
WHERE
tbl_evaluation_permission.evltp_code = tbl_user.user_code AND
tbl_user.is_delete = '1' AND
tbl_evaluation_permission.eltp_code ='$eltp_code_get' AND
tbl_evaluation_permission.cmn_code='$cmn_codex'
$stateSQL");
$rows='5';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);

$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_user.user_firstname,
tbl_user.user_lastname,
tbl_user.user_img,
tbl_user.user_code,
tbl_category_main.ctgm_name,
tbl_category_sub.ctgs_name
FROM
tbl_evaluation_permission ,
tbl_user ,
tbl_user_detail ,
tbl_category_main ,
tbl_category_sub
WHERE
tbl_evaluation_permission.evltp_code = tbl_user.user_code AND
tbl_user.is_delete = '1' AND
tbl_user.user_code = tbl_user_detail.user_code AND
tbl_user_detail.ctgm_code = tbl_category_main.ctgm_code AND
tbl_user_detail.ctgs_code = tbl_category_sub.ctgs_code AND
tbl_evaluation_permission.eltp_code =:eltp_code_param AND
tbl_evaluation_permission.cmn_code=:cmn_code_param
$stateSQL
ORDER BY
tbl_evaluation_permission.evltp_id DESC
limit $start,$rows
");
$qg->execute(array(":eltp_code_param"=>$eltp_code_get,":cmn_code_param"=>$cmn_codex));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
  $Chek_resultA =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='$rowData->user_code' AND evltp_user_agent='$useragent' AND DATE(evltp_date)='$date_current'");
$num_gen++;
//user Image

if(!empty($rowData->user_img)){
    $pathuserimg1="../images/images_user/".$rowData->user_img;
  }else{
    $pathuserimg1="../images/images_web/user.png";
  }
  $strFileImg1=base64_encode_image($pathuserimg1);
?>

                        <tr>
                    
                          <td>
                          <a class="thumbnail" href="<?=$strFileImg1?>" data-lightbox="example-set-user" data-title="<?=$rowData->user_firstname?> <?=$rowData->user_lastname?>">
                        <div class="gallery">
                        <img src="<?=$strFileImg1?>" alt="<?=$rowData->user_firstname?> <?=$rowData->user_lastname?>" class="circle" class="example-image" style="height:70px; width:70px;"/>
                        </div>
                        </a>
                          </td>
                          <td><?=$rowData->user_firstname?> <?=$rowData->user_lastname?></td>
                          <td><?=$rowData->ctgm_name?></td>
                          <td><?=$rowData->ctgs_name?></td> 
                          <td>
                          <button type="button" onclick="window.location.href='?eltp=<?=$eltp_code_get?>&evltp=<?=$rowData->user_code?>'" class="login100-form-btn" >
                          <!-- ประเมิน -->
                          <?=$txt3?>
                        </button>
                            <?php 
                            if($Chek_resultA >0){
                              // echo "<font size='-1' color='red'>คุณเคยทำแบบประเมินนี้แล้ว..</font>";
                              echo "<font size='-1' color='red'>$txt4</font>";
                            }
                            ?>
                        </td>    
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
         <?php include("paging.php");?>
                  <div class="login100-form validate-form" style="width:100%;">
          <?php include("footer.php");?>
          </div>
          </div>
              