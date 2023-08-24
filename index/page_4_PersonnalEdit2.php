<?php
$cmn_code = strip_tags($_GET['cmn_code']);
$user_code = strip_tags($_GET['user_code']);
require_once("../config/dbl_config.php");
require_once('../class/class_query.php');
$sql_process = new function_query();

$ctgm_name_main_x = $sql_process->lookupfild("cmn_name_main", "tbl_company", "cmn_code", "$cmn_code");
$ctgs_name_main_x = $sql_process->lookupfild("cmn_name_sub", "tbl_company", "cmn_code", "$cmn_code");

$ctgm_code = $sql_process->lookupfild("ctgm_code", "tbl_user_detail", "user_code", "$user_code");
$ctgs_code = $sql_process->lookupfild("ctgs_code", "tbl_user_detail", "user_code", "$user_code");

if (isset($_POST["ctgm_code"])  && isset($_POST["ctgs_code"])) {
  $user_code_1 = strip_tags($_POST['user_code']);
  $ctgm_code_1 = strip_tags($_POST['ctgm_code']);
  $ctgs_code_1 = strip_tags($_POST['ctgs_code']);

  $sql_process->fastQuery("UPDATE tbl_user_detail SET ctgm_code='$ctgm_code_1' ,ctgs_code='$ctgs_code_1'  WHERE user_code='$user_code_1'");
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
<html lang="en">

<head>
  <!-- plugins:css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/vendors/css/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->

  <link rel="stylesheet" href="../plugins/StarAdmin-Free-Bootstrap-Admin-Template-master/css/style.css">
  <!-- endinject -->
</head>

<body>

  <form method="post">
    <input type="hidden" name="user_code" value="<?= $user_code ?>" />
    <div class="form-group">
      <label><?= $ctgm_name_main_x ?></label> <label style="color:red;">*</label>
      <select class="form-control" required name="ctgm_code" onchange="this.form.submit()">
        <option value="">---</option>

        <?php
        $stm = $sql_process->runQuery(
          "SELECT
                     ctgm_code,
                     ctgm_name
                     FROM
                     tbl_category_main 
                     WHERE 
                     ctgm_status='1' AND
                     is_delete='1' AND
                     cmn_code='$cmn_code'
                     ORDER BY
                     ctgm_name"
        );
        $stm->execute();
        while ($rs = $stm->fetch(PDO::FETCH_OBJ)) {
          echo "<option value='$rs->ctgm_code'";
          if ($ctgm_code == $rs->ctgm_code) {
            echo "SELECTED";
          }
          echo ">$rs->ctgm_name</option>\n";
        }

        ?>
      </select>
    </div>
    <div class="form-group">
      <label><?= $ctgs_name_main_x ?></label> <label style="color:red;">*</label>

      <select class="form-control" required name="ctgs_code" onchange="this.form.submit()">
        <option value="">---</option>
        <?php
        $stm = $sql_process->runQuery(
          "SELECT
                     ctgs_code,
                     ctgs_name
                     FROM
                     tbl_category_sub 
                     WHERE 
                     ctgs_status='1' AND
                     is_delete='1' AND
                     ctgm_code= '$ctgm_code'   AND
                     cmn_code='$cmn_code'
                     GROUP BY
                     ctgs_code
                     ORDER BY
                     ctgs_name"
        );
        $stm->execute();
        while ($rs = $stm->fetch(PDO::FETCH_OBJ)) {
          echo "<option value='$rs->ctgs_code'";
          if ($ctgs_code == $rs->ctgs_code) {
            echo "SELECTED";
          }
          echo ">$rs->ctgs_name</option>\n";
        }

        ?>
      </select>

    </div>
  </form>


</body>




</html>