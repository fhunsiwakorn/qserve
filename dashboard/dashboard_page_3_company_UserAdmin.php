<?php
$table="tbl_user";
$table1="tbl_user_detail";
if(isset($_POST['btn-submit-add']))
{  


    $user_name = strip_tags($_POST['user_name']);
    $user_password = strip_tags($_POST['user_password']);
    $user_prefix = strip_tags($_POST['user_prefix']);
    $user_firstname = strip_tags($_POST['user_firstname']);
    $user_lastname = strip_tags($_POST['user_lastname']);
    $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : NULL;
    $cmn_code = strip_tags($_POST['cmn_code']);
    $user_code = random_password(20);
    $user_img=FALSE;
    $ctgm_code=FALSE;
    $ctgs_code=FALSE;
    
    $new_password = password_hash($user_password, PASSWORD_DEFAULT);
    $chk_user =$sql_process->rowsQuery("SELECT tbl_user.user_id FROM tbl_user WHERE tbl_user.user_name ='$user_name'");
 if($chk_user <=0){
    $fields = [
    'user_name' => $user_name,
    'user_password' => $new_password,
    'user_password_shows' => $user_password,
    'user_prefix' => $user_prefix,
    'user_firstname' => $user_firstname,
    'user_lastname' => $user_lastname,
    'user_email' => $user_email,
    'user_img' => $user_img,
    'user_code' => $user_code,
    'user_status' =>2
];
$fields1 = [
    'user_code' => $user_code,
    'cmn_code' => $cmn_code,
    'ctgm_code' => $ctgm_code,
    'ctgs_code' => $ctgs_code
];
 
try {

    /*
     * Have used the word 'object' as I could not see the actual 
     * class name.
     */
    $sql_process->insert($table, $fields);
    $sql_process->insert($table1, $fields1);
  }catch(ErrorException $exception) {
  
     $exception->getMessage();  // Should be handled with a proper error message.
  
  }

  echo "<script>";
  echo "location.href = '?zone=UserAdmin&success'";
  echo "</script>";
    }else{
        echo "<script>";
        echo "location.href = '?zone=UserAdmin&error'";
        echo "</script>";  
    }
}



if(isset($_POST['btn-submit-edit']))
{ 
    $user_id = strip_tags($_POST['user_id']);
    $user_name = strip_tags($_POST['user_name']);
    $user_password = strip_tags($_POST['user_password']);
    $user_prefix = strip_tags($_POST['user_prefix']);
    $user_firstname = strip_tags($_POST['user_firstname']);
    $user_lastname = strip_tags($_POST['user_lastname']);
    $user_email = isset($_POST['user_email']) ? $_POST['user_email'] : NULL;
    $cmn_code = strip_tags($_POST['cmn_code']);  
    $new_password = password_hash($user_password, PASSWORD_DEFAULT);
    $chk_user =$sql_process->rowsQuery("SELECT tbl_user.user_id FROM tbl_user WHERE tbl_user.user_name ='$user_name' AND user_id!='$user_id'");
    if($chk_user <=0){ 
    $fields = [
        'user_name' => $user_name,
        'user_password' => $new_password,
        'user_password_shows' => $user_password,
        'user_prefix' => $user_prefix,
        'user_firstname' => $user_firstname,
        'user_lastname' => $user_lastname,
        'user_email' => $user_email
    ];
    $Where=['user_id' => $user_id];
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
    echo "location.href = '?zone=UserAdmin&success'";
    echo "</script>";
    }else{
        echo "<script>";
        echo "location.href = '?zone=UserAdmin&error'";
        echo "</script>";  
    }
}
if(isset($_GET['DELuserid'])) {
    $user_id = $_GET['DELuserid'];
    $Del_1= $sql_process->fastQuery("UPDATE  tbl_user SET is_delete='0'   WHERE user_id='$user_id'");
      echo "<script>";
      echo "location.href = '?zone=UserAdmin&success'";
      echo "</script>";
    }
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 


if(isset($_GET['success'])){
    echo "<script>";
    echo 'swal("ทำรายการสำเร็จ !", "ปิดหน้าต่างนี้ !", "success")';
    echo "</script>";
}

if(isset($_GET['error'])){
    echo "<script>";
    echo 'swal("User Name ซ้ำกัน !", "ปิดหน้าต่างนี้ !", "error")';
    echo "</script>";
}
?>


<div class="row">

            
                <div class="col-8">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">ข้อมูลผู้ดูแลระบบ</h4>
                     


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
        <th>Username</th>
        <th>Password</th>
        <th>ชื่อ - นามสกุล</th>
        <th>อีเมล</th>
        <th>บริษัท / หน่วยงาน</th>
      </tr>
      </thead>
      <tbody>
<?php


if($q != NULL ){
  $stateSQL="AND (tbl_user.user_firstname LIKE '%$q%' OR tbl_user.user_lastname LIKE '%$q%')";
}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT tbl_user.user_id FROM tbl_user WHERE tbl_user.is_delete ='1' AND user_status='2' $stateSQL");
$rows='10';
if($page<=0)$page=1;
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);
$num_gen='0';
$qg = $sql_process->runQuery(
"SELECT
tbl_user.user_id,
tbl_user.user_name,
tbl_user.user_password,
tbl_user.user_password_shows,
tbl_user.user_firstname,
tbl_user.user_lastname,
tbl_user.user_email,
tbl_company.cmn_name
FROM
tbl_user ,
tbl_user_detail ,
tbl_company
WHERE
tbl_user.user_code = tbl_user_detail.user_code AND
tbl_user_detail.cmn_code = tbl_company.cmn_code AND
tbl_user.is_delete ='1' AND
tbl_user.user_status='2'
$stateSQL
ORDER BY
tbl_user.user_id DESC
limit $start,$rows
");
$qg->execute();
while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
$num_gen++;

?>
      <tr  onclick="window.location.href='?zone=<?=$zone?>&UserAdminEdit=<?=$rowData->user_id?>&page=<?=$page?>&q=<?=$q?>'" style="cursor:pointer;"   title="<?=$rowData->user_firstname?> <?=$rowData->user_lastname?>">
     
        <td><?=$rowData->user_name?></td>
        <td><?=$rowData->user_password_shows?></td>
        <td align="center" >
        <?=$rowData->user_firstname?> <?=$rowData->user_lastname?>
          </td>
          <td align="center">
          <?=$rowData->user_email?>
            </td>  
      <td>
      <?=$rowData->cmn_name?>
        </td>
      </tr>

   

<?php } ?>
      </tbody>
      <tfoot>
      <tr>
      <th>Username</th>
        <th>Password</th>
        <th>ชื่อ - นามสกุล</th>
        <th>อีเมล</th>
        <th>บริษัท / หน่วยงาน</th>
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
if(!isset($_GET["UserAdminEdit"])){
require("dashboard_page_3_company_UserAdminForm.php");
}else{
 require("dashboard_page_3_company_UserAdminEdit.php");
}

?>
                    

                    </div>
                  </div>
                </div>
            
              </div>
            </div>

          

            </div>
       