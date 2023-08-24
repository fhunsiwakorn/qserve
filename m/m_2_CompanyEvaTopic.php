<?php
$Chek_result =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='i' AND evltp_user_agent='$useragent' AND DATE(evltp_date)='$date_current'");

?>
    
  <center>  <h4 style="display: block; margin: auto;"> &nbsp;&nbsp;<?=$dataRow["eltp_name"]?></h4></center>
<br>
    <div  id='box_css3_raduis' >
  
    <div align="center">
    <hr>
<button   class="btn btn-success" onclick="window.location.href='?zone=EvaStart&eltp=<?=$eltp_code_get?>&evltp=i'">
              <!-- ทำการประเมิน -->
              <?=$txt3?>
            </button>
            <br>
            <?php if($Chek_result >=1){ ?> 
						<font size="-1" color="red">
							<!-- คุณทำแบบประเมินนี้แล้ว.. -->
							<?=$txt4?>
						</font><br>
						
					<?php } ?>
<br><br>
<button   class="btn btn-info" onclick="window.location.href='?eltp=<?=$eltp_code_get?>'">
<!-- <<< กลับไปยังหน้าหลัก -->
<<< <?=$txt5?>
</button>
                        
</div>



</div>	




