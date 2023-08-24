<?php    
$eltp_code=isset($_GET['eltp_code']) ? $_GET['eltp_code'] : NULL; ///หัวข้อแบบประเมิน
$evltp_code=isset($_GET['evltp_code']) ? $_GET['evltp_code'] : NULL;  ///ใช้แทน user_code,ctgm_code,ctgs_code	
$actual_link_site=isset($_GET['actual_link_site']) ? $_GET['actual_link_site'] : NULL; ////URL ระบบ
if($eltp_code!=NULL){
$name_qrcode="$actual_link_site/public/?eltp=$eltp_code&evltp=$evltp_code";
/*   
 * PHP QR Code encoder
 *
 * Exemplatory usage
 *
 * PHP QR Code is distributed under LGPL 3
 * Copyright (C) 2010 Dominik Dzienia <deltalab at poczta dot fm>
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */ 
   
    //set it to writable location, a place for temp generated PNG files
    $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'../temp'.DIRECTORY_SEPARATOR;
    
    //html PNG location prefix
    $PNG_WEB_DIR = '../temp/';

    include "../plugins/plugin_qrcode/qrlib.php";    
    // require("../../plugin_qrcode/qrlib.php");
    
    //ofcourse we need rights to create temp dir
    if (!file_exists($PNG_TEMP_DIR))
        mkdir($PNG_TEMP_DIR);

        $filename = $PNG_TEMP_DIR."$eltp_code-$evltp_code".'.png';
    //processing form input
    //remember to sanitize user input in real-life solution !!!
    $errorCorrectionLevel = 'M';
    if (isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H')))
        $errorCorrectionLevel = $_REQUEST['level'];    

    $matrixPointSize = 10;
    // if (isset($_REQUEST['size']))
    //     $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
    // if (isset($_REQUEST['data'])) { 
    
    //     //it's very important!
    //     if (trim($_REQUEST['data']) == '')
    //         die('data cannot be empty! <a href="?">back</a>');
            
    //     // user data
    //     $filename = $PNG_TEMP_DIR.'test'.md5($_REQUEST['data'].'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
    //     QRcode::png($_REQUEST['data'], $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
        
    // } else {       
        //default data
        //echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
      //  QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);    
    // }    
    // echo 'You can provide data in GET parameter: <a href="?data=like_that">like that</a><hr/>';    
    QRcode::png($name_qrcode, $filename, $errorCorrectionLevel, $matrixPointSize, 2);      
    //display generated file
  
    echo "<center>";
    echo '<img src="'.$PNG_WEB_DIR.basename($filename).'" /><hr/>';   
    echo "</center>";
    
    // //config form
    // echo '<form action="index.php" method="post">
    //     Data:&nbsp;<input name="data" value="'.(isset($_REQUEST['data'])?htmlspecialchars($_REQUEST['data']):'PHP QR Code :)').'" />&nbsp;
    //     ECC:&nbsp;<select name="level">
    //         <option value="L"'.(($errorCorrectionLevel=='L')?' selected':'').'>L - smallest</option>
    //         <option value="M"'.(($errorCorrectionLevel=='M')?' selected':'').'>M</option>
    //         <option value="Q"'.(($errorCorrectionLevel=='Q')?' selected':'').'>Q</option>
    //         <option value="H"'.(($errorCorrectionLevel=='H')?' selected':'').'>H - best</option>
    //     </select>&nbsp;
    //     Size:&nbsp;<select name="size">';
        
    // for($i=1;$i<=10;$i++)
    //     echo '<option value="'.$i.'"'.(($matrixPointSize==$i)?' selected':'').'>'.$i.'</option>';
        
    // echo '</select>&nbsp;
    //     <input type="submit" value="GENERATE"></form><hr/>';
        
    // benchmark
    //QRtools::timeBenchmark();   
    
}
?>
