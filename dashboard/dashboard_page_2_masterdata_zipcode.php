<?php
$table="tbl_location_zipcode";
if(isset($_POST['btn-submit-add']))
{ 
    $zipcode = strip_tags($_POST['zipcode']);
    $amphur_id = strip_tags($_POST['amphur_id']);
    $province_id = strip_tags($_POST['province_id']);
    $district_id = strip_tags($_POST['district_id']);
    $crt_by=$_SESSION['userSession']; 
    $crt_date=date("Y-m-d H:i:s"); 
    $zipcode_status = strip_tags($_POST['zipcode_status']);

  $fields = [
    'zipcode' => $zipcode,
    'amphur_id' => $amphur_id,
    'province_id' => $province_id,
    'district_id' => $district_id,
    'crt_by' => $crt_by,
    'crt_date' => $crt_date,
    'zipcode_status' => $zipcode_status
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
    echo "location.href = '?zone=Zipcode&success'";
    echo "</script>";
}


if(isset($_POST['btn-submit-edit']))
{
  $zipcode_id = strip_tags($_POST['zipcode_id']);
  $zipcode = strip_tags($_POST['zipcode']);
  $amphur_id = strip_tags($_POST['amphur_id']);
  $province_id = strip_tags($_POST['province_id']);
  $district_id = strip_tags($_POST['district_id']);
  $upd_by=$_SESSION['userSession'];  
  $zipcode_status = strip_tags($_POST['zipcode_status']);
  
  $fields = [
    'zipcode' => $zipcode,
    'amphur_id' => $amphur_id,
    'province_id' => $province_id,
    'district_id' => $district_id,
    'upd_by' => $upd_by,
    'zipcode_status' => $zipcode_status
];

$Where=['zipcode_id' => $zipcode_id];
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
    echo "location.href = '?zone=Zipcode&success'";
    echo "</script>";
}


if(isset($_GET['DELzipcode'])) {

   $zipcode_id = $_GET['DELzipcode'];
   $Del_1= $sql_process->fastQuery("UPDATE $table SET is_delete='0'   WHERE zipcode_id='$zipcode_id'");
    
    echo "<script>";
    echo "location.href = '?zone=Zipcode&success'";
    echo "</script>";
  }
if(isset($_GET['success'])){
    echo "<script>";
    echo 'swal("ทำรายการสำเร็จ !", "ปิดหน้าต่างนี้ !", "success")';
    echo "</script>";
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
?>


<div class="row">

            
                <div class="col-8">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">ข้อมูลไปรษณีย์</h4>
                     


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

       <script type="text/javascript">  
    function make_autocom(autoObj,showObj){  
        var mkAutoObj=autoObj;   
        var mkSerValObj=showObj;   
        new Autocomplete(mkAutoObj, function() {  
            this.setValue = function(id) {        
                document.getElementById(mkSerValObj).value = id;  
            }  
            if ( this.isModified )  
                this.setValue("");  
            if ( this.value.length < 1 && this.isNotClick )   
                return ;      
            return "../library/search_data_zipcode.php?q=" +encodeURIComponent(this.value);  
        });   
    }     
       
    // การใช้งาน  
    // make_autocom(" id ของ input ตัวที่ต้องการกำหนด "," id ของ input ตัวที่ต้องการรับค่า");  
    make_autocom("q","h_arti_id");  
</script>
               
 <div  style="width: 100%;overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
 <form class="forms-sample" name="form_del" if="form_del" method="post" autocomplete="off" >
                      <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
      <th>เลขไปรษณีย์</th>
        <th>ตำบล</th>
        <th>อำเภอ</th>
        <th>จังหวัด</th>
        <th>สถานะ</th>
        <th>สร้างโดย</th>
        <th>แก้ไขโดย</th>
      </tr>
      </thead>
      <tbody>
<?php


if($q != NULL ){
  $stateSQL="AND tbl_location_zipcode.zipcode LIKE '%$q%'";
}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT tbl_location_zipcode.zipcode_id FROM tbl_location_zipcode WHERE tbl_location_zipcode.is_delete ='1' $stateSQL");
$rows='20';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);
$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_location_zipcode.zipcode_id,
tbl_location_zipcode.district_code,
tbl_location_zipcode.province_id,
tbl_location_zipcode.amphur_id,
tbl_location_zipcode.district_id,
tbl_location_zipcode.zipcode,
tbl_location_zipcode.crt_by,
tbl_location_zipcode.crt_date,
tbl_location_zipcode.upd_by,
tbl_location_zipcode.upd_date,
tbl_location_zipcode.zipcode_status,
tbl_location_district.district_name,
tbl_location_district.district_id,
tbl_location_amphur.amphur_name,
tbl_location_amphur.amphur_id,
tbl_location_province.province_name,
tbl_location_province.province_id,
tbl_user.user_firstname,
tbl_user.user_lastname
FROM
tbl_location_zipcode ,
tbl_location_district ,
tbl_location_amphur ,
tbl_location_province ,
tbl_user
WHERE
tbl_location_zipcode.province_id = tbl_location_province.province_id AND
tbl_location_zipcode.amphur_id = tbl_location_amphur.amphur_id AND
tbl_location_zipcode.district_id = tbl_location_district.district_id AND
tbl_location_zipcode.crt_by = tbl_user.user_id AND
tbl_location_zipcode.is_delete ='1' 
$stateSQL
ORDER BY
tbl_location_zipcode.zipcode ASC
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
      <tr  onclick="window.location.href='?zone=<?=$zone?>&ZipcodeEdit=<?=$rowData->zipcode_id?>&page=<?=$page?>&q=<?=$q?>'" style="cursor:pointer;"  title="<?=$rowData->zipcode?>">
     
        <td><?=$rowData->zipcode?></td>
        <td><?=$rowData->district_name?></td>
        <td><?=$rowData->amphur_name?></td>
        <td><?=$rowData->province_name?></td>
        <td align="center" >
            <?php
            if($rowData->zipcode_status=='1'){
              echo '<label class="badge badge-success"> เปิด</label>';
            }elseif ($rowData->zipcode_status=='0') {
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
      <th>เลขไปรษณีย์</th>
        <th>ตำบล</th>
        <th>อำเภอ</th>
        <th>จังหวัด</th>
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
if(!isset($_GET["ZipcodeEdit"])){
require("dashboard_page_2_masterdata_zipcodeForm.php");
}else{
 require("dashboard_page_2_masterdata_zipcodeEdit.php");
}

?>
                    

                    </div>
                  </div>
                </div>
            
              </div>
            </div>

          

            </div>
       