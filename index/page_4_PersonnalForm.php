<?php
$prefix = $auth_user->mf("382FT1K988YSM4AF2DGJ", $country_idx);
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
                    req.open("GET", "../library/categoryFillter.php?cmn_codeE=<?= $cmn_codex ?>&data=" + src + "&val=" + val); //สร้าง connection
                    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8"); // set Header
                    req.send(null); //ส่งค่า
               }

               window.onLoad = dochange('ctgm_code', -1);
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
               <input type="hidden" class="form-control" name="cmn_code" id="cmn_code" required value="<?= $cmn_codex ?>">
               <h4 class="card-title">
                    <!-- แบบฟอร์ม -->
                    <?= $auth_user->mf("QSSSELDILR7KC8J5DKM", $country_idx) ?>
               </h4>

               <div class="form-group">

                    <input type="file" name="imageupload" id="imageupload" onchange="readURL(this);" style="display:none">
                    <img src="<?php echo base64_encode_image("../images/images_web/default-avatarv9899025.gif"); ?>" alt="<?= $auth_user->mf("XCYYNM6759UE95TLXG3K", $country_idx) ?>" id="blah" width="256" height="256" />
               </div>
               <div class="form-group">
                    <button type="button" class="btn btn-success btn-fw" name="uploadbutton" onclick="imageupload.click()">
                         <i class="mdi mdi-folder-upload"></i>
                         <!-- อัพโหลดรูป -->
                         <?= $auth_user->mf("5NJRBSNPEG0WCJHYQKI", $country_idx) ?>
                    </button>
               </div>
               <input type="hidden" class="form-control" name="user_name" id="user_name" required value="<?= random_password(6) ?>">
               <input type="hidden" class="form-control" name="user_password" id="user_password" required value="<?= random_password(6) ?>">

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
                              echo "<option value='$rowA->title_name'>$rowA->title_name</option>";
                         }
                         ?>

                    </select>
               </div>
               <div class="form-group">
                    <label>
                         <!-- ชื่อ -->
                         <?= $auth_user->mf("4E6P6I7TFWPKUT2IHL80", $country_idx) ?>
                    </label>
                    <input type="text" class="form-control" name="user_firstname" id="user_firstname" required>
               </div>

               <div class="form-group">
                    <label>
                         <!-- นามสกุล -->
                         <?= $auth_user->mf("T87AB4ZTZXPR21E8D422", $country_idx) ?>
                    </label>
                    <input type="text" class="form-control" name="user_lastname" id="user_lastname" required>
               </div>

               <div class="form-group">
                    <label>
                         <!-- อีเมล -->
                         <?= $auth_user->mf("5FUF9OWQXK7GSBOFK51Z", $country_idx) ?>
                    </label>
                    <input type="text" class="form-control" name="user_email" id="user_email">
               </div>
               <div class="form-group">
                    <label><?= $ctgm_name_main_x ?></label> <label style="color:red;">*</label>
                    <span id="ctgm_code">
                         <select class="form-control" required>
                              <option value="">---</option>
                         </select>
                    </span>
               </div>
               <div class="form-group">
                    <label><?= $ctgs_name_main_x ?></label> <label style="color:red;">*</label>
                    <span id="ctgs_code">
                         <select class="form-control" required>
                              <option value="">---</option>
                         </select>
                    </span>
               </div>





               <div class="form-group">
                    <center>
                         <button type="submit" class="btn btn-success mr-2" name="btn-submit-add"> <?= $auth_user->mf("N7DNEI0JTJFKRRAT5F9", $country_idx) ?></button>
                    </center>
               </div>
          </form>




     </div>
</div>