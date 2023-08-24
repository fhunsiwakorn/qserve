
<?php
//get the q parameter from URL
///ตัวแปรที่รับมา
$eltp_code_get=isset($_GET['eltp']) ? $_GET['eltp'] : NULL;  /////โค้ดหัวข้อแบบประเมิน	
$cmn_code = isset($_GET['cmn_code']) ? $_GET['cmn_code'] : NULL;
$country_id = isset($_GET['country_id']) ? $_GET['country_id'] : NULL;

$q = urldecode($_GET["q"]);
header("Content-type:text/html; charset=UTF-8");        
header("Cache-Control: no-store, no-cache, must-revalidate");       
header("Cache-Control: post-check=0, pre-check=0", false);      
 mb_internal_encoding('UTF-8');
 mb_http_output('UTF-8');
 mb_http_input('UTF-8');
 mb_language('uni');
 mb_regex_encoding('UTF-8');
 ob_start('mb_output_handler');
 setlocale(LC_ALL, 'th_TH');

require_once("../config/dbl_config.php");
require_once("../class/class_function.php");
require_once('../class/class_query.php');

$date_current=date("Y-m-d");

$ipaddress = $_SERVER['REMOTE_ADDR']; //Get user IP 
$useragent=$_SERVER['HTTP_USER_AGENT']; //อุปกรณ์
$sql_process = new function_query();

require_once('../class/class_user.php');
$auth_user = new USER();

//ทำการประเมิน
$txt1=$auth_user->mf("F1THDXB73PEF3P8KJKGE",$country_id);
// คุณเคยทำแบบประเมินนี้แล้ว
$txt2=$auth_user->mf("DRUXJ6B9R7A7O5MQ28",$country_id);
?>
  <table style="text-align: left; width: 100%;" border="0"
 cellpadding="1" cellspacing="1">

                      <tbody>
                          
<?php
$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_evaluation_permission.eltp_code,
tbl_evaluation_permission.evltp_code,
tbl_category_sub.ctgs_name,
tbl_category_main.ctgm_name,
tbl_category_sub.ctgs_code
FROM
tbl_evaluation_permission ,
tbl_category_main,
tbl_category_sub
WHERE
tbl_category_sub.ctgm_code = tbl_category_main.ctgm_code AND
tbl_evaluation_permission.evltp_code = tbl_category_sub.ctgs_code AND
tbl_evaluation_permission.eltp_code=:eltp_code_param AND
tbl_evaluation_permission.cmn_code=:cmn_code_param  AND
tbl_category_sub.is_delete = '1' AND
tbl_category_sub.ctgs_status = '1'   AND
LOCATE('$q', tbl_category_sub.ctgs_name) > 0
ORDER BY
tbl_evaluation_permission.evltp_id DESC
limit 0,20
");
$qg->execute(array(":eltp_code_param"=>$eltp_code_get,":cmn_code_param"=>$cmn_code));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;
$Chek_resultA =$sql_process->rowsQuery("SELECT evltr_id FROM tbl_evaluation_result WHERE cmn_code='$cmn_code' AND eltp_code='$eltp_code_get' AND evltp_code='$rowData->ctgs_code' AND  evltp_user_agent='$useragent' AND DATE(evltp_date)='$date_current' ");
$cgimg_name= $sql_process->QueryField1("tbl_category_img","cgimg_name","cgimg_code='$rowData->ctgs_code'");
if(!empty($cgimg_name)){
    $pathuserimg1="../images/images_catagory/".$cgimg_name;
  }else{
    $pathuserimg1="../images/images_web/1547020644No_Image_Available.jpg";
  }
//   $pathuserimg1="../images/images_web/user.png";
//   $strFileImg1=base64_encode_image($pathuserimg1);
?>

                        <tr>
                      
                          <td>
                          <a class="thumbnail" href="<?=$pathuserimg1?>" data-lightbox="example-set-user" data-title="<?=$rowData->ctgs_name?>">
                        <div class="gallery">
                        <img src="<?=$pathuserimg1?>" alt="<?=$rowData->ctgs_name?>" class="circle" style="display: block; margin: auto;height:65px; width:65px;" />
                        </div>
                        </a>
                          </td>
                          <td><?=$rowData->ctgs_name?></td>
                          <td>  
                          <button type="button" onclick="window.location.href='?eltp=<?=$eltp_code_get?>&evltp=<?=$rowData->ctgs_code?>'" class="btn btn-success" >
                          <!-- ประเมิน -->
                          <?=$txt1?>
                        </button> 
                        <br>
                        <?php 
                            if($Chek_resultA >0){
                              // echo "<font size='-1' color='red'>คุณเคยทำแบบประเมินนี้แล้ว..</font>";
                              echo "<font size='-1' color='red'>$txt2</font>";
                            }
                            ?>
                        </td>   
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>