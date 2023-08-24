<?php
 $startdate = isset($_GET['startdate']) ? $_GET['startdate'] : date("Y-m"); 
 $enddate = isset($_GET['enddate']) ? $_GET['enddate'] : date("Y-m"); 
 $arrayStartdate = explode("-",$startdate);
 $arrayEnddate = explode("-",$enddate);

$stmt = $sql_process->runQuery("SELECT eltp_name FROM tbl_evaluation_topic WHERE eltp_code=:eltp_code_param");
$stmt->execute(array(":eltp_code_param"=>$eltp));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
///หาตำนวนแบบประเมิน
$total_data =$sql_process->rowsQuery("SELECT evltr_id FROM
 tbl_evaluation_result WHERE eltp_code ='$eltp' AND evltp_code='$evltp_code' AND
 ((MONTH(evltp_date) >= '$arrayStartdate[1]' AND
YEAR(evltp_date) >= '$arrayStartdate[0]') AND
(MONTH(evltp_date) <= '$arrayEnddate[1]' AND
YEAR(evltp_date) <= '$arrayEnddate[0]'))
");

// https://codepen.io/yasser-mas/pen/pyWPJd

$col1=$auth_user->mf("5MEQHDSQR5O4KV7I1YUZ",$country_idx);
$col2=$auth_user->mf("93C5VPH8JVFI7F1HHU00",$country_idx);
$col3=$auth_user->mf("UEPGRXM9EBAPO9M44HGX",$country_idx);
$col4=$auth_user->mf("2EEEX16HYXN7RIEWCJGB",$country_idx);
$col5=$auth_user->mf("3692QW5U4FOLJZ1UFQ6",$country_idx);
$col6=$auth_user->mf("XS3EDYVT6DEV0EQFYNWT",$country_idx);
$col7=$auth_user->mf("AXI81XOH5YH8MEPWO43",$country_idx);

?>


<div class="row">


                <div class="col-12"  >
                  <div class="card">
 
                  <div align="right">
                  <button class="btn btn-warning" type="button" onclick="window.location.href='?zone=ReportDetail&eltp_status_topic=<?=$eltp_status_topic?>'">
                  <!-- กลับไปยังก่อนหน้านี้ -->  <?=$auth_user->mf("M9ASK4SSI2IEYYQC8FR",$country_idx)?>
                </button>  ||
                  <button class="btn btn-success" type="button" onclick="printDiv('printableArea')">
                  <!-- พิมพ์ -->
                  <?=$auth_user->mf("R7UA0L3KMNLJN0H73FPN",$country_idx)?>
                </button>  
                  </div>

                    <div class="card-body" id="printableArea">
                    <h4 class="card-title">
                     <!-- แบบประเมิน  -->
                     <?=$auth_user->mf("WVA0K7KJQ0KR5O524AG",$country_idx)?>  :  <?=$dataRow["eltp_name"]?>
                    </h4>
       
                    <form method="get" >
<input type="hidden"  name="zone"  value="<?=$zone?>" >
<input type="hidden"  name="eltp"  value="<?=$eltp?>" >
<input type="hidden"  name="eltp_status_topic"  value="<?=$eltp_status_topic?>" >
<table style="width:100%;">
<tbody>
<tr>
<td style="width:50%;">
<select name="evltp" id="evltp" class="form-control" required onchange="submit();">
<?php 
$qz = $sql_process->runQuery(
    "SELECT
    tbl_category_main.ctgm_name,
    tbl_category_main.ctgm_code
    FROM
    tbl_category_main 
    WHERE
    tbl_category_main.ctgm_status='1' AND
    tbl_category_main.is_delete='1' AND
    tbl_category_main.cmn_code=:cmn_code_param
    ORDER BY
    tbl_category_main.ctgm_id DESC
    ");
    $qz->execute(array(":cmn_code_param"=>$cmn_codex));
    while($rowDataz= $qz->fetch(PDO::FETCH_OBJ)) {
    echo "<optgroup label='$rowDataz->ctgm_name'>";
$qa = $sql_process->runQuery(
"SELECT
tbl_user.user_prefix,
tbl_user.user_firstname,
tbl_user.user_lastname,
tbl_user.user_code
FROM
tbl_user,
tbl_user_detail
WHERE
tbl_user.user_code = tbl_user_detail.user_code AND
tbl_user.is_delete='1' AND
tbl_user_detail.ctgm_code='$rowDataz->ctgm_code' AND
tbl_user_detail.cmn_code=:cmn_code_param
ORDER BY
tbl_user.user_firstname ASC
");
$qa->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowData1= $qa->fetch(PDO::FETCH_OBJ)) {
echo"<option value='$rowData1->user_code'";
if ($evltp_code == $rowData1->user_code)
{
echo "SELECTED";
}
echo ">$ctgm_name_main_x -> $rowDataz->ctgm_name -> $rowData1->user_prefix $rowData1->user_firstname $rowData1->user_lastname</option>\n";
}

echo "</optgroup>";
    }
?>

</select>

</td>

<td style="width:25%;">
<input class="form-control" type="month"  name="startdate" value="<?=$startdate?>" onchange="submit();"/>
</td>
<td style="width:25%;">
<input class="form-control" type="month"  name="enddate" value="<?=$enddate?>" onchange="submit();"/>
</td>



</tr>
</tbody>
</table>
<br>
</form>


                  
                      <div>
                       <!-- ตอบแบบประเมิน  -->
                       <?=$auth_user->mf("5XB21J1I7WSCZPLD03ZM",$country_idx)?>
                      <font color="red">
                      <?=$total_data?> 
                      </font>
                      <!-- ครั้ง     -->
                      <?=$auth_user->mf("B06F85JUZPKUHOYQ3C",$country_idx)?>
                    </div>

                    <div class="table-responsive">
                  

                    <table id="example" class="table table-bordered" style="width:100%">

<thead>
    <tr style="text-align:center;font-weight: bold;">
    <th><?=$col1?></th>
      <th><?=$col2?></th>
      <th><?=$col3?> <hr> 1</th>
      <th><?=$col4?><hr> 2</th>
      <th><?=$col5?> <hr>3</th>
      <th><?=$col6?> <hr>4</th>
      <th><?=$col7?> <hr>5</th>
    </tr>
    </thead>
    <tbody>
    <?php

$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_evaluation_data.eltda_id,
tbl_evaluation_data.eltda_name,
tbl_evaluation_data.eltda_index,
tbl_evaluation_data.is_delete
FROM
tbl_evaluation_data
WHERE
tbl_evaluation_data.cmn_code =:cmn_code_param AND
tbl_evaluation_data.eltp_code =:eltp_code_param AND
tbl_evaluation_data.is_delete = '1' 
ORDER BY
tbl_evaluation_data.eltda_index ASC
");
$qg->execute(array(":cmn_code_param"=>$cmn_codex,":eltp_code_param"=>$eltp));
$total_eva=$qg->rowCount();
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {

$num_gen++;

for($i1=1; $i1<=5; $i1++) {
$chk_value[$i1] =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_evaluation_cach
WHERE tbl_evaluation_cach.evalc_value ='$i1' AND tbl_evaluation_cach.eltp_code='$eltp' AND 
tbl_evaluation_cach.eltda_id='$rowData->eltda_id' AND tbl_evaluation_cach.evalc_status='1' AND
tbl_evaluation_cach.evltp_code='$evltp_code' AND
((MONTH(tbl_evaluation_cach.evalc_date) >= '$arrayStartdate[1]' AND
YEAR(tbl_evaluation_cach.evalc_date) >= '$arrayStartdate[0]') AND
(MONTH(tbl_evaluation_cach.evalc_date) <= '$arrayEnddate[1]' AND
YEAR(tbl_evaluation_cach.evalc_date) <= '$arrayEnddate[0]'))
");
}
?>
    <tr>
      <td align="center"><?=$num_gen?></td>
      <td><?=$rowData->eltda_name?></td>
      <td align="center"><?=number_format($chk_value[1],2)?><hr><?php if($chk_value[1]>0 && $total_data>0){echo number_format(($chk_value[1]/$total_data)*100,2);}else{echo"0.00";}?></td>
      <td align="center"><?=number_format($chk_value[2],2)?><hr><?php if($chk_value[2]>0 && $total_data>0){echo number_format(($chk_value[2]/$total_data)*100,2);}else{echo"0.00";}?></td>
      <td align="center"><?=number_format($chk_value[3],2)?><hr><?php if($chk_value[3]>0 && $total_data>0){echo number_format(($chk_value[3]/$total_data)*100,2);}else{echo"0.00";}?></td>
      <td align="center"><?=number_format($chk_value[4],2)?><hr><?php if($chk_value[4]>0 && $total_data>0){echo number_format(($chk_value[4]/$total_data)*100,2);}else{echo"0.00";}?></td>
      <td align="center"><?=number_format($chk_value[5],2)?><hr><?php if($chk_value[5]>0 && $total_data>0){echo number_format(($chk_value[5]/$total_data)*100,2);}else{echo"0.00";}?></td>
    
    </tr>
<?php } 
////หาระดับ 5,4,3,2,1 ต่อเนื้อหาทั้งหมด
for($i1=1; $i1<=5; $i1++) {
  $chk_value1[$i1] =$sql_process->rowsQuery("SELECT tbl_evaluation_cach.evalc_value FROM tbl_evaluation_cach
  WHERE tbl_evaluation_cach.evalc_value ='$i1' AND tbl_evaluation_cach.eltp_code='$eltp' AND  
  tbl_evaluation_cach.evltp_code='$evltp_code' AND tbl_evaluation_cach.evalc_status='1' AND
((MONTH(tbl_evaluation_cach.evalc_date) >= '$arrayStartdate[1]' AND
YEAR(tbl_evaluation_cach.evalc_date) >= '$arrayStartdate[0]') AND
(MONTH(tbl_evaluation_cach.evalc_date) <= '$arrayEnddate[1]' AND
YEAR(tbl_evaluation_cach.evalc_date) <= '$arrayEnddate[0]'))");
  }
?>

<tr>
<td align="center" colspan="2">
        <!-- ความถี่สะสม -->
        <?=$auth_user->mf("E11N3PI0R1M9LQ37IN",$country_idx)?>
      </td>
      <td align="center"><?php if($chk_value[1]>0 && $total_eva>0){echo number_format($chk_value1[1]/$total_eva,2);}else{echo"0.00";}?></td>
      <td align="center"><?php if($chk_value[2]>0 && $total_eva>0){echo number_format($chk_value1[2]/$total_eva,2);}else{echo"0.00";}?></td>
      <td align="center"><?php if($chk_value[3]>0 && $total_eva>0){echo number_format($chk_value1[3]/$total_eva,2);}else{echo"0.00";}?></td>
      <td align="center"><?php if($chk_value[4]>0 && $total_eva>0){echo number_format($chk_value1[4]/$total_eva,2);}else{echo"0.00";}?></td>
      <td align="center"><?php if($chk_value[5]>0 && $total_eva>0){echo number_format($chk_value1[5]/$total_eva,2);}else{echo"0.00";}?></td>
    </tr>
<tr>

<td align="center" colspan="2">
        <!-- คะแนนที่ได้ -->
        <?=$auth_user->mf("FS3R6NVYJCPU9PU1PATW",$country_idx)?>
      </td>
      <td align="center"><?php if($chk_value1[1]>0 && $total_eva>0){echo number_format(($chk_value1[1]/$total_eva)*1,2);}else{echo"0.00";}?></td>
      <td align="center"><?php if($chk_value1[2]>0 && $total_eva>0){echo number_format(($chk_value1[2]/$total_eva)*2,2);}else{echo"0.00";}?></td>
      <td align="center"><?php if($chk_value1[3]>0 && $total_eva>0){echo number_format(($chk_value1[3]/$total_eva)*3,2);}else{echo"0.00";}?></td>
      <td align="center"><?php if($chk_value1[4]>0 && $total_eva>0){echo number_format(($chk_value1[4]/$total_eva)*4,2);}else{echo"0.00";}?></td>
      <td align="center"><?php if($chk_value1[5]>0 && $total_eva>0){echo number_format(($chk_value1[5]/$total_eva)*5,2);}else{echo"0.00";}?></td>
 </tr>
 <tr>
 <td align="center" colspan="2">
        <!-- คะแนนรวม -->
        <?=$auth_user->mf("7GMJE4IXUW63GWJW82SW",$country_idx)?>
      </td>
      <td align="center"  colspan="5"><?=number_format((($chk_value1[1]/$total_eva)*1)+(($chk_value1[2]/$total_eva)*2)+(($chk_value1[3]/$total_eva)*3)+(($chk_value1[4]/$total_eva)*4)+(($chk_value1[5]/$total_eva)*5),2)?></td>
    
 </tr>
 <tr>
 <td align="center" colspan="2">
        <!-- คะแนนเฉลี่ย -->
        <?=$auth_user->mf("CI7HB4AA31EAKSYBOS",$country_idx)?>
      </td>
      <td align="center"  colspan="5">
      <?php
      if($total_data>0){
        $avg=number_format(((($chk_value1[1]/$total_eva)*1)+(($chk_value1[2]/$total_eva)*2)+(($chk_value1[3]/$total_eva)*3)+(($chk_value1[4]/$total_eva)*4)+(($chk_value1[5]/$total_eva)*5))/$total_data,2);
      }else{
        $avg="0.00";
      }
       
      //echo $avg;?>

      <!-- ดังนั้น คะแนนความพึงพอใจเท่ากับ  -->
      <?=$avg?>
      
      <!-- มีความพึงพอใจในระดับ  -->
      <?=$auth_user->mf("UE22RDKB7OW9501B09OA",$country_idx)?>
      <font color="red" size="4"><u>
      <?php
    if($avg <= 1.50){
      // echo "น้อยที่สุด";
      echo $col3;
    }elseif($avg <= 2.50){
      // echo "น้อย";
      echo $col4;
    }elseif($avg <= 3.50){
      // echo "ปานกลาง";
      echo $col5;
    }elseif($avg <= 4.50){
      // echo "มาก";
      echo $col6;
    }elseif($avg <= 5){
      // echo "มากทึ่สุด";
      echo $col7;
    }
      ?>
      </u>
      </font>
    </td>
 </tr>
  </tbody>
</table>
  <?php
  require_once("gaint.php");
  ?>



                  </div>


  
    </div>               




                    </div>
                  </div>
                </div>
              
          
            
          

    
       