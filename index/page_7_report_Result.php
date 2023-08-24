<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
$current_month = isset($_GET['current_month']) ? $_GET['current_month'] : date("m"); 
$current_year  = isset($_GET['current_year']) ? $_GET['current_year'] :  date("Y");
$evltp_code = isset($_GET['evltp']) ? $_GET['evltp'] :NULL; 
$stmt = $sql_process->runQuery("SELECT ctgm_code,ctgm_name FROM tbl_category_main WHERE ctgm_code=:evltp_code_param");
$stmt->execute(array(":evltp_code_param"=>$evltp_code));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);

//จำนวนประเมินให้พนักงาน
$query_1A = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM 
tbl_user_detail,
tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_user_detail.user_code=tbl_evaluation_cach.evltp_code AND 
tbl_user_detail.ctgm_code ='$evltp_code' AND
MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND
tbl_user_detail.cmn_code=:cmn_code_param
GROUP BY
tbl_user_detail.ctgm_code
");
$query_1A->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow1A=$query_1A->fetch(PDO::FETCH_ASSOC);
$result_user_a=$dataRow1A['evalc_value_total'];
//จำนวนประเมินให้หมวดหลัก
$query_1B = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM tbl_category_main,tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_category_main.ctgm_code=tbl_evaluation_cach.evltp_code AND
tbl_category_main.ctgm_code ='$evltp_code' AND 
MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND 
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND
tbl_category_main.cmn_code=:cmn_code_param
GROUP BY
tbl_category_main.ctgm_code
");
$query_1B->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow1B=$query_1B->fetch(PDO::FETCH_ASSOC);
$result_ctgm_a=$dataRow1B['evalc_value_total'];
        
//จำนวนประเมินให้หมวดย่อย
$query_1C = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM tbl_category_sub,tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_category_sub.ctgs_code=tbl_evaluation_cach.evltp_code AND 
tbl_category_sub.ctgm_code ='$evltp_code' AND 
MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year'AND
tbl_category_sub.cmn_code=:cmn_code_param
GROUP BY
tbl_category_sub.ctgm_code
");
$query_1C->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow1C=$query_1C->fetch(PDO::FETCH_ASSOC);
$result_ctgs_a=$dataRow1C['evalc_value_total'];
// ผมรวม
$result_total_a=$result_user_a+$result_ctgm_a+$result_ctgs_a;
// $result_avg_a=($dataRow1A['evalc_value_avg']+$dataRow1B['evalc_value_avg']+$dataRow1C['evalc_value_avg']);

// 1 = ไม่ว่าง,0=ว่าง
// 1 0 0
if($dataRow1A['evalc_value_avg'] !=NULL && $dataRow1B['evalc_value_avg']==NULL && $dataRow1C['evalc_value_avg'] ==NULL){
  $result_avg_a=($dataRow1A['evalc_value_avg'])/1;
  // 0 1 0
  }elseif($dataRow1A['evalc_value_avg'] ==NULL && $dataRow1B['evalc_value_avg']!=NULL && $dataRow1C['evalc_value_avg'] ==NULL){
    $result_avg_a=($dataRow1B['evalc_value_avg'])/1;
  
  // 0 0 1
  }elseif($dataRow1A['evalc_value_avg'] ==NULL && $dataRow1B['evalc_value_avg']==NULL && $dataRow1C['evalc_value_avg'] !=NULL){
    $result_avg_a=($dataRow1C['evalc_value_avg'])/1;
  
  // 1 1 0
  }elseif($dataRow1A['evalc_value_avg'] !=NULL && $dataRow1B['evalc_value_avg']!=NULL && $dataRow1C['evalc_value_avg'] ==NULL){
    $result_avg_a=($dataRow1A['evalc_value_avg']+$dataRow1B['evalc_value_avg'])/2;
  
  // 0 1 1
  }elseif($dataRow1A['evalc_value_avg'] ==NULL && $dataRow1B['evalc_value_avg']!=NULL && $dataRow1C['evalc_value_avg'] !=NULL){
    $result_avg_a=($dataRow1B['evalc_value_avg']+$dataRow1C['evalc_value_avg'])/2;
  // 1 1 1
  }elseif($dataRow1A['evalc_value_avg'] !=NULL && $dataRow1B['evalc_value_avg']!=NULL && $dataRow1C['evalc_value_avg'] !=NULL){
    $result_avg_a=($dataRow1A['evalc_value_avg']+$dataRow1B['evalc_value_avg']+$dataRow1C['evalc_value_avg'])/3;
  // 1 0 1
  }elseif($dataRow1A['evalc_value_avg'] !=NULL && $dataRow1B['evalc_value_avg']==NULL && $dataRow1C['evalc_value_avg'] !=NULL){
    $result_avg_a=($dataRow1A['evalc_value_avg']+$dataRow1C['evalc_value_avg'])/2;
  
  // 0 0 0
  }else{
    $result_avg_a=0;
  }


  ///wording
// ภาพรวมแบบกราฟ
$tx1=$auth_user->mf("Y1SN1MPL4SZ77SV7GW0",$country_idx);
// รายละเอียดเชิงลึก
$tx2=$auth_user->mf("8971RSN3VC4CBQGTX0Q0",$country_idx);
// คะแนนความพึงพอใจ
$tx3=$auth_user->mf("UE22RDKB7OW9501B09OA",$country_idx);
// ระดับความพึงพอใจประจำปี
$tx4=$auth_user->mf("Z2F6BIJA4PLXQKCC4N",$country_idx);
// หัวข้อ
$tx5=$auth_user->mf("C337ZWNQ9GSC62UE5OT",$country_idx);
// ประสิทธิภาพโดยรวม
$tx6=$auth_user->mf("R2VWXC3V4QES5BPGMVQZ",$country_idx);
// ดูความคิดเห็น
$tx7=$auth_user->mf("WVMXC48AJK9WPPCRDMF",$country_idx);
// ดูรายการ
$tx8=$auth_user->mf("J6KU1WV9GPNLTRG4VYO",$country_idx);
// น้อยที่สุด
$lv1=$auth_user->mf("UEPGRXM9EBAPO9M44HGX",$country_idx);
// น้อย
$lv2=$auth_user->mf("2EEEX16HYXN7RIEWCJGB",$country_idx);
// ปานกลาง
$lv3=$auth_user->mf("3692QW5U4FOLJZ1UFQ6",$country_idx);
// มาก
$lv4=$auth_user->mf("XS3EDYVT6DEV0EQFYNWT",$country_idx);
// มากที่สุด
$lv5=$auth_user->mf("AXI81XOH5YH8MEPWO43",$country_idx);

