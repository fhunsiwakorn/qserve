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
<option value="">--<?=$txt1?> <?=$ctgs_name_main_x?>--</option>
<?php
$qa = $sql_process->runQuery(
"SELECT
tbl_evaluation_permission.cmn_code,
tbl_category_sub.ctgs_code,
tbl_category_sub.ctgs_name,
tbl_category_sub.ctgs_code
FROM
tbl_evaluation_permission ,
tbl_category_sub,
tbl_category_main
WHERE
tbl_category_sub.ctgm_code = tbl_category_main.ctgm_code AND
tbl_evaluation_permission.evltp_code = tbl_category_sub.ctgs_code AND
tbl_evaluation_permission.eltp_code =:eltp_code_param AND
tbl_evaluation_permission.cmn_code=:cmn_code_param AND
tbl_category_sub.is_delete = '1' AND
tbl_category_sub.ctgs_status = '1'  
ORDER BY
tbl_evaluation_permission.evltp_id DESC
");
$qa->execute(array(":eltp_code_param"=>$eltp_code_get,":cmn_code_param"=>$cmn_codex));
while($rowA= $qa->fetch(PDO::FETCH_OBJ)) {

 echo"<option value='$rowA->ctgs_code'";
 if ($q == $rowA->ctgs_code)
 {
   echo "SELECTED";
 }
 echo ">$rowA->ctgs_name</option>\n";
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
        <th><?=$ctgs_name_main_x?></th>
        <th><?=$ctgm_name_main_x?></th>
        <th>#</th>
                        </tr>
                      </thead>
                      <tbody>
                          
<?php


if($q != NULL ){
 $stateSQL="AND tbl_category_sub.ctgs_code='$q'";

}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT 
tbl_category_sub.ctgs_code
FROM
tbl_evaluation_permission ,
tbl_category_sub,
tbl_category_main
WHERE
tbl_category_sub.ctgm_code = tbl_category_main.ctgm_code AND
tbl_evaluation_permission.evltp_code = tbl_category_sub.ctgs_code AND
tbl_category_sub.is_delete = '1' AND
tbl_category_sub.ctgs_status = '1'  AND
tbl_evaluation_permission.eltp_code ='$eltp_code_get' AND
tbl_evaluation_permission.cmn_code='$cmn_codex'
$stateSQL
");

$rows='5';
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);

$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_evaluation_permission.eltp_code,
tbl_evaluation_permission.evltp_code,
tbl_category_sub.ctgs_name,
tbl_category_main.ctgm_name,
tbl_category_sub.ctgs_code
FROM
tbl_evaluation_permission ,
tbl_category_main,
tbl_category_sub
WHERE
tbl_category_sub.ctgm_code = tbl_category_main.ctgm_code AND
tbl_evaluation_permission.evltp_code = tbl_category_sub.ctgs_code AND
tbl_evaluation_permission.eltp_code=:eltp_code_param AND
tbl_evaluation_permission.cmn_code=:cmn_code_param  AND
tbl_category_sub.is_delete = '1' AND
tbl_category_sub.ctgs_status = '1'  
$stateSQL
ORDER BY
tbl_evaluation_permission.evltp_id DESC
limit $start,$rows
");
$qg->execute(array(":eltp_code_param"=>$eltp_code_get,":cmn_code_param"=>$cmn_codex));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;
$Chek_resultA =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='$rowData->ctgs_code' AND  evltp_user_agent='$useragent' AND DATE(evltp_date)='$date_current' ");
$cgimg_name= $sql_process->QueryField1("tbl_category_img","cgimg_name","cgimg_code='$rowData->ctgs_code'");
if(!empty($cgimg_name)){
    $pathuserimg1="../images/images_catagory/".$cgimg_name;
  }else{
    $pathuserimg1="../images/images_web/1547020644No_Image_Available.jpg";
  }
//   $pathuserimg1="../images/images_web/user.png";
  $strFileImg1=base64_encode_image($pathuserimg1);
?>

                        <tr>
                      
                          <td>
                          <a class="thumbnail" href="<?=$strFileImg1?>" data-lightbox="example-set-user" data-title="<?=$rowData->ctgm_name?>">
                        <div class="gallery">
                        <img src="<?=$strFileImg1?>" alt="<?=$rowData->ctgm_name?>" class="circle" class="example-image" style="height:70px; width:70px;"/>
                        </div>
                        </a>
                          </td>
                          <td><?=$rowData->ctgs_name?></td>
                          <td><?=$rowData->ctgm_name?></td> 
                          <td>  
                          <button type="button" onclick="window.location.href='?eltp=<?=$eltp_code_get?>&evltp=<?=$rowData->ctgs_code?>'" class="login100-form-btn" >
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
              