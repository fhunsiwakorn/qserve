<?php
               
           if(!isset($_GET["zone"])){
            include ("dashboard_page_1.php");
        
           }else{
           switch($_GET["zone"]) {
           case "main" : include ("dashboard_page_1.php");
           break;
           case "CompanyForm" : include ("dashboard_page_3_companyForm.php");
           break;
           case "CompanyData" : include ("dashboard_page_3_companyData.php");
           break;
           case "CompanyEdit" : include ("dashboard_page_3_companyEdit.php");
           break;
           case "Nationality" : include ("dashboard_page_2_masterdata_nationality.php");
           break;
           case "Country" : include ("dashboard_page_2_masterdata_country.php");
           break;
           case "Titlename" : include ("dashboard_page_2_masterdata_titlename.php");
           break;
           case "UserAdmin" : include ("dashboard_page_3_company_UserAdmin.php");
           break;
           case "Notify-App" : include ("dashboard_page_4_Notify_App.php");
           break;
           case "SystemLanguage" : include ("dashboard_page_5_SystemLanguage.php");
           break;
           case "SystemLanguageForm" : include ("dashboard_page_5_SystemLanguageForm.php");
           break;
           case "SystemLanguageEdit" : include ("dashboard_page_5_SystemLanguageEdit.php");
           break;
           default :  include ("dashboard_page_1.php");
            }
           }
           ?> 