?> 
<!-- highcharts -->
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!-- //////// -->
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<!--END highcharts -->

<div align="right"><font color="green">  <?=$auth_user->mf("I71M6P36PIROSK1U2KA",$country_idx);?></font> , <font color="red">  <?=$auth_user->mf("99G5U8WHDQZXS3BZ0Y",$country_idx);?></font> , <font color="blue"> <?=$auth_user->mf("0SAV04WWPN1FY6GVQJK4",$country_idx);?></font></div>
<div class="row">
          

            <div class="col-lg-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <!-- card-title -->
                <div align="right">
               
                  <!-- || -->
                  <!-- <button class="btn btn-success" type="button" onclick="printDiv('printableArea')">พิมพ์</button>   -->
                  </div>
                <h4 class="">
                  <!-- ประสิทธิภาพโดยรวมทั้ง -->
                  <?=$auth_user->mf("G7DW6C3P4LFGQQ6PVH",$country_idx);?>
                <?=$ctgm_name_main_x?> : <?=$dataRow["ctgm_name"];?></h4>

                        
            <form method="get" >
            <input type="hidden"  name="zone"  value="<?=$zone?>" >
            <input type="hidden"  name="evltp"  value="<?=$evltp_code?>" >
<table style="width:100%;">
<tbody>
<tr>


<td style="width:50%;">
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
<td style="width:50%;">
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


<div class="row">

<div class="col-12"> 
  <div align="right">
<button class="btn btn-outline-danger" type="button" onclick="openCity('Graph');openCity1('AvgAllyear')"><?=$tx1?></button>
<button class="btn btn-outline-success" type="button"  onclick="window.location.href='?zone=ReportDetail&eltp_status_topic=2'" ><?=$tx2?></button>
<button class="btn btn-outline-info" type="button" onclick="window.location.href='?zone=Report'">
<!-- กลับไปยังก่อนหน้านี้ -->
<?=$auth_user->mf("M9ASK4SSI2IEYYQC8FR",$country_idx);?>
</button>  
</div>
</div>

<?php for($i=1; $i<=5; $i++) { 
//จำนวนประเมินให้พนักงาน
$result_user_b =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_user_detail,tbl_evaluation_cach WHERE tbl_user_detail.ctgm_code ='$evltp_code'
AND tbl_user_detail.user_code=tbl_evaluation_cach.evltp_code AND tbl_user_detail.cmn_code='$cmn_codex' AND tbl_evaluation_cach.evalc_value ='$i' AND MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND tbl_evaluation_cach.evalc_status='1'   ");
//จำนวนประเมินให้หมวดหมู่ใหญ่
$result_ctgm_b =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_category_main,tbl_evaluation_cach WHERE tbl_category_main.ctgm_code ='$evltp_code'
AND tbl_category_main.ctgm_code=tbl_evaluation_cach.evltp_code AND tbl_category_main.cmn_code='$cmn_codex' AND tbl_evaluation_cach.evalc_value ='$i' AND MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND tbl_evaluation_cach.evalc_status='1'");           
//จำนวนประเมินให้หมวดย่อย
$result_ctgs_b =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_category_sub,tbl_evaluation_cach WHERE tbl_category_sub.ctgm_code ='$evltp_code'
AND tbl_category_sub.ctgs_code=tbl_evaluation_cach.evltp_code AND tbl_category_sub.cmn_code='$cmn_codex' AND tbl_evaluation_cach.evalc_value ='$i' AND MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND tbl_evaluation_cach.evalc_status='1'"); 
// ผมรวม
$result_total_b=$result_user_b+$result_ctgm_b+$result_ctgs_b;
//  echo "|$result_user_b|$result_ctgm_b|$result_ctgs_b";

                 if($result_total_b >0 && $result_total_a >0){
                  $avgA=($result_total_b/$result_total_a)*100;
                }else{
                  $avgA=0;
                }
                 ?>
                  <div class="col-lg-2 grid-margin stretch-card">
              <div class="">
                <div class="card-body">
                 <center>
                <img src="<?=base64_encode_image("../images/emoji/$i.png")?>" class="circle" ><br>
                <h4>  <font color="green">  <?=$i?> </font> <br>
               
                <font color="red">  <?=$result_total_b?> </font> <br>
                <font color="blue"> <?=number_format($avgA,2)?> % </font>
                </h4>
                </center>

              </div>
              </div>
            </div>
             
                <?php } ?>

       

                <div class="col-12"> 
                <hr>
                <center>
               <?php
             echo "<font   size='5'>";
             echo  number_format($result_avg_a,2); 
             echo "</font>";
             //  echo " ดังนั้น คะแนนความพึงพอใจเท่ากับ ";
             echo "&nbsp;";
             echo $tx3." : ";
              // เกณการประเมิน
if($result_avg_a <= 1){
  echo "<font color='red' size='5'>";
  // echo "น้อยที่สุด";
  echo $lv1;
  echo "</font>";
}elseif($result_avg_a <= 2){
  echo "<font color='red' size='5'>";
  // echo "น้อย";
  echo $lv2;
  echo "</font>";
}elseif($result_avg_a <= 3){
  echo "<font color='blue' size='5'>";
  // echo "ปานกลาง";
  echo $lv3;
  echo "</font>";
}elseif($result_avg_a <= 4){
  echo "<font color='green' size='5'>";
  // echo "มาก";
  echo $lv4;
  echo "</font>";
}elseif($result_avg_a <= 5){
  echo "<font color='green' size='5'>";
  // echo "มากที่สุด";
  echo $lv5;
  echo "</font>";
} 

               ?> 
               </center>
               </div>
 
     <!-- กราฟ -->
