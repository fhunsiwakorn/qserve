<?php
require_once("../config/dbl_config.php");
require_once('../class/class_query.php');
require_once("../class/class_function.php");
$sql_process = new function_query();

$table="tbl_category_sub";
if(isset($_POST['btn-submit-add']))
{  
    $ctgs_code = random_password(20);
    $ctgs_name = strip_tags($_POST['ctgs_name']);
    $ctgs_description = isset($_POST['ctgs_description']) ? $_POST['ctgs_description'] : FALSE;
    $ctgs_status = strip_tags($_POST['ctgs_status']);
    $ctgm_code = strip_tags($_POST['ctgm_code']);
    $cmn_code = strip_tags($_POST['cmn_code']);
    $crt_by=strip_tags($_POST['crt_by']);
    $crt_date=date("Y-m-d H:i:s");

    if(!empty($_FILES['imageupload']['name'])){
      $count2=count($_FILES['imageupload']['name']);
      if($count2 <=5){
      for($i2=0;$i2<$count2;$i2++){
        $imgsize = $_FILES['imageupload']['size'][$i2];
        if($imgsize >0){
        $newimage=add_images($_FILES['imageupload']['tmp_name'][$i2],$_FILES['imageupload']['name'][$i2],"../images/images_catagory/");
        $sql_process->fastQuery("INSERT INTO tbl_category_img (cgimg_name,cgimg_code) VALUES('$newimage','$ctgs_code')");
        }
    }
}
    }

  $fields = [
    'ctgs_code' => $ctgs_code,
    'ctgs_name' => $ctgs_name,
    'ctgs_description' => $ctgs_description,
    'ctgs_status' => $ctgs_status,
    'crt_by' => $crt_by,
    'crt_date' => $crt_date,
    'upd_by' => $crt_by,
    'ctgm_code' => $ctgm_code,
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
  echo "location.href = '$actual_link_site/index/?zone=CategorySub&success'";
  echo "</script>";
}



if(isset($_POST['btn-submit-edit']))
{ 
    $ctgs_code = strip_tags($_POST['ctgs_code']);
    $ctgs_name = strip_tags($_POST['ctgs_name']);
    $ctgs_description = isset($_POST['ctgs_description']) ? $_POST['ctgs_description'] : FALSE;
    $ctgs_status = strip_tags($_POST['ctgs_status']);
    $ctgm_code = strip_tags($_POST['ctgm_code']);
    $upd_by= strip_tags($_POST['upd_by']);
    if(!empty($_FILES['imageupload']['name'])){
      $count2=count($_FILES['imageupload']['name']);
      if($count2 <=5){
        for($i2=0;$i2<$count2;$i2++){
        $imgsize = $_FILES['imageupload']['size'][$i2];
        if($imgsize >0){
        $newimage=add_images($_FILES['imageupload']['tmp_name'][$i2],$_FILES['imageupload']['name'][$i2],"../images/images_catagory/");
        $sql_process->fastQuery("INSERT INTO tbl_category_img (cgimg_name,cgimg_code) VALUES('$newimage','$ctgs_code')");
        }
         }
      }
    }
    $fields = [
        'ctgs_name' => $ctgs_name,
        'ctgs_description' => $ctgs_description,
        'ctgs_status' => $ctgs_status,
        'ctgm_code' => $ctgm_code,
        'upd_by' => $upd_by
    ];
    $Where=['ctgs_code' => $ctgs_code];
    try {
    
      /*
       * Have used the word 'object' as I could not see the actual 
       * class name.
       */
      $sql_process->update($table, $fields,$Where);
    
    }catch(ErrorException $exception) {
    
       $exception->getMessage();  // Should be handled with a proper error message.
    
    }
    //cho $count2;
   
    echo "<script>";
    echo "location.href = '$actual_link_site/index/?zone=CategorySub&success'";
    echo "</script>";
}