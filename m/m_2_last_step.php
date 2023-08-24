<div  id='box_css3_raduis' >
<?php
unset($_SESSION['cre_evalc_code']);
echo "<center>";
echo "<h4>";
echo $dataRow["cmn_name"];
echo "<br>";
echo $sql_process->lookupfild("eltp_remark","tbl_evaluation_topic","eltp_code","$eltp_code_get"); 
echo "</h4>";
echo "</center>";
echo "<meta http-equiv='refresh' content='10;URL=?eltp=$eltp_code_get'>";
?>
</div>