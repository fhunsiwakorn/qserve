<?php
//////$Chek_result =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='$evltp_code_get' AND  evltp_user_agent='$evalc_code'");
$Chek_result =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='$evltp_code_get' AND evltp_user_agent='$useragent' AND DATE(evltp_date)='$date_current'");

?>
    
  <center>  <h4 style="display: block; margin: auto;"> &nbsp;&nbsp;<?=$dataRow["eltp_name"]?></h4></center>
<br>
    <div  id='box_css3_raduis' >
  
    <table style="text-align: left; width: 100%;" border="0"
 cellpadding="2" cellspacing="2">
  <tbody>
    <tr width="50%">
      <td  > <img src="<?=$pathuserimg?>" alt="IMG" style="display: block; margin: auto;height:150px; width:150px;" /> </td>
 
      <td valign="center"><p>	<?=$ctgs_name_main_x?> : <?=$dataRow1["ctgs_name"]?></p> <p>	<?=$ctgm_name_main_x?> : <?=$ctgm_name?></p></td>
    </tr>
   
  </tbody>
</table>



</div>	

<div align="center">
    <hr>
<button   class="btn btn-success" onclick="window.location.href='?zone=EvaStart&eltp=<?=$eltp_code_get?>&evltp=<?=$evltp_code_get?>'">
              <!-- ทำการประเมิน -->
              <?=$txt3?>
						</button>
<br><br>
<button   class="btn btn-info" onclick="window.location.href='?eltp=<?=$eltp_code_get?>'">
<!-- <<< กลับไปยังหน้าหลัก -->
<<< <?=$txt5?>
</button>
                        
</div>


