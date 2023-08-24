<?php
$eltp_code_get=$_GET["eltp"];
$evltp_code = isset($_GET['evltp']) ? $_GET['evltp'] : NULL; 
$stmt = $sql_process->runQuery("SELECT eltp_name,eltp_status_topic FROM tbl_evaluation_topic WHERE eltp_code=:eltp_code_param");
$stmt->execute(array(":eltp_code_param"=>$eltp_code_get));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
$fileQrcode="$eltp_code_get-$evltp_code".".png";
// $eltp_code-$evltp_code
$name_qrcode="$actual_link_site/public/?eltp=$eltp_code_get&evltp=$evltp_code";

?>
<div class="row">
          

          <div class="col-lg-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">
                  <!-- สร้าง Qr-Code  -->
                  <?=$auth_user->mf("UQRSAI70CIPXZG86JMKA",$country_idx)?>
                  :
                   <?=$dataRow["eltp_name"]?></h4>
                <div class="table-responsive">
                <form action="#" method="get"name="form1" class="sidebar-form" autocomplete="off">
                <input type="hidden" name="zone" value="<?=$zone?>" />
                <input type="hidden" name="eltp" value="<?=$eltp_code_get?>" />
               
     
                <?php
if($dataRow['eltp_status_topic']==1 && !isset($_GET['Company'])){
        echo "<script>";
        echo "location.href = '?zone=$zone&eltp=$eltp_code_get&Company'";
        echo "</script>";
        $name2=NULL;
}elseif($dataRow['eltp_status_topic']==2){
  require("page_5_EvaluationQrcode_CategoryMain.php");
  $name2= $sql_process->QueryField1("tbl_category_main","ctgm_name","ctgm_code='$evltp_code'");
}elseif($dataRow['eltp_status_topic']==3){
  require("page_5_EvaluationQrcode_CategorySub.php");
  $name2= $sql_process->QueryField1("tbl_category_sub","ctgs_name","ctgs_code='$evltp_code'");
}elseif($dataRow['eltp_status_topic']==4){
  require("page_5_EvaluationQrcode_Personal.php");

$stmt5 = $sql_process->runQuery("SELECT user_firstname,user_lastname FROM tbl_user WHERE user_code=:user_code AND user_status='3'");
$stmt5->execute(array(":user_code"=>$evltp_code));
$dataRow5=$stmt5->fetch(PDO::FETCH_ASSOC);
$name2=$dataRow5["user_firstname"]." ".$dataRow5["user_lastname"];
}
$name2=!empty($name2) ? $name2 : NULL;
?>

<div class="form-group">
<br>
<center>

<SCRIPT LANGUAGE="JavaScript">
function myFunction() {
  var copyText = document.getElementById("myInput");
  copyText.select();
  copyText.setSelectionRange(0, 99999)
  document.execCommand("copy");
  alert("Copied the text: " + copyText.value);
}
  </SCRIPT>

 <button   type="button" class="btn btn-outline-success btn-fw" onClick="window.open('print-qrcode?fileQrcode=<?=$fileQrcode?>&fileName=<?=$dataRow["eltp_name"]?>&linkUrl=<?=base64_encode($name_qrcode)?>&name2=<?=$name2?>','','width=650,height=650'); return false;">
 <i class="mdi mdi-printer"></i>
 <!-- พิมพ์ Qr-Code  -->
 <?=$auth_user->mf("6M2DQFPDKPDWPPZX8S4X",$country_idx)?>
</button>
 <button type="button" class="btn btn-outline-warning btn-fw" onclick="window.location.href='?zone=EvaluationData'">
 <i class="mdi mdi-keyboard-backspace" aria-hidden="true"></i>
  <!-- กลับไปยังหน้าหลัก  -->
  <?=$auth_user->mf("4X1MKFGU9N9X9V1OJH8",$country_idx)?>
</button>
 </center>
  </div>  


             </form>  

<div class="form-group">   
  <?php if($eltp_code_get !=NULL){ ?>   

    <div class="form-group">
<br>

  </div>  
  <div align="center">
<!-- <a href="<?=$name_qrcode?>" target="_blank" ><?=$name_qrcode?></a> -->
<div class="form-group">
                    
                    
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info"  value="<?=$name_qrcode?>" readonly id='myInput'>
                        <span class="input-group-append">
                          <button onclick="myFunction()" class="file-upload-browse btn btn-info" type="button">
                          <!-- คัดลอกลิงก์ -->
                          <?=$auth_user->mf("78CANC0GZH9RFFEU1S43",$country_idx)?>
                        </button>
                          <button    onclick="window.open('<?=$name_qrcode?>', '_blank')" class="file-upload-browse btn btn-success" type="button">
                          <!-- ไปยังลิงก์ประเมิน -->
                          <?=$auth_user->mf("4Q1MN536L1THHY6GPUUP",$country_idx)?>
                        </button>
                        </span>
                      </div>
                    </div>


</div>
<iframe  src="send_qrcode.php?eltp_code=<?=$eltp_code_get?>&evltp_code=<?=$evltp_code?>&actual_link_site=<?=$actual_link_site?>"  id="qrcode" style="width:100%; height:450px ;  border:thin; background-color:#fff"></iframe>

<?php } ?>

</div>      

   


                </div>
              </div>
            </div>
          </div>

        </div>