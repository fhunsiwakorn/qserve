<?php
require_once("../config/dbl_config.php");
require_once('../class/class_query.php');
require_once("../class/class_function.php");
$sql_process = new function_query();

$table="tbl_category_main";
if(isset($_POST['stlg_text']) && !empty($_POST['stlg_text']) && isset($_POST['country_id']) && !empty($_POST['country_id']) )
{  
    $stlg_code = strip_tags($_POST["stlg_code"]);


  
      $count=count($_POST["country_id"]);
    
        for($i=0;$i<$count;$i++){
        $stlg_text=strip_tags($_POST["stlg_text"][$i]);
        $country_id=strip_tags($_POST["country_id"][$i]);
        $total_data =$sql_process->rowsQuery("SELECT stlg_id FROM tbl_system_language WHERE stlg_code='$stlg_code' AND country_id='$country_id' ");

         if($total_data <=0 && strlen($stlg_text)>0){
            $sql_process->fastQuery("INSERT INTO tbl_system_language (stlg_text,stlg_code,country_id) VALUES('$stlg_text','$stlg_code','$country_id')");
        }
        else{
            $sql_process->fastQuery("UPDATE tbl_system_language SET stlg_text='$stlg_text'   WHERE  stlg_code='$stlg_code' AND country_id='$country_id'");
        }
      
        // echo  $country_id;
        }

    


  echo "<script>";
  echo "location.href = '$actual_link_site/dashboard/?zone=SystemLanguage&success'";
  echo "</script>";
}

