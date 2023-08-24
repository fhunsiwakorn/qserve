<?php
require_once("../config/dbl_config.php");
require_once('../class/class_query.php');
require_once("../class/class_function.php");
$sql_process = new function_query();


///เปลี่ยนภาษา
if(isset($_GET['setlanguage']) && !empty($_GET['setlanguage']) && isset($_GET['user_code']) && !empty($_GET['user_code'])){
    $country_id=strip_tags($_GET['setlanguage']);
    $user_code=strip_tags($_GET['user_code']);
	$sql_process->fastQuery("UPDATE tbl_user_detail SET country_id='$country_id'   WHERE user_code='$user_code'");
	header('Location: '.$_SERVER['HTTP_REFERER']);
}

