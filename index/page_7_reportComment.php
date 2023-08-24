<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
$current_month = isset($_GET['current_month']) ? $_GET['current_month'] : date("m"); 
$current_year  = isset($_GET['current_year']) ? $_GET['current_year'] :  date("Y");
$evltp_code = isset($_GET['evltp']) ? $_GET['evltp'] :NULL; 
?>

<!--END highcharts -->

<div class="row">
          

            <div class="col-lg-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <!-- card-title -->
                <h4 class="">
                  <!-- ความคิดเห็น / วิจารณ์ -->
                  <?=$auth_user->mf("OC6KMDPL4BSBAIAEI9X",$country_idx)?>
                </h4>

                        
            <form method="get" >
            <input type="hidden"  name="zone"  value="<?=$zone?>" >
            <input type="hidden"  name="evltp"  value="<?=$evltp_code?>" >
<table style="width:100%;">
<tbody>
<tr>


<td style="width:50%;">
<select name="current_month" id="current_month" class="form-control" required onchange="submit();">
<?php
$month = array("$m1","$m2","$m3","$m4","$m5","$m6","$m7","$m8","$m9","$m10","$m11","$m12");
?>
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

<?php
///ประเมินทั่วไป
$g1=$auth_user->mf("KF9GC67GPXOEIJQYYZ43",$country_idx);
?>

<div class="table-responsive">
                  <table class="js-sort-table table"   id="demo1">
                    <thead>
                      <tr> 
                        <th>
                        <!-- ความคิดเห็น / วิจารณ์ -->
                        <?=$auth_user->mf("OC6KMDPL4BSBAIAEI9X",$country_idx)?>
                        </th>
                        <th>
                       <!-- หัวข้อ -->
                       <?=$auth_user->mf("C337ZWNQ9GSC62UE5OT",$country_idx)?>
                        </th>
                        <th>
                       <!-- ประเมินให้กับ -->
                       <?=$auth_user->mf("V0MUNWY1006DJ6YC0ZA0",$country_idx)?>
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
                      $rows='150';
                      if($page<=0)$page=1;
                      $total_page=ceil($total_data/$rows);
                      if($page>=$total_page)$page=$total_page;
                      $start=positive_number(($page-1)*$rows);
                      $qa = $sql_process->runQuery(
                        "SELECT
                        tbl_evaluation_cach.evalc_value,
                        tbl_evaluation_cach.evalc_comment,
                        tbl_evaluation_cach.ip_device,
                        tbl_evaluation_cach.evalc_date,
                        tbl_evaluation_topic.eltp_code,
                        tbl_evaluation_topic.eltp_name,
                        tbl_evaluation_topic.eltp_status_topic
                        FROM
                        tbl_evaluation_cach,
                        tbl_evaluation_topic
                        WHERE
                        tbl_evaluation_cach.evltp_code='$evltp_code' AND
                        tbl_evaluation_cach.eltp_code=tbl_evaluation_topic.eltp_code AND
                        tbl_evaluation_cach.evalc_comment != '' AND
                        MONTH(tbl_evaluation_cach.evalc_date) = '$current_month' AND
                        YEAR(tbl_evaluation_cach.evalc_date) = '$current_year' AND
                        tbl_evaluation_cach.cmn_code=:cmn_code_param
                        ORDER BY
                        tbl_evaluation_cach.evalc_id  DESC
                        limit $start,$rows");
                        $qa->execute(array(":cmn_code_param"=>$cmn_codex));
                        while($rowA= $qa->fetch(PDO::FETCH_OBJ)) {
                            // $rowA->eltp_status_topic
                          
                          ?>
                      <tr>
                        <td>
                          <?=$rowA->evalc_comment?> 
                        </td>
                        <td><?=$rowA->eltp_name?> </td>
                        <td>
                            <?php
                            if($rowA->eltp_status_topic==4){
                            $stmt = $sql_process->runQuery("SELECT
                            tbl_user.user_firstname,
                            tbl_user.user_lastname,
                            tbl_category_main.ctgm_name,
                            tbl_category_sub.ctgs_name
                            FROM
                            tbl_user ,
                            tbl_user_detail ,
                            tbl_category_main ,
                            tbl_category_sub ,
                            tbl_evaluation_result ,
                            tbl_evaluation_topic
                            WHERE
                            tbl_user.user_code = tbl_user_detail.user_code AND
                            tbl_user_detail.ctgm_code = tbl_category_main.ctgm_code AND
                            tbl_user_detail.ctgs_code = tbl_category_sub.ctgs_code AND
                            tbl_user.user_code = tbl_evaluation_result.evltp_code AND
                            tbl_evaluation_result.eltp_code = tbl_evaluation_topic.eltp_code AND
                            tbl_evaluation_topic.eltp_code ='$rowA->eltp_code'
                            ");
                            $stmt->execute();
                            $dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
                            echo $dataRow["user_firstname"]." &nbsp;".$dataRow["user_lastname"]."<br>";
                            echo "$ctgm_name_main_x : ". $dataRow["ctgm_name"]."&nbsp; $ctgs_name_main_x : ".$dataRow["ctgs_name"];
                          }elseif($rowA->eltp_status_topic==3){
                            $stmt = $sql_process->runQuery("SELECT
                            tbl_category_main.ctgm_name,
                            tbl_category_sub.ctgs_name
                            FROM
                            tbl_category_main ,
                            tbl_category_sub ,
                            tbl_evaluation_result ,
                            tbl_evaluation_topic
                            WHERE
                            tbl_category_sub.ctgm_code = tbl_category_main.ctgm_code AND
                            tbl_category_sub.ctgs_code = tbl_evaluation_result.evltp_code AND
                            tbl_evaluation_result.eltp_code = tbl_evaluation_topic.eltp_code AND
                            tbl_evaluation_topic.eltp_code ='$rowA->eltp_code'
                            ");
                            $stmt->execute();
                            $dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
                            echo "$ctgm_name_main_x : ". $dataRow["ctgm_name"]."&nbsp; $ctgs_name_main_x : ".$dataRow["ctgs_name"];
                            }elseif($rowA->eltp_status_topic==2){
                                $stmt = $sql_process->runQuery("SELECT
                                tbl_category_main.ctgm_name
                                FROM
                                tbl_category_main ,
                                tbl_evaluation_result ,
                                tbl_evaluation_topic
                                WHERE
                                tbl_category_main.ctgm_code = tbl_evaluation_result.evltp_code AND
                                tbl_evaluation_result.eltp_code = tbl_evaluation_topic.eltp_code AND
                                tbl_evaluation_topic.eltp_code ='$rowA->eltp_code'
                                ");
                                $stmt->execute();
                                $dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
                                echo "$ctgm_name_main_x : ". $dataRow["ctgm_name"];
                             }elseif($rowA->eltp_status_topic==1){
                                // echo "ประเมินทั่วไป";
                                echo $g1;
                             }
                            // $stmt = $sql_process->runQuery("SELECT amphur_code,amphur_name,amphur_status,province_id FROM tbl_location_amphur WHERE amphur_id=:amphur_id_param");
                            // $stmt->execute(array(":amphur_id_param"=>$_GET['Amphur_idEdit']));
                            // $dataRow=$stmt->fetch(PDO::FETCH_ASSOC);

                            ?>
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
                <?php if($total_data >=$rows) { require("pagingReport.php"); }?>
       








               
              </div>
            </div>
          </div>
       


</div>
<?php //if($total_data >=$rows) { require("paging.php"); }?>
