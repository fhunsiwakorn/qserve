<?php
require_once("../config/dbl_config.php");
require_once('../class/class_query.php');
require_once('../class/class_user.php');
$sql_process = new function_query();
$auth_user = new USER();
/*
* Author : Ali Aboussebaba
* Email : bewebdeveloper@gmail.com
* Website : http://www.bewebdeveloper.com
* Subject : Dynamic Drag and Drop with jQuery and PHP
*/

// ถ้ามีค่า get ส่งมาจากการค้นหา
$eltp_code = isset($_GET['eltp_code']) ? $_GET['eltp_code'] : NULL; 
$country_id = isset($_GET['country_id']) ? $_GET['country_id'] : NULL; 
// select all items ordered by item_order
$qa = $sql_process->runQuery(
    "SELECT 
tbl_evaluation_data.eltda_name,
tbl_evaluation_data.eltda_id
FROM
tbl_evaluation_data
WHERE
tbl_evaluation_data.eltp_code =:eltp_code_param AND
tbl_evaluation_data.is_delete ='1' 
ORDER BY
tbl_evaluation_data.eltda_index ASC");
    $qa->execute(array(":eltp_code_param"=>$eltp_code));
    $list = $qa->fetchAll();


    ///ลบ
    if(isset($_GET['Deleltda_id'])){
        $eltda_id = $_GET['Deleltda_id'];
        $eltp_code = $_GET['eltp_code'];
        $Del_1= $sql_process->fastQuery("UPDATE tbl_evaluation_data SET is_delete='0'   WHERE eltda_id='$eltda_id'");
        // echo "<script>";
        // echo "location.href = 'page_5_EvaluationForm3_Sort.php?eltp_code=$eltp_code'";
        // echo "</script>";
        header('Location: '.$_SERVER['HTTP_REFERER']);
    } 

   $edit= $auth_user->mf("4U9N0HPRKM852Y9B5II",$country_id);
   $del= $auth_user->mf("2UNYAQB1Q9W3FENTR11",$country_id);
   $alert= $auth_user->mf("PR9URT9UM3QB1ZJ62NK",$country_id);
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Drag and Drop using jQuery and Ajax</title>
<!-- <link rel="stylesheet" href="../fonts/thsarabunnew.css" />
  <link rel="stylesheet" href="../fonts/style_font.css" /> -->
<link rel="stylesheet" href="../plugins/dynamic-drag-and-drop/css/style.css" />
<script type="text/javascript" src="../plugins/dynamic-drag-and-drop/js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../plugins/dynamic-drag-and-drop/js/jquery-ui-1.10.4.custom.min.js"></script>
<!-- <script type="text/javascript" src="../plugins/dynamic-drag-and-drop/js/script.js"></script> -->
<script>
	$(function() {
    $('#sortable').sortable({
        axis: 'y',
        opacity: 0.7,
        handle: 'span',
        update: function(event, ui) {
            var list_sortable = $(this).sortable('toArray').toString();
    		// change order in the database using Ajax
            $.ajax({
                url: 'page_5_EvaluationForm3_SortProcess.php?eltp_code=<?=$eltp_code?>',
                type: 'POST',
                data: {list_order:list_sortable},
                success: function(data) {
                    //finished
                }
            });
        }
    }); // fin sortable
});


</script>

</head>

<body>
   
<ul id="sortable">
<?php
$number=0;
foreach ($list as $rs) {
	$number++;
?>
<li id="<?php echo $rs['eltda_id']; ?>">
	<span></span>
	<div><h2>
	&nbsp; &nbsp; <?php echo $rs['eltda_name']; ?></h2>
	&nbsp; <a href="page_5_EvaluationForm3_DataEdit.php?eltda_id=<?php echo $rs['eltda_id']; ?>&country_id=<?=$country_id?>"> <?=$edit?> </a>
     /
     <a href="page_5_EvaluationForm3_Sort.php?Deleltda_id=<?php echo $rs['eltda_id']; ?>&eltp_code=<?=$eltp_code?>" onClick="javascript:return confirm('<?=$alert?>');"> <?=$del?>  </a>
	</div>
</li>
<?php
}
?>
</ul>
  
</body>
</html>
