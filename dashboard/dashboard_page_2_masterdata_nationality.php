<?php
$table="tbl_master_nationality";

if(isset($_POST['btn-submit-add']))
{  

    $nationality_name = strip_tags($_POST['nationality_name']);
    $nationality_status = strip_tags($_POST['nationality_status']);
    $crt_by=$_SESSION['userSession']; 
    $crt_date=date("Y-m-d H:i:s");

  $fields = [
    'nationality_name' => $nationality_name,
    'nationality_status' => $nationality_status,
    'crt_by' => $crt_by,
    'crt_date' => $crt_date
];
try {

    /*
     * Have used the word 'object' as I could not see the actual 
     * class name.
     */
    $sql_process->insert($table, $fields);
  
  }catch(ErrorException $exception) {
  
     $exception->getMessage();  // Should be handled with a proper error message.
  
  }

  echo "<script>";
  echo "location.href = '?zone=Nationality&success'";
  echo "</script>";
}

if(isset($_GET['success'])){
    echo "<script>";
    echo 'swal("ทำรายการสำเร็จ !", "ปิดหน้าต่างนี้ !", "success")';
    echo "</script>";
}


if(isset($_POST['btn-submit-edit']))
{ 
    $nationality_id = strip_tags($_POST['nationality_id']);
    $nationality_name = strip_tags($_POST['nationality_name']);
    $nationality_status = strip_tags($_POST['nationality_status']);
    $upd_by=$_SESSION['userSession'];    
    $fields = [
        'nationality_name' => $nationality_name,
        'nationality_status' => $nationality_status,
        'upd_by' => $upd_by
    ];
    $Where=['nationality_id' => $nationality_id];
    try {
    
      /*
       * Have used the word 'object' as I could not see the actual 
       * class name.
       */
      $sql_process->update($table, $fields,$Where);
    
    }catch(ErrorException $exception) {
    
       $exception->getMessage();  // Should be handled with a proper error message.
    
    }
    
   

    echo "<script>";
    echo "location.href = '?zone=Nationality&success'";
    echo "</script>";
}
if(isset($_GET['DELnationality_id'])) {
    $nationality_id = $_GET['DELnationality_id'];
    $Del_1= $sql_process->fastQuery("UPDATE  tbl_master_nationality SET is_delete='0'   WHERE nationality_id='$nationality_id'");
      echo "<script>";
      echo "location.href = '?zone=Nationality&success'";
      echo "</script>";
    }
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
?>


<div class="row">

            
                <div class="col-8">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">ข้อมูลสัญชาติ</h4>
                     


  <div class="form-group">
  <form action="#" method="get"name="form1" class="sidebar-form" autocomplete="off">
      <input type="hidden" name="zone"  value="<?=$zone?>">
      <input name="h_arti_id" type="hidden" id="h_arti_id" value="" />
        <div class="input-group">
          <input type="text" name="q" id="q" class="form-control" placeholder="ค้นหา..." >
          <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat">ค้นหา</i>
                </button>
              </span>
        </div>
     
      </div>  
      </form>                
 <div  style="width: 100%;overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
 <form class="forms-sample" name="form_del" if="form_del" method="post" autocomplete="off" >
                      <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>สัญชาติ</th>
        <th>สถานะ</th>
        <th>สร้างโดย</th>
        <th>แก้ไขโดย</th>
      </tr>
      </thead>
      <tbody>
<?php


if($q != NULL ){
  $stateSQL="AND tbl_master_nationality.nationality_name LIKE '%$q%'";
}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT tbl_master_nationality.nationality_id FROM tbl_master_nationality WHERE tbl_master_nationality.is_delete ='1' $stateSQL");
$rows='10';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);
$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_master_nationality.nationality_id,
tbl_master_nationality.nationality_name,
tbl_master_nationality.crt_by,
tbl_master_nationality.crt_date,
tbl_master_nationality.upd_by,
tbl_master_nationality.upd_date,
tbl_master_nationality.nationality_status,
tbl_user.user_firstname,
tbl_user.user_lastname
FROM
tbl_master_nationality ,
tbl_user
WHERE
tbl_master_nationality.crt_by = tbl_user.user_id AND
tbl_master_nationality.is_delete ='1'
$stateSQL
ORDER BY
tbl_master_nationality.nationality_name ASC
limit $start,$rows
");
$qg->execute();
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;
//แก้ไขโดย
$upd_by = $rowData->upd_by;	
$stmt = $sql_process->runQuery("SELECT tbl_user.user_firstname,tbl_user.user_lastname FROM tbl_user WHERE user_id=:user_id_param");
$stmt->execute(array(":user_id_param"=>$upd_by));
$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
      <tr  onclick="window.location.href='?zone=<?=$zone?>&NationalityEdit=<?=$rowData->nationality_id?>&page=<?=$page?>&q=<?=$q?>'" style="cursor:pointer;"   title="<?=$rowData->nationality_name?>">
     
        <td><?=$rowData->nationality_name?></td>
        <td align="center" >
            <?php
            if($rowData->nationality_status=='1'){
              echo '<label class="badge badge-success"> เปิด</label>';
            }elseif ($rowData->nationality_status=='0') {
            echo '<label class="badge badge-danger" data-toggle="tooltip" title="ปิด">ปิด</label>';
            }
             ?>

          </td>
          <td align="center"><?=$rowData->user_firstname?> <?=$rowData->user_lastname?><br> (<?php echo DateThai_2($rowData->crt_date);?>)</td>
       
        <td>
        <?=$dataRow["user_firstname"]?> <?=$dataRow["user_lastname"]?> <br> (<?php echo DateThai_2($rowData->upd_date);?>)
        </td>
      </tr>

   

<?php } ?>
      </tbody>
      <tfoot>
      <tr>
      <th>สัญชาติ</th>
        <th>สถานะ</th>
        <th>สร้างโดย</th>
        <th>แก้ไขโดย</th>
      </tr>
      </tfoot>
    </table>  
    </form>           
    </div>               

    <?php  require("paging.php"); ?>



                    </div>
                  </div>
                </div>
              
          
                <div class="col-md-4 d-flex align-items-stretch grid-margin">
              <div class="row flex-grow">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">

<?php
if(!isset($_GET["NationalityEdit"])){
require("dashboard_page_2_masterdata_nationalityForm.php");
}else{
 require("dashboard_page_2_masterdata_nationalityEdit.php");
}

?>
                    

                    </div>
                  </div>
                </div>
            
              </div>
            </div>

          

            </div>
       