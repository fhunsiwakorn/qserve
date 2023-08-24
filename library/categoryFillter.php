
<?php
    header("content-type: text/html; charset=utf-8");
    header ("Expires: Wed, 21 Aug 2013 13:13:13 GMT");
    header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header ("Cache-Control: no-cache, must-revalidate");
    header ("Pragma: no-cache");

    require_once("../config/dbl_config.php");
    require_once('../class/class_query.php');
    $sql_process = new function_query();

    $data = $_GET['data'];
    $val = $_GET['val'];
    $cmn_code = isset($_GET['cmn_codeE']) ? $_GET['cmn_codeE'] : NULL;
    $ctgm_code = isset($_GET['ctgm_codeE']) ? $_GET['ctgm_codeE'] : NULL; 
    $ctgs_code = isset($_GET['ctgs_codeE']) ? $_GET['ctgs_codeE'] : NULL; 

    
    if ($data=='ctgm_code') {
              echo "<select name='ctgm_code' onChange=\"dochange('ctgs_code', this.value)\" class=\"form-control\" required>\n";
              echo "<option value=''>---</option>\n";
    
         $stm= $sql_process->runQuery(
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
           ctgm_name");
          $stm->execute();
          while($rs= $stm->fetch(PDO::FETCH_OBJ)) {  
                  echo"<option value='$rs->ctgm_code'";
                  if ($ctgm_code == $rs->ctgm_code)
                  {
                    echo "SELECTED";
                  }
                  echo ">$rs->ctgm_name</option>\n";
                 
          
              }

    }
    if ($data=='ctgs_code') {
      if($val==-1){
          $param ="OR ctgs_code='$ctgs_code' OR ctgm_code= '$ctgm_code'";
      }else{
        $param=NULL;
      }
              echo "<select name='ctgs_code' class=\"form-control\" required >\n";
              echo "<option value=''>---</option>\n";
       
  $stm= $sql_process->runQuery(
    "SELECT
     ctgs_code,
     ctgs_name
     FROM
     tbl_category_sub 
     WHERE 
     ctgs_status='1' AND
     is_delete='1' AND
     (ctgm_code= '$val'  $param)
     GROUP BY
     ctgs_code
     ORDER BY
     ctgs_name");
    $stm->execute();
    while($rs= $stm->fetch(PDO::FETCH_OBJ)) {   
                  echo"<option value='$rs->ctgs_code'";
                  if ($ctgs_code == $rs->ctgs_code)
                  {
                    echo "SELECTED";
                  }
                  echo ">$rs->ctgs_name</option>\n";
            
              }
         }
         echo "</select>\n";

?>
