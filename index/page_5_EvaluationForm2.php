<?php

$eltp_code_get=strip_tags($_GET["eltp"]);
$stmt = $sql_process->runQuery("SELECT eltp_name,eltp_status_topic FROM tbl_evaluation_topic WHERE eltp_code=:eltp_code_param");
$stmt->execute(array(":eltp_code_param"=>$eltp_code_get));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 

$Chk_permissionAll =$sql_process->rowsQuery("SELECT tbl_evaluation_permission.evltp_id FROM tbl_evaluation_permission WHERE  cmn_code='$cmn_codex' AND  eltp_code ='$eltp_code_get'");

if(isset($_GET["Chkstep3"])){
    if($Chk_permissionAll>=1){
        echo "<script>";
        echo "location.href = '?zone=EvaluationForm3&eltp=$eltp_code_get'";
        echo "</script>";
    }else{
        echo "<script>";
        echo "location.href = '?zone=EvaluationForm2&eltp=$eltp_code_get&error'";
        echo "</script>";
    }
    
}


?>

<?php if(isset($_GET['error'])){ ?>
<script>
swal("<?=$auth_user->mf("06HQJ41B6CHPIDJXWP49",$country_idx)?>", "<?=$g4?> !", "error")
</script>
<?php } ?>
 <div class="row">
 <div class="col-4">
 <button type="button" class="btn btn-icons btn-rounded btn-primary" onclick="window.location.href='?zone=EvaluationForm1E&eltp=<?=$eltp_code_get?>'">
 1
 </button>
 <label><?=$auth_user->mf("URC9PALSXATW6GOEUV12",$country_idx);?></label>
<hr>



 </div>

 <div class="col-4">
 <button type="button" class="btn btn-icons btn-rounded btn-primary">
2
 </button>
 <label><?=$auth_user->mf("8M8DOJ7P9N2XQTP3WU1V",$country_idx);?></label>
<hr>
 </div>

 <div class="col-4">
 <button type="button" class="btn btn-icons btn-rounded btn-inverse-outline-primary">
3
 </button>
 <label><?=$auth_user->mf("Y6ID3K217W7UWP3N5S",$country_idx);?></label>
<hr>
 </div>

</div>

<div class="row">
<?php
if($dataRow['eltp_status_topic']==1){
        echo "<script>";
        echo "location.href = '?zone=EvaluationForm3&eltp=$eltp_code_get'";
        echo "</script>";
        // $url="?zone=EvaluationForm3&eltp=$eltp_code_get";
        // header("Location: $url");
}elseif($dataRow['eltp_status_topic']==2){
  require("page_5_EvaluationForm2_CategoryMain.php");
}elseif($dataRow['eltp_status_topic']==3){
  require("page_5_EvaluationForm2_CategorySub.php");
}elseif($dataRow['eltp_status_topic']==4){
  require("page_5_EvaluationForm2_Personal.php");
}
?>
  </div>
  <div class="form-group">
<center> 
  <hr>
  
  <button  type="button" class="btn btn-success mr-2" onclick="window.location.href='?zone=EvaluationForm2&eltp=<?=$eltp_code_get?>&Chkstep3'" >
 <!-- ขั้นตอนถัดไป -->
 <?=$auth_user->mf("OHOLO47OQAO7CEXN5JMW",$country_idx);?>
</button>
  </center>
  </div>  
  
   


 


             
      
    
     