<div id="Graph" style="display:none"> 
  <!-- col-6 -->
<div class="row">
<div class=""  >
<hr>
<div id="container" style="min-width: 500px; height: 400px; max-width: 1000px; margin: 0 auto"></div>
  <!-- ปุ่มเลือกกราฟ -->
  <!-- <button id="plain" class="btn btn-primary btn-rounded btn-fw">กราฟแท่ง</button>
<button id="inverted" class="btn btn-success btn-rounded btn-fw">กราฟแท่งแนวนอน</button>
<button id="polar" class="btn btn-danger btn-rounded btn-fw">แผนภูมิขั้วโลก</button> -->
</div>

<div class=""  >
<hr>
<div id="container1" style="min-width: 500px; height: 400px; max-width: 1000px; margin: 0 auto"></div>
</div>

<div class=""  >
<hr>
<div id="container2" style="min-width: 500px; height: 400px; max-width: 1000px; margin: 0 auto"></div>
</div>

<div class=""  >
<hr>
<div id="container3" style="min-width: 500px; height: 400px; max-width: 1000px; margin: 0 auto"></div>
</div>


  </div>
</div> 
<!--End กราฟ -->
<!-- แสดงคะแนนเฉลี่ยรายปี -->
<div id="AvgAllyear"  class="col-12"  style="display:none" >

<!--End ปุ่มเลือกกราฟ -->

<?php

//จำนวนประเมินให้พนักงาน
$query_2A = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM 
tbl_user_detail,
tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_user_detail.user_code=tbl_evaluation_cach.evltp_code AND 
tbl_user_detail.ctgm_code ='$evltp_code' AND
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND
tbl_user_detail.cmn_code=:cmn_code_param
GROUP BY
tbl_user_detail.ctgm_code
");
$query_2A->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow2A=$query_2A->fetch(PDO::FETCH_ASSOC);
$result_user_a=$dataRow2A['evalc_value_total'];
//จำนวนประเมินให้หมวดหลัก
$query_2B = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM tbl_category_main,tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_category_main.ctgm_code=tbl_evaluation_cach.evltp_code AND
tbl_category_main.ctgm_code ='$evltp_code' AND 
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND
tbl_category_main.cmn_code=:cmn_code_param
GROUP BY
tbl_category_main.ctgm_code
");
$query_2B->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow2B=$query_2B->fetch(PDO::FETCH_ASSOC);
$result_ctgm_a=$dataRow2B['evalc_value_total'];
        
//จำนวนประเมินให้หมวดย่อย
$query_2C = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM tbl_category_sub,tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_category_sub.ctgs_code=tbl_evaluation_cach.evltp_code AND 
tbl_category_sub.ctgm_code ='$evltp_code' AND 
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year'AND
tbl_category_sub.cmn_code=:cmn_code_param
GROUP BY
tbl_category_sub.ctgm_code
");
$query_2C->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow2C=$query_2C->fetch(PDO::FETCH_ASSOC);
$result_ctgs_a=$dataRow2C['evalc_value_total'];
// ผมรวม
$result_total_a=$result_user_a+$result_ctgm_a+$result_ctgs_a;
// $result_avg_a=($dataRow2A['evalc_value_avg']+$dataRow2B['evalc_value_avg']+$dataRow2C['evalc_value_avg']);

// 1 = ไม่ว่าง,0=ว่าง
// 1 0 0
if($dataRow2A['evalc_value_avg'] !=NULL && $dataRow2B['evalc_value_avg']==NULL && $dataRow2C['evalc_value_avg'] ==NULL){
  $result_avg_c=($dataRow2A['evalc_value_avg'])/1;
  // 0 1 0
  }elseif($dataRow2A['evalc_value_avg'] ==NULL && $dataRow2B['evalc_value_avg']!=NULL && $dataRow2C['evalc_value_avg'] ==NULL){
    $result_avg_c=($dataRow2B['evalc_value_avg'])/1;
  
  // 0 0 1
  }elseif($dataRow2A['evalc_value_avg'] ==NULL && $dataRow2B['evalc_value_avg']==NULL && $dataRow2C['evalc_value_avg'] !=NULL){
    $result_avg_c=($dataRow2C['evalc_value_avg'])/1;
  
  // 1 1 0
  }elseif($dataRow2A['evalc_value_avg'] !=NULL && $dataRow2B['evalc_value_avg']!=NULL && $dataRow2C['evalc_value_avg'] ==NULL){
    $result_avg_c=($dataRow2A['evalc_value_avg']+$dataRow2B['evalc_value_avg'])/2;
  
  // 0 1 1
  }elseif($dataRow2A['evalc_value_avg'] ==NULL && $dataRow2B['evalc_value_avg']!=NULL && $dataRow2C['evalc_value_avg'] !=NULL){
    $result_avg_c=($dataRow2B['evalc_value_avg']+$dataRow2C['evalc_value_avg'])/2;
  // 1 1 1
  }elseif($dataRow2A['evalc_value_avg'] !=NULL && $dataRow2B['evalc_value_avg']!=NULL && $dataRow2C['evalc_value_avg'] !=NULL){
    $result_avg_c=($dataRow2A['evalc_value_avg']+$dataRow2B['evalc_value_avg']+$dataRow2C['evalc_value_avg'])/3;
  // 1 0 1
  }elseif($dataRow2A['evalc_value_avg'] !=NULL && $dataRow2B['evalc_value_avg']==NULL && $dataRow2C['evalc_value_avg'] !=NULL){
    $result_avg_c=($dataRow2A['evalc_value_avg']+$dataRow2C['evalc_value_avg'])/2;
  
  // 0 0 0
  }else{
    $result_avg_c=0;
  }


