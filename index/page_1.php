<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
$current_month = isset($_GET['current_month']) ? $_GET['current_month'] : date("m"); 
$current_year = isset($_GET['current_year']) ? $_GET['current_year'] : date("Y"); 
/////จำนวนแบบประเมิน
$total_chkEvatopic =$sql_process->rowsQuery("SELECT eltp_id FROM tbl_evaluation_topic WHERE  is_delete ='1'AND  eltp_status='1' AND cmn_code='$cmn_codex'");
/////จำนวนการทำข้อสอบสำเร็จ
 $total_chktResult =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE    cmn_code='$cmn_codex' AND MONTH(evltp_date) = '$current_month' AND YEAR(evltp_date) = '$current_year'");
/////จำนวนComment
$total_chktComment =$sql_process->rowsQuery("SELECT evalc_id FROM tbl_evaluation_cach WHERE evalc_comment != '' AND   cmn_code='$cmn_codex'  AND MONTH(evalc_date) = '$current_month' AND YEAR(evalc_date) = '$current_year'");
////จำนวนบุคลากร
$total_chktPersonal =$sql_process->rowsQuery("SELECT tbl_user.user_code FROM tbl_user,tbl_user_detail WHERE tbl_user.user_code = tbl_user_detail.user_code AND tbl_user.is_delete ='1' AND tbl_user.user_status ='3' AND   tbl_user_detail.cmn_code='$cmn_codex' GROUP BY tbl_user.user_code");
///จำนวนรายละเอียดทำประเมิน
 $total_chktCach =$sql_process->rowsQuery("SELECT evalc_id FROM tbl_evaluation_cach WHERE    cmn_code='$cmn_codex' AND MONTH(evalc_date) = '$current_month' AND YEAR(evalc_date) = '$current_year'");


$chk_sum=$sql_process->QueryField2("tbl_evaluation_result","evltr_avg","SUM","cmn_code='$cmn_codex' AND MONTH(evltp_date) = '$current_month' AND YEAR(evltp_date) = '$current_year'");

?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<div class="row">
      
<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-receipt text-danger icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">
                        <!-- จำนวนแบบประเมิน -->
                        <?=$auth_user->mf("IR4547BW3M5UD06TUFLT",$country_idx)?>
                      </p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?=$total_chkEvatopic?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> 
                    <!-- จำนวนแบบประเมิน -->
                    <?=$auth_user->mf("IR4547BW3M5UD06TUFLT",$country_idx)?>
                  </p>
                </div>
              </div>
            </div>


     <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-book-open-page-variant text-warning icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">
                        <!-- จำนวนการทำแบบประเมิน -->
                        <?=$auth_user->mf("RPUGA18SPPII2RG5FQC",$country_idx)?>
                      </p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?=$total_chktResult?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i>
                     <!-- จำนวนการทำแบบประเมิน -->
                     <?=$auth_user->mf("RPUGA18SPPII2RG5FQC",$country_idx)?>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-comment-processing text-success icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">
                        <!-- ความคิดเห็น -->
                        <?=$auth_user->mf("ZDVME14A7RA7KCJ3G3RN",$country_idx)?>
                      </p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?=$total_chktComment?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-comment-processing mr-1" aria-hidden="true"></i> 
                    <!-- ความคิดเห็น -->
                    <?=$auth_user->mf("ZDVME14A7RA7KCJ3G3RN",$country_idx)?>
                  </p>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
              <div class="card card-statistics">
                <div class="card-body">
                  <div class="clearfix">
                    <div class="float-left">
                      <i class="mdi mdi-folder-account text-info icon-lg"></i>
                    </div>
                    <div class="float-right">
                      <p class="mb-0 text-right">
                        <!-- บุคลากร -->
                        <?=$auth_user->mf("CIGMHC7MNZVJN7RNKF0D",$country_idx)?>
                      </p>
                      <div class="fluid-container">
                        <h3 class="font-weight-medium text-right mb-0"><?=$total_chktPersonal?></h3>
                      </div>
                    </div>
                  </div>
                  <p class="text-muted mt-3 mb-0">
                    <i class="mdi mdi-reload mr-1" aria-hidden="true"></i> 
                    <!-- บุคลากร -->
                    <?=$auth_user->mf("CIGMHC7MNZVJN7RNKF0D",$country_idx)?>
                  </p>
                </div>
              </div>
            </div>


            <div class="col-lg-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">
                  <!-- ภาพรวมบริษัท / องค์กร -->
                  <?=$auth_user->mf("9WLI77ZZVAKPK4TXIS8X",$country_idx)?>
                </h4>

                        
            <form method="get" >
            <input type="hidden"  name="zone"  value="<?=$zone?>" >
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
                        

                <?php for($i=1; $i<6; $i++) { 
                 $total_chktCach1 =$sql_process->rowsQuery("SELECT evalc_id FROM tbl_evaluation_cach WHERE  evalc_value='$i' AND cmn_code='$cmn_codex' AND MONTH(evalc_date) = '$current_month' AND YEAR(evalc_date) = '$current_year'"); 
                if($total_chktCach1 >0 && $total_chktCach >0){
                  $avg=($total_chktCach1/$total_chktCach)*100;
                }else{
                  $avg=0;
                }
                 
                 ?>
                  <table align="center">
  <tbody>
    <tr>
      <td> 
      <img src="<?=base64_encode_image("../images/emoji/$i.png")?>" class="circle">
      </td>
    </tr> 
    <tr>
      <td align="center">
      <?=$i?>
      </td>    
    </tr>
    <tr>
      <td align="center"  >
    <?=number_format($avg,2)?> %

      </td>    
    </tr>
   
  </tbody>
</table>
                <?php } ?>

                <div class="col-12">
