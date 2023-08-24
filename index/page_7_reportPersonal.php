<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
$current_month = isset($_GET['current_month']) ? $_GET['current_month'] : date("m"); 
$current_year  = isset($_GET['current_year ']) ? $_GET['current_year '] :  date("Y");

$eltp = isset($_GET['eltp']) ? $_GET['eltp'] :NULL; 
$evltp_code = isset($_GET['evltp']) ? $_GET['evltp'] :NULL; 
if($eltp != NULL){
    $stageSql="AND tbl_evaluation_topic.eltp_code='$eltp'";
}else{
    $stageSql=NULL;
}

if($evltp_code != NULL){
    $stageSqlA="AND tbl_evaluation_result.evltp_code='$evltp_code' ";
    $stageSqlB="AND tbl_evaluation_cach.evltp_code='$evltp_code' ";
}else{
    $stageSqlA=NULL;
    $stageSqlB=NULL;
}

/////จำนวนการทำข้อสอบสำเร็จ
$total_chktResult =$sql_process->rowsQuery("SELECT
 tbl_evaluation_result.evltr_id FROM 
 tbl_evaluation_result,
 tbl_evaluation_topic 
 WHERE
tbl_evaluation_result.eltp_code=tbl_evaluation_topic.eltp_code AND
tbl_evaluation_topic.eltp_status_topic ='$eltp_status_topic' AND 
tbl_evaluation_result.cmn_code='$cmn_codex' AND
MONTH(tbl_evaluation_result.evltp_date) = '$current_month' AND
YEAR(tbl_evaluation_result.evltp_date) = '$current_year' $stageSql $stageSqlA");


///จำนวนรายละเอียดทำประเมิน
$total_chktCach =$sql_process->rowsQuery("SELECT
tbl_evaluation_cach.evalc_id 
FROM 
tbl_evaluation_cach,
tbl_evaluation_topic 
 WHERE   
tbl_evaluation_cach.eltp_code=tbl_evaluation_topic.eltp_code AND
tbl_evaluation_topic.cmn_code='$cmn_codex' AND 
tbl_evaluation_topic.eltp_status_topic = '$eltp_status_topic' AND
MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' $stageSql $stageSqlB");

$stmt5 = $sql_process->runQuery("SELECT
SUM(tbl_evaluation_result.evltr_avg) AS  evltr_avg
FROM 
tbl_evaluation_result,
tbl_evaluation_topic
 WHERE
tbl_evaluation_result.eltp_code=tbl_evaluation_topic.eltp_code AND
tbl_evaluation_topic.eltp_status_topic ='$eltp_status_topic' AND 
tbl_evaluation_result.cmn_code='$cmn_codex' AND
MONTH(tbl_evaluation_result.evltp_date) = '$current_month' AND
YEAR(tbl_evaluation_result.evltp_date) = '$current_year' $stageSql $stageSqlA");
$stmt5->execute();
$dataRow5=$stmt5->fetch(PDO::FETCH_ASSOC);
$chk_sum=$dataRow5['evltr_avg'];
// $chk_sum=$sql_process->QueryField2("tbl_evaluation_result","evltr_avg","SUM","cmn_code='$cmn_codex' AND MONTH(evltp_date) = '$current_month' AND YEAR(evltp_date) = '$current_year'");

?>


<div class="row">
          

            <div class="col-lg-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">
                  <!-- บุคลากร / เจ้าหน้าที่ -->
                  <?=$auth_user->mf("82BS90L39GV79H0CHXJ",$country_idx)?>
                </h4>

                        
            <form method="get" >
            <input type="hidden"  name="zone"  value="<?=$zone?>" >
            <input type="hidden"  name="eltp_status_topic"  value="<?=$eltp_status_topic?>" >
<table style="width:100%;">
<tbody>
<tr>

<td style="width:25%;">
<select name="evltp" id="evltp" class="form-control" required onchange="submit();">
<option value="" >--<?=$auth_user->mf("82BS90L39GV79H0CHXJ",$country_idx)?>--</option>
<?php 
$qa = $sql_process->runQuery(
"SELECT
tbl_user.user_code,
tbl_user.user_firstname,
tbl_user.user_lastname

FROM
tbl_user ,
tbl_user_detail
WHERE
tbl_user.user_code=tbl_user_detail.user_code AND
tbl_user.user_status='3' AND
tbl_user.is_delete='1' AND
tbl_user_detail.cmn_code=:cmn_code_param
ORDER BY
tbl_user.user_id DESC
");
$qa->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowData1= $qa->fetch(PDO::FETCH_OBJ)) {
echo"<option value='$rowData1->user_code'";
if ($evltp_code == $rowData1->user_code)
{
echo "SELECTED";
}
echo ">$rowData1->user_firstname $rowData1->user_lastname</option>\n";
}
?>

</select>
</td>

<td style="width:25%;">
<select name="eltp" id="eltp" class="form-control" required onchange="submit();">
<option value="" >--<?=$auth_user->mf("91HNOIAL3H20JVU6X3",$country_idx);?>--</option>
<?php 
$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_evaluation_topic.eltp_name,
tbl_evaluation_topic.eltp_code
FROM
tbl_evaluation_topic  ,
tbl_evaluation_result
WHERE
tbl_evaluation_topic.eltp_code = tbl_evaluation_result.eltp_code AND
tbl_evaluation_result.evltp_code ='$evltp_code' AND
tbl_evaluation_topic.eltp_status_topic='$eltp_status_topic' AND
MONTH(tbl_evaluation_result.evltp_date) = '$current_month' AND
YEAR(tbl_evaluation_result.evltp_date) = '$current_year' AND
tbl_evaluation_topic.eltp_status='1' AND
tbl_evaluation_topic.is_delete='1' AND
tbl_evaluation_topic.cmn_code=:cmn_code_param
GROUP BY
tbl_evaluation_result.eltp_code
ORDER BY
tbl_evaluation_topic.eltp_id DESC
");
$qg->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;
echo"<option value='$rowData->eltp_code'";
if ($eltp == $rowData->eltp_code)
{
echo "SELECTED";
}
echo ">$rowData->eltp_name</option>\n";
}
?>

</select>
</td>

<td style="width:25%;">
<select name="current_month" id="current_month" class="form-control" required onchange="submit();">
<?php
$month = array("$m1","$m2","$m3","$m4","$m5","$m6","$m7","$m8","$m9","$m10","$m11","$m12");?>
<?php for($i=0; $i<sizeof($month); $i++) {
$i2=$i+1;
// echo '<option value="'.$i2.'">'.$month[$i].'</option>';

echo"<option value='$i2'";
if ($current_month == $i2)
{
echo "SELECTED";
}
echo ">$month[$i]</option>\n";
}
?>
</select>
</td>
<td style="width:25%;">
<select name="current_year" id="current_year" class="form-control" required onchange="submit();">
<!-- <option value="" >--เลือกปี--</option> -->
<?php
for($i=2019;$i<=2050;$i++){
$i2=sprintf("%02d",$i); // ฟอร์แมตรูปแบบให้เป็น 00
$yt=$i2+543; //ปีไทย
// echo '<option value="'.$i2.'">'.$yt.'</option>';
echo"<option value='$i2'";
if ($current_year == $i2)
{
echo "SELECTED";
}
echo ">$i2</option>\n";

}
?>
</select>
</td>
</tr>
</tbody>
</table>
<br>
</form>


                <div class="col-12"> 
    <center>
    <button type="button" class="btn btn-info btn-block"
    <?php if($eltp ==NULL || $evltp_code==NULL){ echo "disabled";}?> class="login100-form-btn" onclick="window.location.href='?zone=ReportChk&eltp=<?=$eltp?>&evltp=<?=$evltp_code?>&eltp_status_topic=<?=$eltp_status_topic?>'">
        <!-- ดูรายละเอียด  -->
        <?=$auth_user->mf("ZGURMBI4JPVS1ZE25DRM",$country_idx)?>
    </button>
    <hr>
    <h3>
      <!-- ประเมินทั้งหมด -->
      <?=$auth_user->mf("VKBZXA7RI3TBF9IXRJ63",$country_idx)?> <?=$total_chktResult?> 
      <?=$auth_user->mf("B06F85JUZPKUHOYQ3C",$country_idx)?>
</h3>

    </center>                                 

</div>
               

              </div>
            </div>
          </div>




</div>
