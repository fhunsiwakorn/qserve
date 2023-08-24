<?php
     $auth_user = new USER();
     $user_id = $_SESSION['userSession'];
     $user_status=$_SESSION['user_status'];
    //  setcookie($user_id, $user_status, time() + (86400 * 30), "/"); // 86400 = 1 day
//   if(!isset($user_id)) {
//       echo "Cookie named '" . $cookie_name . "' is not set!";
//  } else {
//       echo "Cookie '" . $cookie_name . "' is set!<br>";
//       echo "Value is: " . $_COOKIE[$cookie_name];
//  }

     if($user_status=='1'){
        
         $user_profile = $auth_user->runQuery("SELECT
         tbl_user.user_name,
         tbl_user.user_password_shows,
         tbl_user.user_prefix,
         tbl_user.user_firstname,
         tbl_user.user_lastname,
         tbl_user.user_img
         FROM
         tbl_user
         WHERE
         tbl_user.user_id=:user_id_param
         ");
         $user_profile->execute(array(":user_id_param"=>$user_id));
         $profileRow=$user_profile->fetch(PDO::FETCH_ASSOC);
          //User Image
          if(!empty($profileRow["user_img"])){
            $pathuserimg="../images/images_user/".$profileRow["user_img"];
          }else{
            $pathuserimg="../images/images_web/default-user.png";
          }
       
    }elseif($user_status=='2'){
        
      $user_profile = $auth_user->runQuery("SELECT
      tbl_user.user_id,
      tbl_user.user_name,
      tbl_user.user_password,
      tbl_user.user_password_shows,
      tbl_user.user_firstname,
      tbl_user.user_lastname,
      tbl_user.user_email,
      tbl_company.cmn_name,
      tbl_company.cmn_code,
      tbl_company.cmn_logo,
      tbl_company.cmn_name_main,
      tbl_company.cmn_name_sub,
      tbl_user.user_img,
      tbl_user.user_code,
      tbl_user_detail.country_id
      FROM
      tbl_user ,
      tbl_user_detail ,
      tbl_company
      WHERE
      tbl_user.user_code = tbl_user_detail.user_code AND
      tbl_user_detail.cmn_code = tbl_company.cmn_code AND
      tbl_user.user_id =:user_id_param");
      $user_profile->execute(array(":user_id_param"=>$user_id));
      $profileRow=$user_profile->fetch(PDO::FETCH_ASSOC);
       //User Image
       if(!empty($profileRow["user_img"])){
         $pathuserimg="../images/images_user/".$profileRow["user_img"];
       }else{
         $pathuserimg="../images/images_web/user.png";
       }
        //Company Image
        if(!empty($profileRow["cmn_logo"])){
          $pathcompanyimg="../images/images_company/".$profileRow["cmn_logo"];
        }else{
          $pathcompanyimg="../images/images_web/no-logo.png";
        }
       $strFileImgUser=base64_encode_image($pathuserimg);
       $strFileImgCompany=base64_encode_image($pathcompanyimg);
    // echo $user_id;
    $cmn_namex=$profileRow["cmn_name"];
    $cmn_codex=$profileRow["cmn_code"];
    $cmn_logox=$profileRow["cmn_logo"];
    $country_idx=$profileRow["country_id"];

 }
?>