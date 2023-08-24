<?php
$cmn_name=$dataRow["cmn_name"];
$eltp_name=$dataRow["eltp_name"];
$text_send="
$cmn_name
$eltp_name
";
 if(!isset($_GET["zone"])){
   include ("public_2_CompanyEvaTopic.php");
   }else{
   switch($_GET["zone"]) {
   case "EvaTopic" : include ("public_2_CompanyEvaTopic.php");
   break;
   case "EvaStart" : include ("public_2_CompanyStart.php");
   break;
   case "EvaAddScore" : include ("public_2_avgScore.php");
   break;
   case "last_step" : include ("public_2_last_step.php");
   break;
   default :  include ("public_2_CompanyEvaTopic.php");
     }
   }

// echo $Chk_data;
	
            
