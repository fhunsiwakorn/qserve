
<div class="form-group">
<label>
  <!-- บุคลากร/เจ้าหน้าที่ -->
  <?=$auth_user->mf("82BS90L39GV79H0CHXJ",$country_idx)?>
</label>
<select name="evltp" id="evltp"  class="form-control" onchange="submit();">
<option value="">--<?=$auth_user->mf("NKZAJPZ21NHY00ST25GJ",$country_idx)?>--</option>
<?php

$qa = $sql_process->runQuery(
"SELECT
tbl_evaluation_permission.evltp_id,
tbl_evaluation_permission.eltp_code,
tbl_evaluation_permission.evltp_code,
tbl_user.user_firstname,
tbl_user.user_lastname
FROM
tbl_evaluation_permission ,
tbl_user
WHERE
tbl_evaluation_permission.evltp_code = tbl_user.user_code AND
tbl_evaluation_permission.eltp_code=:evltp_code_param
ORDER BY
tbl_user.user_firstname  ASC");
$qa->execute(array(":evltp_code_param"=>$eltp_code_get));
while($rowA= $qa->fetch(PDO::FETCH_OBJ)) {
echo"<option value='$rowA->evltp_code'";
if ($evltp_code == $rowA->evltp_code)
{
  echo "SELECTED";
}
echo ">$rowA->user_firstname $rowA->user_lastname</option>\n";
}
?>
<!-- $actual_link_site -->
</select>    
</div>