$yTh=$current_year+543;
$monthAvg=number_format($result_avg_c,2); 
echo "<center>";
// echo "ระดับความพึงพอใจประจำปี ".$yTh." คือ ";
echo "$tx4 ".$current_year." = ";
echo "<font   size='5'>";
echo  number_format($monthAvg,2); 
echo "</font>";
// echo " ดังนั้น คะแนนความพึงพอใจเท่ากับ ";
echo " $tx3 : ";
 // เกณการประเมิน
 if($monthAvg <= 1){
  echo "<font color='red' size='5'>";
  // echo "น้อยที่สุด";
  echo $lv1;
  echo "</font>";
  }elseif($monthAvg <= 2){
  echo "<font color='red' size='5'>";
  // echo "น้อย";
  echo $lv2;
  echo "</font>";
  }elseif($monthAvg <= 3){
  echo "<font color='blue' size='5'>";
  // echo "ปานกลาง";
  echo $lv3;
  echo "</font>";
  }elseif($monthAvg<= 4){
  echo "<font color='green' size='5'>";
  // echo "มาก";
  echo $lv4;
  echo "</font>";
  }elseif($monthAvg <= 5){
  echo "<font color='green' size='5'>";
  // echo "มากที่สุด";
  echo $lv5;
  echo "</font>";
  }
echo "</center>";
?>
</div>
<!--End แสดงคะแนนเฉลี่ยรายปี -->             

         


</div>

               
              </div>
            </div>
          </div>

          <div class="col-lg-12 grid-margin stretch-card">
          <label>
    <!-- แบบประเมินทั่วไป -->
    <?=$auth_user->mf("FTXBS8WL3L3QIJSSTH",$country_idx)?>
  </label>
</div>     
          <?php
$qh = $sql_process->runQuery(
"SELECT
tbl_evaluation_topic.eltp_name,
tbl_evaluation_topic.eltp_code,
Avg(tbl_evaluation_cach.evalc_value) AS evalc_value_avg,
Count(tbl_evaluation_cach.evalc_value) AS evalc_value_total
FROM
tbl_evaluation_topic,
tbl_evaluation_cach
WHERE 
tbl_evaluation_cach.evalc_status='1' AND 
tbl_evaluation_cach.evltp_code='$evltp_code' AND
tbl_evaluation_topic.eltp_code = tbl_evaluation_cach.eltp_code AND
tbl_evaluation_topic.eltp_status_topic = '2' AND
tbl_evaluation_topic.is_delete = '1' AND
tbl_evaluation_topic.eltp_status = '1' AND
MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year'AND
tbl_evaluation_topic.cmn_code=:cmn_code_param 
GROUP BY
tbl_evaluation_topic.eltp_code
ORDER BY
tbl_evaluation_topic.eltp_id DESC
");
$qh->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowDataH= $qh->fetch(PDO::FETCH_OBJ)) {
?>
          <div class="col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?=$tx5?> : <?=$rowDataH->eltp_name?></h4>
                  <div class="row">

                  <?php for($a=1; $a<=5; $a++) { 
//จำนวนประเมินทั่วไปที่ถูกประเมิน
$result_eva_total_a =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM 
tbl_evaluation_topic,
tbl_evaluation_cach 
WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_evaluation_topic.eltp_code ='$rowDataH->eltp_code' AND 
tbl_evaluation_topic.eltp_code = tbl_evaluation_cach.eltp_code AND 
tbl_evaluation_topic.cmn_code='$cmn_codex' AND 
tbl_evaluation_cach.evalc_value ='$a' AND 
MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND 
tbl_evaluation_topic.is_delete = '1' AND
tbl_evaluation_cach.evltp_code='$evltp_code' AND
tbl_evaluation_topic.eltp_status_topic='2'");



                 if($result_eva_total_a >0 && $rowDataH->evalc_value_total >0){
                  $avgC=($result_eva_total_a/$rowDataH->evalc_value_total)*100;
                }else{
                  $avgC=0;
                }
                 ?>
                  <div class="col-lg-2 grid-margin stretch-card">
              <div class="">
                <div class="card-body">
                 <center>
                <img src="<?=base64_encode_image("../images/emoji/$a.png")?>" class="circle" style="height:50px; width:50px;"><br>
                <h5> 
                <font color="green">    <?=$a?> </font> <br>
                <font color="red">  <?=$result_eva_total_a?>  </font><br>
                <font color="blue">  <?=number_format($avgC,1)?> %  </font>
                </h5>
                </center>

              </div>
              </div>
            </div>
             
                <?php } ?>
                  </div>
                  <hr>
                <center> 
               <?php
               echo "<font   size='4'>";
             echo  number_format($rowDataH->evalc_value_avg,2); 
             echo "</font>";
            //  echo " ดังนั้น คะแนนความพึงพอใจเท่ากับ ";
             echo "&nbsp;";
             echo $tx3." : ";
              // เกณการประเมิน
              if($rowDataH->evalc_value_avg <= 1){
                echo "<font color='red' size='4'>";
                // echo "น้อยที่สุด";
                echo $lv1;
                echo "</font>";
              }elseif($rowDataH->evalc_value_avg <= 2){
                echo "<font color='red' size='4'>";
                // echo "น้อย";
                echo $lv2;
                echo "</font>";
              }elseif($rowDataH->evalc_value_avg <= 3){
                echo "<font color='blue' size='4'>";
                // echo "ปานกลาง";
                echo $lv3;
                echo "</font>";
              }elseif($rowDataH->evalc_value_avg <= 4){
                echo "<font color='green' size='4'>";
                //  echo "มาก";
                echo $lv4;
                echo "</font>";
              }elseif($rowDataH->evalc_value_avg <= 5){
                echo "<font color='green' size='4'>";
                // echo "มากที่สุด";
                echo $lv5;
                echo "</font>";
              } 
               ?> 
               </center>

               <div align="right">
             <button type="button" class="btn btn-outline-warning"   onclick="window.open('?zone=Comment&evltp=<?=$evltp_code?>&current_month=<?=$current_month?>&current_year=<?=$current_year?>', '_blank')">
                 <!-- ดูความคิดเห็น -->
                 <?=$tx7?>
            </button>
             </div>

                </div>
              </div>
            </div>
<?php } ?>      


<div class="col-lg-12 grid-margin stretch-card">
  <label><?=$tx6?> :  <?=$ctgs_name_main_x?></label>
