<?php
$eltp_status_topic = isset($_GET['eltp_status_topic']) ? $_GET['eltp_status_topic'] :NULL; 
?>


   <form method="get" autocomplete="off" onchange="submit();">
   <input type="hidden"  name="zone"  value="<?=$zone?>" >

 <div class="row">

 <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">
                      <!-- ส่วนการประเมิน -->
                        <?=$auth_user->mf("NYB10XVCMYCEB27SUG3",$country_idx);?>
                      </h4>
 
                        <div class="form-group">
                        <!-- <label>ส่วนการประเมิน</label> -->
                        <select name="eltp_status_topic" id="eltp_status_topic"  class="form-control">
                        <option value="0" <?php if($eltp_status_topic=='0'){echo "SELECTED";} ?>>----</option>
                        <option value="1" <?php if($eltp_status_topic=='1'){echo "SELECTED";} ?>><?=$auth_user->mf("XSBMHS8Q0OJOT7VRTLNA",$country_idx);?></option>
                        <option value="2" <?php if($eltp_status_topic=='2'){echo "SELECTED";} ?>><?=$ctgm_name_main_x?></option>
                        <option value="3" <?php if($eltp_status_topic=='3'){echo "SELECTED";} ?>><?=$ctgs_name_main_x?></option>
                        <option value="4" <?php if($eltp_status_topic=='4'){echo "SELECTED";} ?>><?=$auth_user->mf("82BS90L39GV79H0CHXJ",$country_idx);?></option>
                        </select>    
                        </div>
                    </div>
                  </div>
                </div>          
        </div>
        </form>

    <?php  if(!isset($_GET["eltp_status_topic"])){
          echo NULL;
        
           }else{
         switch(strip_tags($_GET["eltp_status_topic"])) {
        case "1" : include ("page_7_reportCompany.php");
        break;
        case "2" : include ("page_7_reportCategoryMain.php");
        break;
        case "3" : include ("page_7_reportCategorySub.php");
        break;
        case "4" : include ("page_7_reportPersonal.php");
        break;
        // default :  include ("page_1.php");
         }
     }
        ?>