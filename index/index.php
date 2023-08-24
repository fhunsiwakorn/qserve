<?php

require_once("../config/dbl_config.php");
require_once('../class/class_user.php');
require_once("../login/session.php");
require_once("../class/class_function.php");
require_once('../class/class_query.php');
require_once("../login/select_data_profile.php");
$sql_process = new function_query();
if($_SESSION['user_status']!='2' && $_SESSION['user_status']!=NULL){
  echo "<script>";
  echo "location.href = '../login/logout.php?logout=true'";
  echo "</script>";
}
 
$zone = isset($_GET['zone']) ? $_GET['zone'] : NULL;
require_once('select_general_data.php');

$flag_user=$sql_process->lookupfild("country_flag","tbl_master_country","country_id",$country_idx);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?=$name_system?></title>
  <link rel="icon" type="image/png" href="<?=base64_encode_image("../images/images_web/105719.jpg")?>"/>


   <!-- plugins:css -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?=base64_encode_css("../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/vendors/css/vendor.bundle.base.css")?>">
  <link rel="stylesheet" href="<?=base64_encode_css("../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/vendors/css/vendor.bundle.addons.css")?>">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->

  <link rel="stylesheet" href="<?=base64_encode_css("../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/css/style.css")?>">
  <!-- endinject -->

  

<script src="<?=base64_encode_jspath("../plugins/sweetalert_master/sweetalert.min.js")?>"></script>
<link rel="stylesheet" type="text/css" href="<?=base64_encode_css("../plugins/sweetalert_master/sweetalert.css")?>">

<link href="<?=base64_encode_css("../plugins/pictureframe/crop_img.css")?>" rel="stylesheet">

<link rel="stylesheet" href="<?=base64_encode_css("../plugins/lightbox2-master/dist/css/lightbox.min.css")?>">
  
 
<!-- select2 -->
 <link href="<?=base64_encode_css("../plugins/select2-bootstrap4-theme-master/libs/select2.min.css")?>" rel="stylesheet" />
 <!-- select2-bootstrap4-theme -->
 <link href="<?=base64_encode_css("../plugins/select2-bootstrap4-theme-master/dist/select2-bootstrap4.min.css")?>" rel="stylesheet"> 
  <link href="<?=base64_encode_css("../plugins/select2-bootstrap4-theme-master/dist/select2-bootstrap4.css")?>" rel="stylesheet"> 
  <link rel="stylesheet" href="<?=base64_encode_css("../plugins/image_circle.css")?>">
 

 <script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
 <script type="text/javascript" src="<?=base64_encode_css("../plugins/SortTable-master/sort-table.js")?>"></script>

</head>


<body >
  <div class="container-scroller">

    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
        <a class="navbar-brand brand-logo" href="?zone=main">
          <img src="<?=$strFileImgCompany?>" alt="logo" style="height:70px; width:300px;"/>
     
        </a>
        <a class="navbar-brand brand-logo-mini" href="?zone=main">
          <font color="blue">
         .....
          </font>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center">
        <ul class="navbar-nav navbar-nav-left header-links d-none d-md-flex">
       
          <li class="nav-item">
            <button type="button"  onclick="window.location.href='?zone=Report'" class="btn btn-warning btn-lg"><i class="mdi mdi-elevation-rise"></i>
              <!-- รายงาน -->
              <?=$auth_user->mf("AA0I1POYCDIPWL5PVSU",$country_idx)?>
            </button>
          </li> 
          &nbsp;&nbsp;
          <li class="nav-item"> 
          <button type="button"  onclick="window.location.href='?zone=EvaluationHistory'" class="btn btn-danger btn-lg"> <i class="mdi mdi-heart"></i> 
          <!-- ประวัติการประเมิน -->
          <?=$auth_user->mf("YIGVXMUW7S4CHJY0DMOT",$country_idx)?>
        </button>
        
             
          </li>
         
        </ul>
        <ul class="navbar-nav navbar-nav-right">  
          
        
    
        <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <!-- <i class="mdi mdi-file-document-box"></i> -->
              <img src="<?=base64_encode_image("../images/images_flag/$flag_user")?>" alt="flag" class="profile-pic" style="display: block; margin: auto;height:35px; width:40px;"  > 

              <!-- <span class="count">7</span> -->
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <div class="dropdown-item">
                <p class="mb-0 font-weight-normal float-left">Choose language
                </p>
                <!-- <span class="badge badge-info badge-pill float-right">View all</span> -->
              </div>
              <div class="dropdown-divider"></div>
              
              <?php