<hr>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                </div>

             

                  <div class="col-12">
                    <hr>
                  <label>
                    <!-- ความคิดเห็น / วิจารณ์ -->
                    <?=$auth_user->mf("OC6KMDPL4BSBAIAEI9X",$country_idx)?>
                  </label>
                  <div class="table-responsive">
                  <table class="js-sort-table table"   id="demo1">
                    <thead>
                      <tr>
                       
                        <th>
                        <!-- ความคิดเห็น / วิจารณ์ -->
                        <?=$auth_user->mf("OC6KMDPL4BSBAIAEI9X",$country_idx)?>
                        </th>
                        <th>
                          <!-- วันที่ -->
                          <?=$auth_user->mf("L1GAS3FGYBXR3FAJYIMR",$country_idx)?>
                        </th>
                        <th>
                          IP
                        </th>
                        <th>
                          <!-- คะแนน -->
                          <?=$auth_user->mf("1P4XW0PEALXC62585AB",$country_idx)?>
                        </th>
                       
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $total_data =$sql_process->rowsQuery("SELECT evalc_id FROM tbl_evaluation_cach WHERE evalc_comment != '' AND  MONTH(evalc_date) = '$current_month' AND YEAR(evalc_date) = '$current_year' AND cmn_code='$cmn_codex'");
                      $rows='50';
                      if($page<=0)$page=1;
                      $total_page=ceil($total_data/$rows);
                      if($page>=$total_page)$page=$total_page;
                      $start=positive_number(($page-1)*$rows);
                      $qa = $sql_process->runQuery(
                        "SELECT
                        tbl_evaluation_cach.evalc_value,
                        tbl_evaluation_cach.evalc_comment,
                        tbl_evaluation_cach.ip_device,
                        tbl_evaluation_cach.evalc_date
                        FROM
                        tbl_evaluation_cach
                        WHERE
                        tbl_evaluation_cach.evalc_comment != '' AND
                        MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND
                        YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND
                        tbl_evaluation_cach.cmn_code=:cmn_code_param
                        ORDER BY
                        tbl_evaluation_cach.evalc_id  DESC
                        limit $start,$rows");
                        $qa->execute(array(":cmn_code_param"=>$cmn_codex));
                        while($rowA= $qa->fetch(PDO::FETCH_OBJ)) {
                          // $evalc_value_avg=($rowA->evalc_value/5)*100;
                          
                          ?>
                      <tr>
                        <td>
                          <?=$rowA->evalc_comment?> 
                        </td>
                        <td>
                          <?=DatetoDMYTime($rowA->evalc_date)?>
                        </td>
                        <td>
                          <?=$rowA->ip_device?> 
                        </td>
                       
                        <td>
                        <?php for($i=1; $i<$rowA->evalc_value+1; $i++) { ?>
                        <i class="mdi mdi-star text-warning icon-lg"></i>
                        <?php } ?>

                        <?php for($i=1; $i<6-$rowA->evalc_value; $i++) { ?>
                          <i class="mdi mdi-star text-light icon-lg"></i>
                        <?php } ?>
                        <!-- <i class="mdi mdi-star text-warning icon-lg"></i>
                        <i class="mdi mdi-star text-warning icon-lg"></i>
                        <i class="mdi mdi-star text-warning icon-lg"></i>
                       
                        <i class="mdi mdi-star text-light icon-lg"></i> -->
                        </td>
                      </tr>
                        <?php } ?>
                     
                    </tbody>
                  </table>
                </div>

                <?php  require("paging.php"); ?>
                  </div>


                
                </div>

               
              </div>
            </div>
          </div>




</div>

<script>
Highcharts.chart('container', {
  chart: {
    type: 'column'
  },
  credits: {
      enabled: false
  },
  title: {
    text: '<?=$auth_user->mf("P8AZQLANHR88KP26CPJ",$country_idx)?>'
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
    crosshair: true
  },
  yAxis: {
    min: 0,
    title: {
      text: '<?=$auth_user->mf("IRM93UNV89UL2GMTOIU",$country_idx)?>'
    }
  },
  tooltip: {
    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
      '<td style="padding:0"><b>{point.y:.1f} <?=$g1?></b></td></tr>',
    footerFormat: '</table>',
    shared: true,
    useHTML: true
  },
  plotOptions: {
    column: {
      pointPadding: 0.2,
      borderWidth: 0
    }
  },
  series: [
    <?php 
  for($i=1; $i<=5; $i++) {
///จำนวนการประเมินในแต่ละเดือน

$JanuaryRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE  cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '1' AND YEAR(evalc_date) = '$current_year'");
$FebruaryRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '2' AND YEAR(evalc_date) = '$current_year'");
$MarchRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '3' AND YEAR(evalc_date) = '$current_year'");
$AprilRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '4' AND YEAR(evalc_date) = '$current_year'");
$MayRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '5' AND YEAR(evalc_date) = '$current_year'");
$JuneRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE  cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '6' AND YEAR(evalc_date) = '$current_year'");
$JulyRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '7' AND YEAR(evalc_date) = '$current_year'");
$AugustRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex'  AND  evalc_value='$i' AND MONTH(evalc_date) = '8' AND YEAR(evalc_date) = '$current_year'");
$SeptemberRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '9' AND YEAR(evalc_date) = '$current_year'");
$OctoberRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '10' AND YEAR(evalc_date) = '$current_year'");
$NovemberRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '11' AND YEAR(evalc_date) = '$current_year'");
$DecemberRows = $sql_process->rowsQuery("SELECT evalc_date FROM tbl_evaluation_cach WHERE cmn_code='$cmn_codex'  AND evalc_value='$i' AND MONTH(evalc_date) = '12' AND YEAR(evalc_date) = '$current_year'");

  ?>
 
     {
        name: '<?=$g2?> <?=$i?>',
        data: [<?=$JanuaryRows?>,<?=$FebruaryRows?>, <?=$MarchRows?>, <?=$AprilRows?>, <?=$MayRows?>, <?=$JuneRows?>,<?=$JulyRows?>, <?=$AugustRows?>, <?=$SeptemberRows?>, <?=$OctoberRows?>, <?=$NovemberRows?>, <?=$DecemberRows?>]
    },
    <?php } ?>

  ]
});
</script>