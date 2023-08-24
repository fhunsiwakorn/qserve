<?php
session_start();
ob_start();

///เปลี่ยนภาษา
if(isset($_GET['setlanguage']) && !empty($_GET['setlanguage'])){
    unset($_SESSION['country_id']);
    $country_id=strip_tags($_GET['setlanguage']);
    $_SESSION['country_id']=$country_id;
	header('Location: '.$_SERVER['HTTP_REFERER']);
}