$qgl = $sql_process->runQuery(
"SELECT
tbl_master_country.country_name,
tbl_master_country.country_flag,
tbl_master_country.country_id
FROM
tbl_master_country ,
tbl_system_language
WHERE 
tbl_master_country.country_id = tbl_system_language.country_id  AND
tbl_master_country.is_delete='1'  AND
tbl_master_country.country_status='1' 
GROUP BY
tbl_system_language.country_id
ORDER BY
tbl_master_country.country_id ASC

");
$qgl->execute();
while($lanData= $qgl->fetch(PDO::FETCH_OBJ)) {
  $path_flag=base64_encode_image("../images/images_flag/$lanData->country_flag")
?>

              <a class="dropdown-item preview-item" href="set_language.php?setlanguage=<?=$lanData->country_id?>&user_code=<?=$profileRow["user_code"]?>">
                <div class="preview-thumbnail">
                  <img src="<?=$path_flag?>" alt="flag" class="profile-pic">
                </div>
                <div class="preview-item-content flex-grow">
                  <h6 class="preview-subject ellipsis font-weight-medium text-dark"><?=$lanData->country_name?></h6>
                
                </div>
              </a>
              <div class="dropdown-divider"></div>

<?php } ?>
             
             
            </div>
          </li>


          <li class="nav-item dropdown d-none d-xl-inline-block">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <span class="profile-text"><?=$profileRow['user_firstname']?> <?=$profileRow['user_lastname']?></span>
              <img class="img-xs rounded-circle" src="<?=$strFileImgUser?>" alt="Profile image">
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <a class="dropdown-item p-0">
                <div class="d-flex border-bottom">
                  <!-- <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                  </div>
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                    <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                  </div> -->
                  <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                    <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                  </div>
                </div>
                
              </a>
              <!-- <a class="dropdown-item mt-2">
                Manage Accounts
              </a>
              <a class="dropdown-item">
                Change Password
              </a>
              <a class="dropdown-item">
                Check Inbox
              </a> -->
              <a href="../login/logout.php?logout=true" class="dropdown-item">
                <!-- ออกจากระบบ -->
                <?=$auth_user->mf("E9P2CWAOBGD39Y4RF53L",$country_idx)?>
              </a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <div class="nav-link">
              <div class="user-wrapper">
                <div class="profile-image">
                  <img src="<?=$strFileImgUser?>" alt="profile image">
                </div>
                <div class="text-wrapper">
                  <p class="profile-name"><?=$profileRow['user_firstname']?> <?=$profileRow['user_lastname']?></p>
                  <div>
                    <small class="designation text-muted">
                      <!-- ผู้ดูแลระบบ -->
                      <?=$auth_user->mf("UIX6Z4DFL9CANJZIQF",$country_idx)?>
                    </small>
                    <span class="status-indicator online"></span>
                  </div>
                </div>
              </div>
              <button class="btn btn-success btn-block" onclick="window.location.href='?zone=EvaluationForm1'">
              <!-- สร้างแบบประเมิน  -->
            <?=$auth_user->mf("GFBYIE1K2D2W6AWAGXJX",$country_idx)?>
                <i class="mdi mdi-plus"></i>
              </button>
            </div>
          </li>

          <?php require_once("menu.php");?>


        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
     
        <?php require_once("get_page.php");?>
    
        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <footer class="footer">
          <div class="container-fluid clearfix">
            <!-- <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
              Copyright © 2018
              <a href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span> -->
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
            <?=$name_system?> : <?=$cmn_namex?>
            <p><?=$version?></p>
            </span>
          </div>
        </footer>
        
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->



  <!-- plugins:js -->
  <script src="<?=base64_encode_jspath("../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/vendors/js/vendor.bundle.base.js")?>"></script>

  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="<?=base64_encode_jspath("../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/js/off-canvas.js")?>"></script>
  <script src="<?=base64_encode_jspath("../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/js/misc.js")?>"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="<?=base64_encode_jspath("../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/js/dashboard.js")?>"></script>
  <!-- End custom js for this page-->
  <script src="<?=base64_encode_jspath("../plugins/lightbox2-master/dist/js/lightbox-plus-jquery.min.js")?>"></script>

  <!-- bootstrap -->
  <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
<!-- select2 -->
<script src="<?=base64_encode_jspath("../plugins/select2-bootstrap4-theme-master/libs/select2.min.js")?>"></script>
  <!-- select2-bootstrap4-theme -->
<script src="<?=base64_encode_jspath("../plugins/select2-bootstrap4-theme-master/docs/script.js")?>"></script>


</body>

</html>