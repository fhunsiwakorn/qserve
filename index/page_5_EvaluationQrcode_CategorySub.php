
<div class="form-group">
<label><?=$ctgs_name_main_x?></label>
<select name="evltp" id="evltp"  class="form-control" onchange="submit();">
<option value="">--<?=$auth_user->mf("NKZAJPZ21NHY00ST25GJ",$country_idx)?>--</option>
<?php

$qa = $sql_process->runQuery(
"SELECT
tbl_evaluation_permission.evltp_id,
tbl_evaluation_permission.eltp_code,
tbl_evaluation_permission.evltp_code,
tbl_category_sub.ctgs_name
FROM
tbl_evaluation_permission ,
tbl_category_sub
WHERE
tbl_evaluation_permission.evltp_code = tbl_category_sub.ctgs_code AND
tbl_evaluation_permission.eltp_code=:evltp_code_param
ORDER BY
tbl_category_sub.ctgs_name  ASC");
$qa->execute(array(":evltp_code_param"=>$eltp_code_get));
while($rowA= $qa->fetch(PDO::FETCH_OBJ)) {
echo"<option value='$rowA->evltp_code'";
if ($evltp_code == $rowA->evltp_code)
{
  echo "SELECTED";
}
echo ">$rowA->ctgs_name</option>\n";
}
?>
<!-- $actual_link_site -->
</select>    
</div>
