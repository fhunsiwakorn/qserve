<?php
if(isset($_GET['DELPersonal'])) {
  $user_code = $_GET['DELPersonal'];
  $Del_1= $sql_process->fastQuery("UPDATE  tbl_user SET is_delete='0'   WHERE user_code='$user_code'");
    echo "<script>";
    echo "location.href = '?zone=Personal&success'";
    echo "</script>";
  }
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
$q=trim($q);

$t1=$auth_user->mf("BZGTYZ2FJPVT4EXN42",$country_idx);
$t2=$auth_user->mf("45P3W32QRK9PLR67TQC",$country_idx);

$f1=$auth_user->mf("4U9N0HPRKM852Y9B5II",$country_idx);
$f2=$auth_user->mf("2UNYAQB1Q9W3FENTR11",$country_idx);
$f3=$auth_user->mf("8K5I8PYX4GYZRH172V46",$country_idx);
$f4=$auth_user->mf("JVB8N1P7S5FGQNTK9ME",$country_idx);
$f5=$auth_user->mf("2CDRDYXKYFKBVUSJZUZ",$country_idx);
$f6=$auth_user->mf("M5QUYH4ACMGV6FOVP2CS",$country_idx);
$f7=$auth_user->mf("2GGETH683C8MNNCCZX05",$country_idx);

?>
<?php if(isset($_GET['success'])){ ?>
<script>
swal("<?=$g3?> !", "<?=$g4?> !", "success")
</script>
<?php } ?>

<?php if(isset($_GET['error'])){ ?>
<script>
swal("<?=$auth_user->mf("232SOA36V6QMWZ073O2E",$country_idx)?> !", "<?=$g4?> !", "success")
</script>
<?php } ?>
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">
                        <!-- บุคลากร/เจ้าหน้าที่ -->
                        <?=$auth_user->mf("82BS90L39GV79H0CHXJ",$country_idx)?>
                        <div align="right"> <button type="button" onclick="window.location.href='?zone=PersonalForm'"class="btn btn-success mr-2">
                        <!-- เพิ่มข้อมูล -->
                        <?=$auth_user->mf("7NFFJ34RJ2K9TQKMYYR8",$country_idx)?>
                      </button></div>

                      </h4>
                     

 
                      <div class="form-group">
  <form action="#" method="get"name="form1" class="sidebar-form" autocomplete="off">
      <input type="hidden" name="zone"  value="<?=$zone?>">
        <div class="input-group">
          <input type="text" name="q" id="q" class="form-control" placeholder="<?=$g5?>..." value="<?=$q?>" >
          <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat"><?=$g5?></i>
                </button>
              </span>
        </div>
      
      </form>   
      </div>   
        
 <div  style="width: 100%;overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">

                      <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
     
      
        <th>#</th>
        <th><?=$t1?></th>
        <th><?=$ctgm_name_main_x?></th>
        <th><?=$ctgs_name_main_x?></th>
        <th><?=$t2?></th>
      </tr>
      </thead>
      <tbody>
<?php


if($q != NULL ){
  $stateSQL="AND (tbl_user.user_firstname LIKE '%$q%' OR tbl_user.user_lastname LIKE '%$q%'
   OR tbl_category_main.ctgm_name LIKE '%$q%'
   OR tbl_category_sub.ctgs_name LIKE '%$q%')";
}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT 
tbl_user.user_code
 FROM 
tbl_user ,
tbl_user_detail ,
tbl_category_main ,
tbl_category_sub
  WHERE
tbl_user.is_delete = '1' AND
tbl_user.user_status = '3' AND
tbl_user.user_code = tbl_user_detail.user_code AND
tbl_user_detail.ctgm_code = tbl_category_main.ctgm_code AND
tbl_user_detail.ctgs_code = tbl_category_sub.ctgs_code AND
tbl_user_detail.cmn_code='$cmn_codex'
 $stateSQL");
 
$rows='5';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);
$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_user.user_prefix,
tbl_user.user_firstname,
tbl_user.user_lastname,
tbl_user.user_password,
tbl_user.user_password_shows,
tbl_user.user_name,
tbl_user.user_email,
tbl_user.user_img,
tbl_user.user_code,
tbl_user_detail.ctgm_code,
tbl_user_detail.ctgs_code,
tbl_category_main.ctgm_name ,
tbl_category_sub.ctgs_name
FROM
tbl_user ,
tbl_user_detail ,
tbl_category_main ,
tbl_category_sub
WHERE
tbl_user.user_code = tbl_user_detail.user_code AND
tbl_user_detail.ctgm_code = tbl_category_main.ctgm_code AND
tbl_user_detail.ctgs_code = tbl_category_sub.ctgs_code AND
tbl_user.is_delete = '1' AND
tbl_user_detail.cmn_code =:cmn_code_param AND
tbl_user.user_status = '3'
$stateSQL
ORDER BY
tbl_user.user_id DESC
limit $start,$rows
");
$qg->execute(array(":cmn_code_param"=>$cmn_codex));
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;

if(!empty($rowData->user_img)){
  $pathimg="../images/images_user/".$rowData->user_img;
}else{
  $pathimg="../images/images_web/default-user.png";
}

// $ctgm_name = $sql_process->lookupfild("ctgm_name","tbl_category_main","ctgm_code",$rowData->ctgm_code);
// $ctgs_name = $sql_process->lookupfild("ctgs_name","tbl_category_sub","ctgs_code",$rowData->ctgs_code);

$strFileName=base64_encode_image($pathimg);
?>
      <tr>

        <td><img style="display: block; margin: auto;height:75px; width:75px;" src="<?=$strFileName?>" class="circle" /></td>
        <td><?=$rowData->user_prefix?> <?=$rowData->user_firstname?> <?=$rowData->user_lastname?></td>
        <td><?=$rowData->ctgm_name?></td>
        <td><?=$rowData->ctgs_name?></td>
        <td align="center">
        <button type="button" onclick="window.location.href='?zone=PersonalEdit&uc=<?=$rowData->user_code?>'"  class="btn btn-info mr-2"><?=$f1?></button>
  <button type="button" onclick="move<?=$rowData->user_code?>();" class="btn btn-danger mr-2"><?=$f2?></button>


  <script>
                        function move<?=$rowData->user_code?>() {
                          swal({
                            title: "<?=$f2?> <?=$rowData->user_firstname?> <?=$rowData->user_lastname?>",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "<?=$f3?>",
                            cancelButtonText: "<?=$f4?>",
                            closeOnConfirm: false,
                            closeOnCancel: false
                          },
                          function(isConfirm){
                            if (isConfirm) {
                              swal("<?=$f5?>", "<?=$f6?>", "success");
                            location.href = '?zone=<?=$zone?>&DELPersonal=<?=$rowData->user_code?>';
                            } else {
                              swal("<?=$f7?>", "<?=$f6?>", "error");
                            }
                          });
                        }
               </script>
        </td>
      </tr>

   

<?php } ?>
      </tbody>
      <tfoot>
      <tr>

      <th>#</th>
      <th><?=$t1?></th>
        <th><?=$ctgm_name_main_x?></th>
        <th><?=$ctgs_name_main_x?></th>
        <th><?=$t2?></th>
      </tr>
      </tfoot>
    </table>  
       
    </div>               

    <?php  require("paging.php"); ?>


                    </div>
                  </div>
              