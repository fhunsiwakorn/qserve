

				<div class="login100-form validate-form"  style="width:100%;" >

					<!-- <span class="login100-form-title">
                    <?=$dataRow["eltp_name"]?> <br>
                    </span> -->

			

					<div class="container-login100-form-btn">
                        <?php
                        echo "<center>";
                        echo "<h3>";
                        echo $dataRow["cmn_name"];
                        echo "<br>";
                        echo $sql_process->lookupfild("eltp_remark","tbl_evaluation_topic","eltp_code","$eltp_code_get"); 
                        echo "</h3>";
                        echo "</center>";
                        echo "<meta http-equiv='refresh' content='10;URL=?eltp=$eltp_code_get'>";
                        ?>
					</div>


                   
			<?php   include("footer.php")?>
               
                </div>