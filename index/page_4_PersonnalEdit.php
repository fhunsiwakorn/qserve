<?php
$user_code_get = strip_tags($_GET['uc']);
$stmt = $sql_process->runQuery("SELECT
tbl_user.user_prefix,
tbl_user.user_firstname,
tbl_user.user_lastname,
tbl_user.user_password,
tbl_user.user_password_shows,
tbl_user.user_name,
tbl_user.user_email,
tbl_user.user_img,
tbl_user.user_code,
tbl_category_main.ctgm_name,
tbl_category_sub.ctgs_name,
tbl_user_detail.ctgm_code,
tbl_user_detail.ctgs_code
FROM
tbl_user ,
tbl_user_detail ,
tbl_category_main ,
tbl_category_sub
WHERE
tbl_user.user_code = tbl_user_detail.user_code AND
tbl_user.is_delete = '1' AND
tbl_user_detail.ctgm_code = tbl_category_main.ctgm_code AND
tbl_user_detail.ctgs_code = tbl_category_sub.ctgs_code AND
tbl_user.user_code=:user_code_param");
$stmt->execute(array(":user_code_param" => $user_code_get));
$dataRow = $stmt->fetch(PDO::FETCH_ASSOC);


if (!empty($dataRow["user_img"])) {
     $pathimg = "../images/images_user/" . $dataRow["user_img"];
} else {
     $pathimg = "../images/images_web/default-avatarv9899025.gif";
}
// $strFileName='data:image/png;base64,' . base64_encode(file_get_contents($pathimg));
$strFileName = base64_encode_image($pathimg);

$prefix = $auth_user->mf("382FT1K988YSM4AF2DGJ", $country_idx);
$form = $auth_user->mf("QSSSELDILR7KC8J5DKM", $country_idx);
$edit = $auth_user->mf("4U9N0HPRKM852Y9B5II", $country_idx);
?>
<div class="card">
     <div class="card-body">


          <h4 class="card-title">
               <!-- บุคลากร/เจ้าหน้าที่ -->
               <?= $auth_user->mf("82BS90L39GV79H0CHXJ", $country_idx) ?>
          </h4>



          <script language=Javascript>
               function Inint_AJAX() {
                    try {
                         return new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {} //IE
                    try {
                         return new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {} //IE
                    try {
                         return new XMLHttpRequest();
                    } catch (e) {} //Native Javascript
                    alert("XMLHttpRequest not supported");
                    return null;
               };

               function dochange(src, val) {
                    var req = Inint_AJAX();
                    req.onreadystatechange = function() {
                         if (req.readyState == 4) {
                              if (req.status == 200) {
                                   document.getElementById(src).innerHTML = req.responseText; //รับค่ากลับมา
                              }
                         }
                    };
                    req.open("GET", "../library/categoryFillter.php?cmn_codeE=<?= $cmn_codex ?>&ctgm_codeE=<?= $dataRow["ctgm_code"] ?>&ctgs_codeE=<?= $dataRow["ctgs_code"] ?>&data=" + src + "&val=" + val); //สร้าง connection
                    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
                    req.send(null); //ส่งค่า
               }

               window.onLoad = dochange('ctgm_code', -1);
               window.onLoad = dochange('ctgs_code', -1);
          </script>
          <!-- PRIVIEW PICTURE -->
          <script language=Javascript>
               function readURL(input) {
                    if (input.files && input.files[0]) {
                         var reader = new FileReader();

                         reader.onload = function(e) {
                              $('#blah').attr('src', e.target.result);
                         }

                         reader.readAsDataURL(input.files[0]);
                    }
               }
          </script>
          <script>
               //Random password generator- by javascriptkit.com
               //Visit JavaScript Kit (http://javascriptkit.com) for script
               //Credit must stay intact for use

               var keylist = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ123456789" // ตัวอักษรที่จะให้มีอยู่ใน Password
               var temp = ''

               function generatepass(plength) {
                    temp = ''
                    for (i = 0; i < plength; i++)
                         temp += keylist.charAt(Math.floor(Math.random() * keylist.length))
                    return temp
               }

               function populateform(enterlength) {
                    document.frmMain.user_name.value = generatepass(enterlength)
               }

               function populateform2(enterlength) {
                    document.frmMain.user_password.value = generatepass(enterlength)
               }
          </script>

          <form method="post" name="frmMain" id="frmMain" enctype="multipart/form-data" action="page_4_Personnal_chk.php">
               <input type="hidden" name="user_code" id="user_code" value="<?= $user_code_get ?>" />
               <input type="hidden" name="before_img" id="before_img" value="<?= $dataRow["user_img"] ?>" />
               <h4 class="card-title">
                    <!-- แบบฟอร์ม :: แก้ไข -->
                    <?= $form ?> :: <?= $edit ?>
               </h4>


               <div class="form-group">

                    <input type="file" name="imageupload" id="imageupload" onchange="readURL(this);" style="display:none">
                    <img src="<?= $strFileName ?>" alt="<?= $auth_user->mf("XCYYNM6759UE95TLXG3K", $country_idx) ?>" id="blah" width="256" height="256" />
               </div>
               <div class="form-group">
                    <button type="button" class="btn btn-success btn-fw" name="uploadbutton" onclick="imageupload.click()">
                         <i class="mdi mdi-folder-upload"></i>
                         <!-- อัพโหลดรูป -->
                         <?= $auth_user->mf("5NJRBSNPEG0WCJHYQKI", $country_idx) ?>
                    </button>
               </div>

               <input type="hidden" class="form-control" name="user_name" id="user_name" required value="<?= $dataRow["user_name"] ?>">





               <div class="form-group"></div>
               <div class="form-group">
                    <label><?= $prefix ?></label>
                    <select name="user_prefix" id="user_prefix" class="form-control">
                         <option value="">--<?= $prefix ?>--</option>
                         <?php
                         $qa = $sql_process->runQuery(
                              "SELECT
title_name
FROM
tbl_master_titlename
WHERE
title_status='1'AND
is_delete='1'
ORDER BY
tbl_master_titlename.title_id "
                         );
                         $qa->execute();
                         while ($rowA = $qa->fetch(PDO::FETCH_OBJ)) {
                              // echo "<option value='$rowA->title_name'>$rowA->title_name</option>";
                              echo "<option value='$rowA->title_name'";
                              if ($dataRow["user_prefix"] == $rowA->title_name) {
                                   echo "SELECTED";
                              }
                              echo ">$rowA->title_name</option>\n";
                         }
                         ?>

                    </select>
               </div>
               <div class="form-group">
                    <label>
                         <!-- ชื่อ -->
                         <?= $auth_user->mf("4E6P6I7TFWPKUT2IHL80", $country_idx) ?>
                    </label>
                    <input type="text" class="form-control" name="user_firstname" id="user_firstname" required value="<?= $dataRow["user_firstname"] ?>">
               </div>

               <div class="form-group">
                    <label>
                         <!-- นามสกุล -->
                         <?= $auth_user->mf("T87AB4ZTZXPR21E8D422", $country_idx) ?>
                    </label>
                    <input type="text" class="form-control" name="user_lastname" id="user_lastname" required value="<?= $dataRow["user_lastname"] ?>">
               </div>

               <div class="form-group">
                    <label>
                         <!-- อีเมล -->
                         <?= $auth_user->mf("5FUF9OWQXK7GSBOFK51Z", $country_idx) ?>
                    </label>
                    <input type="text" class="form-control" name="user_email" id="user_email" value="<?= $dataRow["user_email"] ?>">
               </div>
               <!-- <div class="form-group">         
                <label><?= $ctgm_name_main_x ?></label> <label style="color:red;">*</label>
                <span id="ctgm_code">
                <select class="form-control" required >
                <option value="" >---</option>
                </select>
                </span>
                </div>
                <div class="form-group">
                <label><?= $ctgs_name_main_x ?></label> <label style="color:red;">*</label>
                <span id="ctgs_code">
                <select class="form-control" required >
                <option value="" >---</option>
                </select>
                </span>
                </div> -->

               <iframe src="page_4_PersonnalEdit2.php?cmn_code=<?= $cmn_codex ?>&user_code=<?= $user_code_get ?>" style="width:100%;height:200px ;  border:thin; background-color:#fff"> </iframe>





               <div class="form-group">
                    <br>

                    <center>
                         <button type="submit" class="btn btn-success mr-2" name="btn-submit-edit"> <?= $auth_user->mf("N7DNEI0JTJFKRRAT5F9", $country_idx) ?></button>
                    </center>
               </div>
          </form>







     </div>
</div>