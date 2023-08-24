<?php
require_once("../config/dbl_config.php");
require_once('../class/class_query.php');
require_once("../class/class_function.php");
$sql_process = new function_query();

$table="tbl_category_main";
if(isset($_POST['btn-submit-add']))
{  
    $ctgm_code = random_password(20);
    $ctgm_name = strip_tags($_POST['ctgm_name']);
    $ctgm_description = isset($_POST['ctgm_description']) ? $_POST['ctgm_description'] : FALSE;
    $ctgm_status = strip_tags($_POST['ctgm_status']);
    $crt_by= strip_tags($_POST['crt_by']);
    $cmn_code= strip_tags($_POST['cmn_code']);
    $crt_date=date("Y-m-d H:i:s");

    if(!empty($_FILES['imageupload']['name'])){
      $count2=count($_FILES['imageupload']['name']);
      if($count2 <=5){
        for($i2=0;$i2<$count2;$i2++){
        $imgsize = $_FILES['imageupload']['size'][$i2];
        if($imgsize >0){
        $newimage=add_images($_FILES['imageupload']['tmp_name'][$i2],$_FILES['imageupload']['name'][$i2],"../images/images_catagory/");
        $sql_process->fastQuery("INSERT INTO tbl_category_img (cgimg_name,cgimg_code) VALUES('$newimage','$ctgm_code')");
        }
        }
      }
    }

  $fields = [
    'ctgm_code' => $ctgm_code,
    'ctgm_name' => $ctgm_name,
    'ctgm_description' => $ctgm_description,
    'ctgm_status' => $ctgm_status,
    'crt_by' => $crt_by,
    'crt_date' => $crt_date,
    'upd_by' => $crt_by,
    'cmn_code' => $cmn_code
];

try {

    /*
     * Have used the word 'object' as I could not see the actual 
     * class name.
     */
    $sql_process->insert($table, $fields);
  
   
  }catch(ErrorException $exception) {
  
     $exception->getMessage();  // Should be handled with a proper error message.
  
  }

  echo "<script>";
  echo "location.href = '$actual_link_site/index/?zone=CategoryMain&success'";
  echo "</script>";
}



if(isset($_POST['btn-submit-edit']))
{ 
  $ctgm_code =strip_tags($_POST['ctgm_code']);
  $ctgm_name = strip_tags($_POST['ctgm_name']);
  $ctgm_description = isset($_POST['ctgm_description']) ? $_POST['ctgm_description'] : FALSE;
  $ctgm_status = strip_tags($_POST['ctgm_status']);
    $upd_by= strip_tags($_POST['upd_by']);
    if(!empty($_FILES['imageupload']['name'])){
      $count2=count($_FILES['imageupload']['name']);
      if($count2 <=5){
        for($i2=0;$i2<$count2;$i2++){
        $imgsize = $_FILES['imageupload']['size'][$i2];
        if($imgsize >0){
        $newimage=add_images($_FILES['imageupload']['tmp_name'][$i2],$_FILES['imageupload']['name'][$i2],"../images/images_catagory/");
        $sql_process->fastQuery("INSERT INTO tbl_category_img (cgimg_name,cgimg_code) VALUES('$newimage','$ctgm_code')");
        }
        }
    }
    
    }
    $fields = [
      'ctgm_name' => $ctgm_name,
      'ctgm_description' => $ctgm_description,
      'ctgm_status' => $ctgm_status,
      'upd_by' => $upd_by
    ];
    $Where=['ctgm_code' => $ctgm_code];
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
    echo "location.href = '$actual_link_site/index/?zone=CategoryMain&success'";
    echo "</script>";
}