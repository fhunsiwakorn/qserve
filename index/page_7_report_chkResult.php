<?php  
$eltp_status_topic = isset($_GET['eltp_status_topic']) ? $_GET['eltp_status_topic'] :NULL; 
$eltp = isset($_GET['eltp']) ? $_GET['eltp'] :NULL; 
$evltp_code = isset($_GET['evltp']) ? $_GET['evltp'] :NULL; 
if(!isset($_GET["eltp_status_topic"])){
          echo NULL;
        
           }else{
         switch($_GET["eltp_status_topic"]) {
        case "1" : include ("page_7_reportCompany_Detail.php");
        break;
        case "2" : include ("page_7_reportCategoryMain_Detail.php");
        break;
        case "3" : include ("page_7_reportCategorySub_Detail.php");
        break;
        case "4" : include ("page_7_reportPersonal_Detail.php");
        break;
        // default :  include ("page_1.php");
         }
     }
  