</div>     
          <?php
$qh = $sql_process->runQuery(
"SELECT
tbl_category_sub.ctgs_code,
tbl_category_sub.ctgs_name
FROM
tbl_category_sub
WHERE
tbl_category_sub.is_delete = '1' AND
tbl_category_sub.ctgs_status = '1' AND
tbl_category_sub.ctgm_code=:ctgm_code_param AND
tbl_category_sub.cmn_code=:cmn_code_param 
GROUP BY
tbl_category_sub.ctgs_code
ORDER BY
tbl_category_sub.ctgs_name ASC
");
$qh->execute(array(":cmn_code_param"=>$cmn_codex,":ctgm_code_param"=>$evltp_code));
while($rowDataH= $qh->fetch(PDO::FETCH_OBJ)) {

//จำนวนประเมินให้พนักงาน
$query_3A = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM 
tbl_user_detail,
tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_user_detail.user_code=tbl_evaluation_cach.evltp_code AND 
tbl_user_detail.ctgs_code ='$rowDataH->ctgs_code' AND
MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND
tbl_user_detail.cmn_code=:cmn_code_param
GROUP BY
tbl_user_detail.ctgm_code
");
$query_3A->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow3A=$query_3A->fetch(PDO::FETCH_ASSOC);
$result_user_3a=$dataRow3A['evalc_value_total'];

//จำนวนประเมินให้หมวดย่อย
$query_3C = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM tbl_category_sub,tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_category_sub.ctgs_code=tbl_evaluation_cach.evltp_code AND 
tbl_category_sub.ctgs_code ='$rowDataH->ctgs_code' AND 
MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year'AND
tbl_category_sub.cmn_code=:cmn_code_param
GROUP BY
tbl_category_sub.ctgm_code
");
$query_3C->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow3C=$query_3C->fetch(PDO::FETCH_ASSOC);
$result_ctgs_3a=$dataRow3C['evalc_value_total'];
// ผมรวม
$result_total_3a=$result_user_3a+$result_ctgs_3a;
// 1 = ไม่ว่าง,0=ว่าง
// 1 0
if($dataRow3A['evalc_value_avg'] != NULL && $dataRow3C['evalc_value_avg'] ==NULL){
  $result_avg_3a=($dataRow3A['evalc_value_avg'])/1;

// 0 1
}elseif($dataRow3A['evalc_value_avg'] == NULL && $dataRow3C['evalc_value_avg'] !=NULL){
  $result_avg_3a=($dataRow3C['evalc_value_avg'])/1;

// 1 1
}elseif($dataRow3A['evalc_value_avg'] != NULL && $dataRow3C['evalc_value_avg'] !=NULL){
  $result_avg_3a=($dataRow3A['evalc_value_avg']+$dataRow3C['evalc_value_avg'])/2;

  // 0 0 
}else{
  $result_avg_3a=0;
}

?>
          <div class="col-lg-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?=$ctgs_name_main_x?> : <?=$rowDataH->ctgs_name?></h4>
                  <div class="row">

                  <?php for($a=1; $a<=5; $a++) { 
//จำนวนประเมินให้พนักงาน
$result_user_3b =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_user_detail,tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_user_detail.ctgs_code ='$rowDataH->ctgs_code'
AND tbl_user_detail.user_code=tbl_evaluation_cach.evltp_code AND 
tbl_user_detail.cmn_code='$cmn_codex' AND 
tbl_evaluation_cach.evalc_value ='$a' AND 
MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND 
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' ");

//จำนวนประเมินให้หมวดย่อย
$result_ctgs_3b =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_category_sub,tbl_evaluation_cach WHERE 
tbl_category_sub.ctgs_code ='$rowDataH->ctgs_code' AND  tbl_evaluation_cach.evalc_status='1' AND 
tbl_category_sub.ctgs_code=tbl_evaluation_cach.evltp_code AND tbl_category_sub.cmn_code='$cmn_codex' AND tbl_evaluation_cach.evalc_value ='$a' AND MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' "); 
// ผมรวม
$result_total_3b=$result_user_3b+$result_ctgs_3b;


                 if($result_total_3b >0 && $result_total_3a >0){
                  $avgC=($result_total_3b/$result_total_3a)*100;
                }else{
                  $avgC=0;
                }
                 ?>
                  <div class="col-lg-2 grid-margin stretch-card">
              <div class="">
                <div class="card-body">
                 <center>
                <img src="<?=base64_encode_image("../images/emoji/$a.png")?>" class="circle" style="height:50px; width:50px;"><br>
                <h5> 
                <font color="green">    <?=$a?></font><br>
                <font color="red">   <?=$result_total_3b?> </font> <br>
                <font color="blue">     <?=number_format($avgC,1)?> % </font>
                </h5>
                </center>

              </div>
              </div>
            </div>
             
                <?php } ?>
                  </div>
                  <hr>
                <center> 
               <?php
               echo "<font   size='4'>";
             echo  number_format($result_avg_3a,2); 
             echo "</font>";
            //  echo " ดังนั้น คะแนนความพึงพอใจเท่ากับ ";
            echo "&nbsp;";
            echo $tx3." : ";
              // เกณการประเมิน
if($result_avg_3a <= 1){
  echo "<font color='red' size='4'>";
  // echo "น้อยที่สุด";
  echo $lv1;
  echo "</font>";
}elseif($result_avg_3a <= 2){
  echo "<font color='red' size='4'>";
  // echo "น้อย";
  echo $lv2;
  echo "</font>";
}elseif($result_avg_3a <= 3){
  echo "<font color='blue' size='4'>";
  // echo "ปานกลาง";
  echo $lv3;
  echo "</font>";
}elseif($result_avg_3a<= 4){
  echo "<font color='green' size='4'>";
  // echo "มาก";
  echo $lv4;
  echo "</font>";
}elseif($result_avg_3a <= 5){
  echo "<font color='green' size='4'>";
  // echo "มากที่สุด";
  echo $lv5;
  echo "</font>";
} 
               ?> 
               </center>
               <div align="right">
             
             <button type="button" class="btn btn-outline-warning"   onclick="window.open('?zone=Comment&evltp=<?=$rowDataH->ctgs_code?>&current_month=<?=$current_month?>&current_year=<?=$current_year?>', '_blank')">
             <!-- ดูความคิดเห็น -->
             <?=$tx7?>
            </button>
             </div>

                </div>
              </div>
            </div>
<?php } ?>

<div class="col-lg-12 grid-margin stretch-card">
  <label><?=$tx6?> 
  <!-- บุคลากร / เจ้าหน้าที่ -->
<?=$auth_user->mf("82BS90L39GV79H0CHXJ",$country_idx)?>
</label>
</div>
            
          <?php


if($q != NULL ){
  $stateSQL="AND tbl_user.user_firstname LIKE '%$q%'";
}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT tbl_user.user_code FROM tbl_user,tbl_user_detail WHERE tbl_user.user_code = tbl_user_detail.user_code AND
 tbl_user.is_delete ='1'AND tbl_user_detail.cmn_code='$cmn_codex'
 $stateSQL");
$rows='25';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);

