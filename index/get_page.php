<?php
               
           if(!isset($_GET["zone"])){
            include ("page_1.php");
        
           }else{ 
           switch($_GET["zone"]) {
           case "main" : include ("page_1.php");
           break;
           case "CategoryMain" : include ("page_2_CategoryMain.php");
           break;
           case "CategoryMainForm" : include ("page_2_CategoryMainForm.php");
           break;
           case "CategoryMainEdit" : include ("page_2_CategoryMainEdit.php");
           break;
           case "CategorySub" : include ("page_3_CategorySub.php");
           break;
           case "CategorySubForm" : include ("page_3_CategorySubForm.php");
           break;
           case "CategorySubEdit" : include ("page_3_CategorySubEdit.php");
           break;
           case "Personal" : include ("page_4_Personnal.php");
           break;
           case "PersonalForm" : include ("page_4_PersonnalForm.php");
           break;
           case "PersonalEdit" : include ("page_4_PersonnalEdit.php");
           break;
           case "Setting" : include ("page_6_Setting.php");
           break;
           case "EvaluationForm1" : include ("page_5_EvaluationForm1.php");
           break;
           case "EvaluationForm1E" : include ("page_5_EvaluationForm1E.php");
           break;
           case "EvaluationForm2" : include ("page_5_EvaluationForm2.php");
           break;
           case "EvaluationForm3" : include ("page_5_EvaluationForm3.php");
           break;
           case "EvaluationData" : include ("page_5_EvaluationData.php");
           break;
           case "Evaluation-QrCode" : include ("page_5_EvaluationQrcode.php");
           break;
           case "EvaluationHistory" : include ("page_5_EvaluationHistory.php");
           break;
           case "Report" : include ("page_7_report.php");
           break;
           case "Report-Result" : include ("page_7_report_Result.php");
           break;
           case "ReportDetail" : include ("page_7_report_detail.php");
           break;
           case "ReportChk" : include ("page_7_report_chkResult.php");
           break;
           case "Comment" : include ("page_7_reportComment.php");
           break;
           default :  include ("page_1.php");
            }
           }
           