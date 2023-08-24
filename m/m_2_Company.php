<?php
$cmn_name=$dataRow["cmn_name"];
$eltp_name=$dataRow["eltp_name"];
$text_send="
$cmn_name
$eltp_name
";
 if(!isset($_GET["zone"])){
   include ("m_2_CompanyEvaTopic.php");
   }else{
   switch($_GET["zone"]) {
   case "EvaTopic" : include ("m_2_CompanyEvaTopic.php");
   break;
   case "EvaStart" : include ("m_2_EvaStart.php");
   break;
   case "EvaAddScore" : include ("m_2_avgScore.php");
   break;
   case "last_step" : include ("m_2_last_step.php");
   break;
   default :  include ("m_2_CompanyEvaTopic.php");
     }
   }

// echo $Chk_data;
	
            