$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_user.user_prefix,
tbl_user.user_firstname,
tbl_user.user_lastname,
tbl_user.user_code,
tbl_category_sub.ctgs_code,
tbl_category_sub.ctgs_name,
Avg(tbl_evaluation_cach.evalc_value) AS evalc_value_avg,
Count(tbl_evaluation_cach.evalc_value) AS evalc_value_total
FROM
tbl_user ,
tbl_user_detail ,
tbl_category_sub ,
tbl_evaluation_cach
WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_user.user_code = tbl_user_detail.user_code AND
tbl_user_detail.ctgs_code = tbl_category_sub.ctgs_code AND
tbl_user.is_delete = '1' AND
tbl_user_detail.ctgm_code=:ctgm_code_param AND
tbl_user_detail.cmn_code=:cmn_code_param AND
tbl_user.user_code = tbl_evaluation_cach.evltp_code AND
MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND 
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' 
GROUP BY
tbl_evaluation_cach.evltp_code
ORDER BY
tbl_user.user_firstname ASC
limit $start,$rows
");
$qg->execute(array(":cmn_code_param"=>$cmn_codex,":ctgm_code_param"=>$evltp_code));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;


?>
          <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"><?=$rowData->user_prefix?><?=$rowData->user_firstname?> <?=$rowData->user_lastname?> | <?=$ctgs_name_main_x?> : <?=$rowData->ctgs_name?></h4>
                  
                  <div class="row">
                  <?php for($i=1; $i<=5; $i++) { 
//จำนวนประเมินให้พนักงาน
$result_user_c =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_user_detail,tbl_evaluation_cach WHERE tbl_user_detail.ctgm_code ='$evltp_code'
AND tbl_user_detail.user_code=tbl_evaluation_cach.evltp_code AND tbl_user_detail.cmn_code='$cmn_codex' AND tbl_evaluation_cach.evalc_value ='$i' AND MONTH(tbl_evaluation_cach.evalc_date) = '$current_month'
AND YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND tbl_user_detail.user_code='$rowData->user_code'");


                 if($result_user_c >0 && $rowData->evalc_value_total >0){
                  $avgB=($result_user_c/$rowData->evalc_value_total)*100;
                }else{
                  $avgB=0;
                }
                 ?> 
                  <div class="col-lg-2 grid-margin stretch-card">
              <div class="">
                <div class="card-body">
                 <center>
                <img src="<?=base64_encode_image("../images/emoji/$i.png")?>" class="circle" style="height:60px; width:60px;"><br>
                <h5>    <font color="green">   <?=$i?> </font><br>
               
                <font color="red">   <?=$result_user_c?> </font><br>
                <font color="blue">  <?=number_format($avgB,2)?>% </font>
                </h5>
                </center>

              </div>
              </div>
            </div>
             
                <?php } ?>

                </div>
                <hr>
                <center>
               <?php
               echo "<font   size='5'>";
             echo  number_format($rowData->evalc_value_avg,2); 
             echo "</font>";
             //  echo " ดังนั้น คะแนนความพึงพอใจเท่ากับ ";
             echo "&nbsp;";
             echo $tx3." : ";
              // เกณการประเมิน
if($rowData->evalc_value_avg <= 1){
  echo "<font color='red' size='5'>";
  // echo "น้อยที่สุด";
  echo $lv1;
  echo "</font>";
}elseif($rowData->evalc_value_avg <= 2){
  echo "<font color='red' size='5'>";
  // echo "น้อย";
  echo $lv2;
  echo "</font>";
}elseif($rowData->evalc_value_avg <= 3){
  echo "<font color='blue' size='5'>";
  // echo "ปานกลาง";
  echo $lv3;
  echo "</font>";
}elseif($rowData->evalc_value_avg <= 4){
  echo "<font color='green' size='5'>";
  // echo "มาก";
  echo $lv4;
  echo "</font>";
}elseif($rowData->evalc_value_avg <= 5){
  echo "<font color='green' size='5'>";
  // echo "มากที่สุด";
  echo $lv5;
  echo "</font>";
} 
               ?> 
               </center>
               <div align="right">
             
               <button type="button" class="btn btn-outline-warning"   onclick="window.open('?zone=Comment&evltp=<?=$rowData->user_code?>&current_month=<?=$current_month?>&current_year=<?=$current_year?>', '_blank')">
               <!-- ดูความคิดเห็น -->
               <?=$tx7?>
              </button>
               </div>
                </div>
              </div>
            </div>
<?php } ?>

</div>
<?php if($total_data >=$rows) { require("pagingReport.php"); }?>

<script>
//Tab
function openCity(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";  
}

function openCity1(cityName) {
  var i;
  var x = document.getElementsByClassName("city");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  document.getElementById(cityName).style.display = "block";  
}

<?php 

///จำนวนการประเมินในแต่ละเดือน

