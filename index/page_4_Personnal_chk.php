<?php
require_once("../config/dbl_config.php");
require_once('../class/class_query.php');
require_once("../class/class_function.php");
$sql_process = new function_query();
$table="tbl_user";
$table1="tbl_user_detail";
if(isset($_POST['btn-submit-add']))
{  

    $user_name = strip_tags($_POST['user_name']);
    $user_password = strip_tags($_POST['user_password']);
    // $user_prefix = strip_tags($_POST['user_prefix']);
    $user_prefix = isset($_POST['user_prefix']) ? $_POST['user_prefix'] : FALSE;
    $user_firstname = strip_tags($_POST['user_firstname']);
    $user_lastname = strip_tags($_POST['user_lastname']);
    $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : FALSE;
    $user_code=random_password(20);
    $cmn_code = strip_tags($_POST['cmn_code']);
    $ctgm_code = strip_tags($_POST['ctgm_code']);
    $ctgs_code = strip_tags($_POST['ctgs_code']);
    $new_password = password_hash($user_password, PASSWORD_DEFAULT);

    if(isset($_FILES['imageupload']['tmp_name']) && !empty($_FILES['imageupload']['tmp_name']))
    {
    $newimage=add_images($_FILES['imageupload']['tmp_name'],$_FILES['imageupload']['name'],"../images/images_user/");
    ////$del_img_file=delfile($_POST['before_img'],"../images/image_category/");
    }else{
   ////$newimage=$_POST['before_img'];
   $newimage=FALSE;
    }

    $chk_user =$sql_process->rowsQuery("SELECT tbl_user.user_id FROM tbl_user WHERE tbl_user.user_name ='$user_name' ");
 if($chk_user <=0){
    $fields = [
    'user_name' => $user_name,
    'user_password' => $new_password,
    'user_password_shows' => $user_password,
    'user_prefix' => $user_prefix,
    'user_firstname' => $user_firstname,
    'user_lastname' => $user_lastname,
    'user_email' => $user_email,
    'user_img' => $newimage,
    'user_status' => 3,
    'user_code' => $user_code
];
$fields1 = [
    'user_code' => $user_code,
    'cmn_code' => $cmn_code,
    'ctgm_code' => $ctgm_code,
    'ctgs_code' => $ctgs_code
];

try {

    /*
     * Have used the word 'object' as I could not see the actual 
     * class name.
     */
    $sql_process->insert($table, $fields);
    $sql_process->insert($table1, $fields1);
  
  }catch(ErrorException $exception) {
  
     $exception->getMessage();  // Should be handled with a proper error message.
  
  }
  echo "<script>";
  echo "location.href = '$actual_link_site/index/?zone=Personal&success'";
  echo "</script>";
}else{
    echo "<script>";
    echo "location.href = '$actual_link_site/index/?zone=Personal&error'";
    echo "</script>";
}
  
}


if(isset($_POST['btn-submit-edit']))
{ 
  $user_code=strip_tags($_POST['user_code']);
  $user_name = strip_tags($_POST['user_name']);
  $user_password =!empty($_POST['user_password']) ? $_POST['user_password'] : $sql_process->lookupfild("user_password_shows","tbl_user","user_code","$user_code");
  $user_prefix = isset($_POST['user_prefix']) ? $_POST['user_prefix'] : FALSE;
  $user_firstname = strip_tags($_POST['user_firstname']);
  $user_lastname = strip_tags($_POST['user_lastname']);
  $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : FALSE;
  // $ctgm_code = strip_tags($_POST['ctgm_code']);
  // $ctgs_code = strip_tags($_POST['ctgs_code']);
  $new_password = password_hash($user_password, PASSWORD_DEFAULT);

  if(isset($_FILES['imageupload']['tmp_name']) && !empty($_FILES['imageupload']['tmp_name']))
  {
  $newimage=add_images($_FILES['imageupload']['tmp_name'],$_FILES['imageupload']['name'],"../images/images_user/");
 $del_img_file=delfile($_POST['before_img'],"../images/images_user/");
  }else{
 $newimage=$_POST['before_img'];
 ///$newimage=FALSE;
  }
  
  $chk_user =$sql_process->rowsQuery("SELECT tbl_user.user_id FROM tbl_user WHERE tbl_user.user_name ='$user_name' AND user_code!='$user_code'");
  if($chk_user <=0){
  $fields = [
    'user_name' => $user_name,
    'user_password' => $new_password,
    'user_password_shows' => $user_password,
    'user_prefix' => $user_prefix,
    'user_firstname' => $user_firstname,
    'user_lastname' => $user_lastname,
    'user_email' => $user_email,
    'user_img' => $newimage
];

    $Where=['user_code' => $user_code];
    try {
    
      /*
       * Have used the word 'object' as I could not see the actual 
       * class name.
       */
      $sql_process->update($table, $fields,$Where);
 
    
    }catch(ErrorException $exception) {
    
       $exception->getMessage();  // Should be handled with a proper error message.
    
    }
    echo "<script>";
    echo "location.href = '$actual_link_site/index/?zone=Personal&success'";
    echo "</script>";
  }else{
    echo "<script>";
    echo "location.href = '$actual_link_site/index/?zone=Personal&error'";
    echo "</script>";
  }   


}

?>