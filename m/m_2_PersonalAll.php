<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
?>

<script>
function showResult2(str) {
  if (str.length==0) { 
    document.getElementById("livesearch2").innerHTML="";
    document.getElementById("livesearch2").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch2").innerHTML=this.responseText;
      document.getElementById("livesearch2").style.border="1px solid #ffffff";
    }
  }
  xmlhttp.open("GET","m_2_PersonalAll_search.php?eltp=<?=$eltp_code_get?>&cmn_code=<?=$cmn_codex?>&country_id=<?=$country_id?>&q="+str,true);
  xmlhttp.send();
}

</script>

<center>  <h4 style="display: block; margin: auto;"> &nbsp;&nbsp;<?=$dataRow["eltp_name"]?></h4></center>
<br>

<div class="col-sm-3 my-1">
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text" onClick="javascript:location.reload();" style="cursor:pointer;" >
			  <img src="../images/images_web/magnifying-glass-145942_960_720.png"  style="display: block; margin: auto;height:25px; width:25px;" >
		  </div>
        </div>
        <input type="text" class="form-control"  name="q" id="q" placeholder="<?=$txt1?>.." onkeyup="showResult2(this.value);">
      </div>
    </div>
   
    
    <div  id='box_css3_raduis' >
    <div id="livesearch2">
<table style="text-align: left; width: 100%;" border="0"
 cellpadding="1" cellspacing="1">
  <tbody>
  <?php


$total_data =$sql_process->rowsQuery("SELECT 
tbl_user.user_code
FROM
tbl_evaluation_permission ,
tbl_user
WHERE
tbl_evaluation_permission.evltp_code = tbl_user.user_code AND
tbl_user.is_delete = '1' AND
tbl_evaluation_permission.eltp_code ='$eltp_code_get' AND
tbl_evaluation_permission.cmn_code='$cmn_codex'");
$rows='5';
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);

$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_user.user_firstname,
tbl_user.user_lastname,
tbl_user.user_img,
tbl_user.user_code,
tbl_category_main.ctgm_name,
tbl_category_sub.ctgs_name
FROM
tbl_evaluation_permission ,
tbl_user ,
tbl_user_detail ,
tbl_category_main ,
tbl_category_sub
WHERE
tbl_evaluation_permission.evltp_code = tbl_user.user_code AND
tbl_user.is_delete = '1' AND
tbl_user.user_code = tbl_user_detail.user_code AND
tbl_user_detail.ctgm_code = tbl_category_main.ctgm_code AND
tbl_user_detail.ctgs_code = tbl_category_sub.ctgs_code AND
tbl_evaluation_permission.eltp_code =:eltp_code_param AND
tbl_evaluation_permission.cmn_code=:cmn_code_param

ORDER BY
tbl_evaluation_permission.evltp_id DESC
limit $start,$rows
");
$qg->execute(array(":eltp_code_param"=>$eltp_code_get,":cmn_code_param"=>$cmn_codex));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
  $Chek_resultA =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='$rowData->user_code' AND evltp_user_agent='$useragent' AND DATE(evltp_date)='$date_current'");
$num_gen++;
//user Image

if(!empty($rowData->user_img)){
    $pathuserimg1="../images/images_user/".$rowData->user_img;
  }else{
    $pathuserimg1="../images/images_web/user.png";
  }
//   $strFileImg1=base64_encode_image($pathuserimg1);
?>

    <tr >
      <td align="center">
      <a class="thumbnail" href="<?=$pathuserimg1?>" data-lightbox="example-set-user" data-title="<?=$rowData->user_firstname?> <?=$rowData->user_lastname?>">
                        <div class="gallery">
                        <img src="<?=$pathuserimg1?>" alt="<?=$rowData->user_firstname?> <?=$rowData->user_lastname?>" class="circle" style="display: block; margin: auto;height:65px; width:65px;"/>
                        </div>
                        </a>
      </td>
      <td><?=$rowData->user_firstname?> <?=$rowData->user_lastname?></td>
      <td align="center">
      <button type="button" onclick="window.location.href='?eltp=<?=$eltp_code_get?>&evltp=<?=$rowData->user_code?>'" class="btn btn-success" >
							             <!-- ประเมิน -->
                           <?=$txt3?>
                        </button>
                        <br>
                            <?php 
                            if($Chek_resultA >0){
                              // echo "<font size='-1' color='red'>คุณเคยทำแบบประเมินนี้แล้ว..</font>";
                              echo "<font size='-1' color='red'>$txt4</font>";
                            }
                            ?>
      </td>
    </tr>
<?php } ?>

  </tbody>
</table>
</div>	

</div>	

<?php require_once("paging.php");?>