for($i1=1; $i1<=12; $i1++) {

  //จำนวนประเมินให้พนักงาน
$query_1h = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM 
tbl_user_detail,
tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_user_detail.user_code=tbl_evaluation_cach.evltp_code AND 
tbl_user_detail.ctgm_code ='$evltp_code' AND
MONTH(tbl_evaluation_cach.evalc_date) = '$i1' AND
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND
tbl_user_detail.cmn_code=:cmn_code_param
GROUP BY
tbl_user_detail.ctgm_code
");
$query_1h->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow1h=$query_1h->fetch(PDO::FETCH_ASSOC);
$result_user_h=$dataRow1h['evalc_value_total'];
//จำนวนประเมินให้หมวดหลัก
$query_2h = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM tbl_category_main,tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_category_main.ctgm_code=tbl_evaluation_cach.evltp_code AND
tbl_category_main.ctgm_code ='$evltp_code' AND 
MONTH(tbl_evaluation_cach.evalc_date) = '$i1' AND 
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND
tbl_category_main.cmn_code=:cmn_code_param
GROUP BY
tbl_category_main.ctgm_code
");
$query_2h->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow2h=$query_2h->fetch(PDO::FETCH_ASSOC);
$result_ctgm_h=$dataRow2h['evalc_value_total'];
        
//จำนวนประเมินให้หมวดย่อย
$query_3h = $sql_process->runQuery("SELECT 
COUNT(tbl_evaluation_cach.evalc_value) AS evalc_value_total,
AVG(tbl_evaluation_cach.evalc_value) AS evalc_value_avg
FROM tbl_category_sub,tbl_evaluation_cach WHERE
tbl_evaluation_cach.evalc_status='1' AND 
tbl_category_sub.ctgs_code=tbl_evaluation_cach.evltp_code AND 
tbl_category_sub.ctgm_code ='$evltp_code' AND 
MONTH(tbl_evaluation_cach.evalc_date) = '$i1' AND
YEAR(tbl_evaluation_cach.evalc_date) = '$current_year'AND
tbl_category_sub.cmn_code=:cmn_code_param
GROUP BY
tbl_category_sub.ctgm_code
");
$query_3h->execute(array(":cmn_code_param"=>$cmn_codex));
$dataRow3h=$query_3h->fetch(PDO::FETCH_ASSOC);
$result_ctgs_h=$dataRow3h['evalc_value_total'];
// ผมรวม
$result_total_h=$result_user_h+$result_ctgm_h+$result_ctgs_h;
// $result_avg_a=($dataRow1A['evalc_value_avg']+$dataRow1B['evalc_value_avg']+$dataRow1C['evalc_value_avg']);

// 1 = ไม่ว่าง,0=ว่าง
// 1 0 0
if($dataRow1h['evalc_value_avg'] !=NULL && $dataRow2h['evalc_value_avg']==NULL && $dataRow3h['evalc_value_avg'] ==NULL){
  $result_avg_a=($dataRow1h['evalc_value_avg'])/1;
  // 0 1 0
  }elseif($dataRow1h['evalc_value_avg'] ==NULL && $dataRow2h['evalc_value_avg']!=NULL && $dataRow3h['evalc_value_avg'] ==NULL){
    $result_avg_h=($dataRow2h['evalc_value_avg'])/1;
  
  // 0 0 1
  }elseif($dataRow1h['evalc_value_avg'] ==NULL && $dataRow2h['evalc_value_avg']==NULL && $dataRow3h['evalc_value_avg'] !=NULL){
    $result_avg_h=($dataRow3h['evalc_value_avg'])/1;
  
  // 1 1 0
  }elseif($dataRow1h['evalc_value_avg'] !=NULL && $dataRow2h['evalc_value_avg']!=NULL && $dataRow3h['evalc_value_avg'] ==NULL){
    $result_avg_h=($dataRow1h['evalc_value_avg']+$dataRow2h['evalc_value_avg'])/2;
  
  // 0 1 1
  }elseif($dataRow1h['evalc_value_avg'] ==NULL && $dataRow2h['evalc_value_avg']!=NULL && $dataRow3h['evalc_value_avg'] !=NULL){
    $result_avg_h=($dataRow2h['evalc_value_avg']+$dataRow3h['evalc_value_avg'])/2;
  // 1 1 1
  }elseif($dataRow1h['evalc_value_avg'] !=NULL && $dataRow2h['evalc_value_avg']!=NULL && $dataRow3h['evalc_value_avg'] !=NULL){
    $result_avg_h=($dataRow1h['evalc_value_avg']+$dataRow2h['evalc_value_avg']+$dataRow3h['evalc_value_avg'])/3;
  // 1 0 1
  }elseif($dataRow1h['evalc_value_avg'] !=NULL && $dataRow2h['evalc_value_avg']==NULL && $dataRow3h['evalc_value_avg'] !=NULL){
    $result_avg_h=($dataRow1h['evalc_value_avg']+$dataRow2h['evalc_value_avg'])/2;
  
  // 0 0 0
  }else{
    $result_avg_h=0;
  }

$mavgh[$i1] =number_format($result_avg_h,2); 

  }
?> 
var chart = Highcharts.chart('container', {

title: {
  // กราฟเฉลี่ยระดับความพึงพอในแต่ละเดือน ประจำปี
    text: '<?=$auth_user->mf("UV5GFNERRSJJ77I3SLQ",$country_idx)?> <?php echo $current_year; ?>'
},
credits: {
      enabled: false
  },
subtitle: {
    text: 'Plain'
},

xAxis: {
  categories: [
            '<?=$m1?>',
            '<?=$m2?>',
            '<?=$m3?>',
            '<?=$m4?>',
            '<?=$m5?>',
            '<?=$m6?>',
            '<?=$m7?>',
            '<?=$m8?>',
            '<?=$m9?>',
            '<?=$m10?>',
            '<?=$m11?>',
            '<?=$m12?>'
    ],
},

series: [{
    type: 'column',
    colorByPoint: true,
     data: [<?=$mavgh[1]?>,<?=$mavgh[2]?>, <?=$mavgh[3]?>, <?=$mavgh[4]?>, <?=$mavgh[5]?>, <?=$mavgh[6]?>,<?=$mavgh[7]?>, <?=$mavgh[8]?>, <?=$mavgh[9]?>, <?=$mavgh[10]?>, <?=$mavgh[11]?>, <?=$mavgh[12]?>],
  //  data: [29.95, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
    showInLegend: false
}]

});


$('#plain').click(function () {
chart.update({
    chart: {
        inverted: false,
        polar: false
    },
    subtitle: {
        text: 'Plain'
    }
});
});

$('#inverted').click(function () {
chart.update({
    chart: {
        inverted: true,
        polar: false
    },
    subtitle: {
        text: 'Inverted'
    }
});
});

$('#polar').click(function () {
chart.update({
    chart: {
        inverted: false,
        polar: true
    },
    subtitle: {
        text: 'Polar'
    }
});
});

Highcharts.chart('container1', {
    chart: {
        type: 'line'
    },
    title: {
     
     // กราฟเฉลี่ยระดับความพึงพอในแต่ละเดือน ประจำปี
       text: '<?=$auth_user->mf("UV5GFNERRSJJ77I3SLQ",$country_idx)?>  <?php echo $current_year; ?>'
   },
    credits: {
      enabled: false
  },
    subtitle: {
        text: '<?php echo $current_year; ?>'
    },
    xAxis: {
      categories: [
            '<?=$m1?>',
            '<?=$m2?>',
            '<?=$m3?>',
            '<?=$m4?>',
            '<?=$m5?>',
            '<?=$m6?>',
            '<?=$m7?>',
            '<?=$m8?>',
            '<?=$m9?>',
            '<?=$m10?>',
            '<?=$m11?>',
            '<?=$m12?>'
    ],
    },
    yAxis: {
      title: {
          // ระดับคะแนนเฉลี่ย
            text: '<?=$auth_user->mf("VZWU2XHLZBJFEDCXP3TP",$country_idx)?>'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        // คะแนนเฉลี่ย
        name: '<?=$auth_user->mf("CI7HB4AA31EAKSYBOS",$country_idx)?>',
        // data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        data: [<?=$mavgh[1]?>,<?=$mavgh[2]?>, <?=$mavgh[3]?>, <?=$mavgh[4]?>, <?=$mavgh[5]?>, <?=$mavgh[6]?>,<?=$mavgh[7]?>, <?=$mavgh[8]?>, <?=$mavgh[9]?>, <?=$mavgh[10]?>, <?=$mavgh[11]?>, <?=$mavgh[12]?>]
    }]
});

Highcharts.chart('container2', {
    chart: {
        type: 'column'
    },
    title: {
      // อัตราการประเมินในแต่ละระดับ ประจำปี
        text: '<?=$auth_user->mf("CM59NQWJRMD4HG4TZJB",$country_idx)?> <?php echo $current_year; ?>'
    },
    credits: {
      enabled: false
  },
    xAxis: {
      categories: [
        '<?=$m1?>',
            '<?=$m2?>',
            '<?=$m3?>',
            '<?=$m4?>',
            '<?=$m5?>',
            '<?=$m6?>',
            '<?=$m7?>',
            '<?=$m8?>',
            '<?=$m9?>',
            '<?=$m10?>',
            '<?=$m11?>',
            '<?=$m12?>'
    ]
    },
    yAxis: {
        min: 0,
        title: {
          // จำนวนการประเมินในแต่ละระดับ
            text: '<?=$auth_user->mf("BEP6O5G5B3L09XGGWMBN",$country_idx)?>'
        }
    },
    tooltip: {
        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
        shared: true
    },
    plotOptions: {
        column: {
            stacking: 'percent'
        }
    },
    series: [
      <?php
       for($i3=1; $i3<=5; $i3++) {
        ///จำนวนการประเมินในแต่ละเดือน     

        for($i4=1; $i4<=12; $i4++) {
//จำนวนประเมินให้พนักงาน
$result_user_b =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_user_detail,tbl_evaluation_cach WHERE tbl_user_detail.ctgm_code ='$evltp_code'
AND tbl_user_detail.user_code=tbl_evaluation_cach.evltp_code AND tbl_user_detail.cmn_code='$cmn_codex' AND tbl_evaluation_cach.evalc_value ='$i3' AND MONTH(tbl_evaluation_cach.evalc_date) = '$i4' AND YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND tbl_evaluation_cach.evalc_status='1'  ");
//จำนวนประเมินให้หมวดหมู่ใหญ่
$result_ctgm_b =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_category_main,tbl_evaluation_cach WHERE tbl_category_main.ctgm_code ='$evltp_code'
AND tbl_category_main.ctgm_code=tbl_evaluation_cach.evltp_code AND tbl_category_main.cmn_code='$cmn_codex' AND tbl_evaluation_cach.evalc_value ='$i3' AND MONTH(tbl_evaluation_cach.evalc_date) = '$i4' AND YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND tbl_evaluation_cach.evalc_status='1'");           
//จำนวนประเมินให้หมวดย่อย
$result_ctgs_b =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_category_sub,tbl_evaluation_cach WHERE tbl_category_sub.ctgm_code ='$evltp_code'
AND tbl_category_sub.ctgs_code=tbl_evaluation_cach.evltp_code AND tbl_category_sub.cmn_code='$cmn_codex' AND tbl_evaluation_cach.evalc_value ='$i3' AND MONTH(tbl_evaluation_cach.evalc_date) = '$i4' AND YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND tbl_evaluation_cach.evalc_status='1'"); 
// ผมรวม
$rtotal[$i4]=$result_user_b+$result_ctgm_b+$result_ctgs_b;
        }

      ?>
      {
        name: '<?=$g2?>  <?=$i3?>',
        data: [<?=$rtotal[1]?>,<?=$rtotal[2]?>, <?=$rtotal[3]?>, <?=$rtotal[4]?>, <?=$rtotal[5]?>, <?=$rtotal[6]?>, <?=$rtotal[7]?>, <?=$rtotal[8]?>, <?=$rtotal[9]?>, <?=$rtotal[10]?>, <?=$rtotal[11]?>, <?=$rtotal[12]?>]
    },
  <?php } ?>
 
  ]
});

</script>
