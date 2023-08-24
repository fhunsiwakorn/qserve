<?php
$table="tbl_master_titlename";

if(isset($_POST['btn-submit-add']))
{  

    $title_name = strip_tags($_POST['title_name']);
    $language_status = strip_tags($_POST['language_status']);
    $title_status = strip_tags($_POST['title_status']);
    $crt_by=$_SESSION['userSession']; 
    $crt_date=date("Y-m-d H:i:s");

  $fields = [
    'title_name' => $title_name,
    'language_status' => $language_status,
    'title_status' => $title_status,
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
  echo "location.href = '?zone=Titlename&success'";
  echo "</script>";
}

if(isset($_GET['success'])){
    echo "<script>";
    echo 'swal("ทำรายการสำเร็จ !", "ปิดหน้าต่างนี้ !", "success")';
    echo "</script>";
}


if(isset($_POST['btn-submit-edit']))
{ 
    $title_id = strip_tags($_POST['title_id']);
    $title_name = strip_tags($_POST['title_name']);
    $language_status = strip_tags($_POST['language_status']);
    $title_status = strip_tags($_POST['title_status']);
    $upd_by=$_SESSION['userSession'];    
    $fields = [
        'title_name' => $title_name,
        'language_status' => $language_status,
        'title_status' => $title_status,
        'upd_by' => $upd_by
    ];
    $Where=['title_id' => $title_id];
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
    echo "location.href = '?zone=Titlename&success'";
    echo "</script>";
}
if(isset($_GET['DELtitle_id'])) {
    $title_id = $_GET['DELtitle_id'];
    $Del_1= $sql_process->fastQuery("UPDATE  tbl_master_titlename SET is_delete='0'   WHERE title_id='$title_id'");
      echo "<script>";
      echo "location.href = '?zone=Titlename&success'";
      echo "</script>";
    }
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
?>


<div class="row">

            
                <div class="col-8">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">คำนำหน้า</h4>
                     


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
        <th>คำนำหน้า</th>
        <th>สถานะ</th>
        <th>สร้างโดย</th>
        <th>แก้ไขโดย</th>
      </tr>
      </thead>
      <tbody>
<?php


if($q != NULL ){
  $stateSQL="AND tbl_master_titlename.title_name LIKE '%$q%'";
}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT tbl_master_titlename.title_id FROM tbl_master_titlename WHERE tbl_master_titlename.is_delete ='1' $stateSQL");
$rows='10';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);
$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_master_titlename.title_id,
tbl_master_titlename.title_name,
tbl_master_titlename.language_status,
tbl_master_titlename.crt_by,
tbl_master_titlename.crt_date,
tbl_master_titlename.upd_by,
tbl_master_titlename.upd_date,
tbl_master_titlename.title_status,
tbl_user.user_firstname,
tbl_user.user_lastname
FROM
tbl_master_titlename ,
tbl_user
WHERE
tbl_master_titlename.crt_by = tbl_user.user_id AND
tbl_master_titlename.is_delete ='1'
$stateSQL
ORDER BY
tbl_master_titlename.title_name ASC
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
      <tr  onclick="window.location.href='?zone=<?=$zone?>&TitlenameEdit=<?=$rowData->title_id?>&page=<?=$page?>&q=<?=$q?>'" style="cursor:pointer;"   title="<?=$rowData->title_name?>">
     
        <td><?=$rowData->title_name?></td>
        <td align="center" >
            <?php
            if($rowData->title_status=='1'){
              echo '<label class="badge badge-success"> เปิด</label>';
            }elseif ($rowData->title_status=='0') {
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
      <th>คำนำหน้า</th>
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
if(!isset($_GET["TitlenameEdit"])){
 require("dashboard_page_2_masterdata_titlenameForm.php");
}else{
 require("dashboard_page_2_masterdata_titlenameEdit.php");
}

?>
                    

                    </div>
                  </div>
                </div>
            
              </div>
            </div>

          

            </div>
       