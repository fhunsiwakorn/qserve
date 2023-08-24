<?php
//////$Chek_result =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='$evltp_code_get' AND  evltp_user_agent='$evalc_code'");
$Chek_result =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE cmn_code='$cmn_codex' AND eltp_code='$eltp_code_get' AND evltp_code='$evltp_code_get' AND evltp_user_agent='$useragent' AND DATE(evltp_date)='$date_current'");

?>
<div class="login100-pic js-tilt" data-tilt>
	
                    <img src="<?=$strFileImg?>" alt="IMG"> <br>
				</div>

				<div class="login100-form validate-form">

					<span class="login100-form-title">
                    <?=$dataRow["eltp_name"]?> <br>
                    </span>

					<div class="wrap-input100 validate-input">
					<?=$txt15?> : <?=$dataRow1["user_firstname"]?> <?=$dataRow1["user_lastname"]?>
					</div>
                    <div class="wrap-input100 validate-input">
					<?=$ctgm_name_main_x?> : <?=$dataRow1["ctgm_name"]?>
                    </div>
                    
                    <div class="wrap-input100 validate-input">
					<?=$ctgs_name_main_x?> : <?=$dataRow1["ctgs_name"]?>
                    </div>

					<!-- <div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div> -->

					<div class="container-login100-form-btn">
						<button  <?php /////if($Chek_result >=1){ echo "disabled";}?> class="login100-form-btn" onclick="window.location.href='?zone=EvaStart&eltp=<?=$eltp_code_get?>&evltp=<?=$evltp_code_get?>'">
							<!-- ทำการประเมิน -->
							<?=$txt3?>
						</button>
					<p>
					<?php if($Chek_result >=1){ ?> 
						 <font size="-1" color="red">
							<!-- คุณทำแบบประเมินนี้แล้ว.. -->
							<?=$txt4?>
						</font><br> 
						
					<?php } ?>
					<center>
						<font size="-1" color="blue">
                        <a href="?eltp=<?=$eltp_code_get?>" >
                        <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
							<!-- กลับไปยังหน้าหลัก -->
							<?=$txt5?>
						 </a>
						</font>
                        </center>
                        
				</p>
					</div>


                   
			<?php   include("footer.php")?>
               
                </div>