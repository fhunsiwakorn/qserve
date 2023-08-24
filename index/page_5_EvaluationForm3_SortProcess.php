<?php
/*
* Author : Ali Aboussebaba
* Email : bewebdeveloper@gmail.com
* Website : http://www.bewebdeveloper.com
* Subject : Dynamic Drag and Drop with jQuery and PHP
*/

// ถ้ามีค่า get ส่งมาจากการค้นหา
$eltp_code = isset($_GET['eltp_code']) ? $_GET['eltp_code'] : NULL; 

// including the config file
require_once("../config/dbl_config.php");
require_once('../class/class_query.php');
$sql_process = new function_query();

// get the list of items id separated by cama (,)
$list_order = $_POST['list_order'];
// convert the string list to an array
$list = explode(',' , $list_order);
$i = 1 ;
foreach($list as $id) {
	try {
        $query = $sql_process->runQuery("UPDATE tbl_evaluation_data SET eltda_index=:item_order 
		 WHERE  eltda_id=:id AND eltp_code=:eltp_code_param");
		$query->bindParam(':item_order', $i, PDO::PARAM_INT);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->bindParam(':eltp_code_param', $eltp_code, PDO::PARAM_INT);
		$query->execute();
	} catch (PDOException $e) {
		echo 'PDOException : '.  $e->getMessage();
	}
	$i++ ;
}

