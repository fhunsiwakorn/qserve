<?php
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$q = isset($_GET['q']) ? $_GET['q'] : NULL; 
if($q != NULL ){
  $stateSQL="AND stlg_text LIKE '%$q%'";
}else{
  $stateSQL=NULL;
}

$total_data =$sql_process->rowsQuery("SELECT stlg_id FROM tbl_system_language WHERE country_id >='0' $stateSQL GROUP BY stlg_code ");
$rows='25';
$total_page=ceil($total_data/$rows);
if($page>=$total_page)$page=$total_page;
$start=positive_number(($page-1)*$rows);
?>
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">จัดการภาษาระบบ
                        <div align="right"> <button type="button" onclick="window.location.href='?zone=SystemLanguageForm'"class="btn btn-success mr-2">เพิ่มข้อมูล</button></div>

                      </h4>
                     

                      <div class="form-group">
  <form action="#" method="get"name="form1" class="sidebar-form" autocomplete="off">
      <input type="hidden" name="zone"  value="<?=$zone?>">
 
        <div class="input-group">
          <input type="text" name="q" id="q" class="form-control" placeholder="ค้นหา..." value="<?=$q?>">
          <span class="input-group-btn">
          <button type="submit" name="search" id="search-btn" class="btn btn-flat">ค้นหา</i>
                </button>
              </span>
        </div>
     
      </div>  

      <div  style="width: 100%;overflow-y: scroll; scrollbar-arrow-color:blue; scrollbar-face-color: #e7e7e7; scrollbar-3dlight-color: #a0a0a0; scrollbar-darkshadow-color:#888888">
      <table id="example1" class="table table-bordered table-striped">
  <tr >
    <th >ข้อความ / เมนู</th>
    <th  >รหัส</th>
    <th >จัดการ</th>
  </tr>
  <?php foreach ($sql_process->fechdata("tbl_system_language","country_id >='0' $stateSQL GROUP BY stlg_code ORDER BY  stlg_id ASC limit $start,$rows") as $value) {  ?>
  <tr>
    <td>
        <?php
        $qg = $sql_process->runQuery(
            "SELECT
            tbl_master_country.country_name,
            tbl_system_language.stlg_text
            FROM
            tbl_master_country ,
            tbl_system_language
            WHERE
            tbl_system_language.country_id = tbl_master_country.country_id AND
            tbl_system_language.stlg_code ='".$value["stlg_code"]."' AND
            tbl_master_country.is_delete ='1'
            HAVING
            tbl_system_language.stlg_text != ''
            ORDER BY
            tbl_master_country.country_id ASC
            ");
            $qg->execute();
            while($rowData= $qg->fetch(PDO::FETCH_OBJ)) {
         echo "<label>";
         echo $rowData->country_name;
         echo "</label> : ";
         echo $rowData->stlg_text;
         echo "<br>";
            }
            ?>


    </td>
    <td><?=$value["stlg_code"]?></td>
    <td  align="center"><button type="button" onclick="window.location.href='?zone=SystemLanguageEdit&stlg=<?=$value['stlg_code']?>'"class="btn btn-warning mr-2">แก้ไข</button></td>
  </tr>
  <?php } ?>
</table>
</div>    

<?php  require("paging.php"); ?>


                    </div>
                  </div>
              