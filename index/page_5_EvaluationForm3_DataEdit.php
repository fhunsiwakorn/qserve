<?php
 require_once("../config/dbl_config.php");
 require_once('../class/class_query.php');
 require_once('../class/class_user.php');
 $sql_process = new function_query();
 $auth_user = new USER();

$eltda_id_edit = strip_tags($_GET['eltda_id']);
$country_id =  strip_tags($_GET['country_id']);
$stmt = $sql_process->runQuery("SELECT eltda_id,eltda_name,eltp_code FROM tbl_evaluation_data WHERE eltda_id=:eltda_id_form");
$stmt->execute(array(":eltda_id_form"=>$eltda_id_edit));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
$eltp_code_x=$dataRow['eltp_code'];
if(isset($_POST['eltda_name']) ){
    $eltda_id = strip_tags($_POST['eltda_id']);
    // $eltda_name =strip_tags($_POST['eltda_name']); 
    $eltda_name = strip_tags(addslashes($_POST['eltda_name']));
    $eltp_code = strip_tags($_POST['eltp_code']);
    $Update_1= $sql_process->fastQuery("UPDATE tbl_evaluation_data SET eltda_name='$eltda_name'   WHERE eltda_id='$eltda_id'");
  echo "<script>";
  echo "location.href = 'page_5_EvaluationForm3_Sort.php?eltp_code=$eltp_code&country_id=$country_id'";
  echo "</script>";
}
$edit= $auth_user->mf("4U9N0HPRKM852Y9B5II",$country_id);
?> 

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit</title>



  <link rel="stylesheet" href="../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/css/style.css">


</head>
<body>
<form method="post">
<input type="hidden" name="eltp_code" value="<?=$eltp_code_x?>" />
<input type="hidden" name="eltda_id" value="<?=$eltda_id_edit?>" />
    <!-- textarea -->
    <div class="form-group">
                  <label><?=$edit?></label>
<!-- <textarea class="form-control" name="eltda_name" rows="3" required placeholder="แก้ไข ..."><?=$dataRow["eltda_name"]?></textarea> -->
<input type="text" class="form-control" name="eltda_name" id="eltda_name"   required value="<?=$dataRow["eltda_name"]?>" >
</div>
<!-- <div class="form-group">
<button type="submit" name="btn-submit" class="btn btn-warning btn-block">แก้ไข</button>
</div> -->
</form>

</body>
</html>

