<?php
if(isset($_GET['DELCompany'])) {

   $cmn_code_get = strip_tags($_GET['DELCompany']);
   $Del_1= $sql_process->fastQuery("UPDATE  tbl_company SET is_delete='0'   WHERE cmn_code='$cmn_code_get'");
   echo "<script>";
   echo "location.href = '?zone=CompanyData&success'";
   echo "</script>";
    
  }

if(isset($_GET['success'])){
  echo "<script>";
  echo 'swal("ทำรายการสำเร็จ !", "ปิดหน้าต่างนี้ !", "success")';
  echo "</script>";
}

// 
?>

<div class="row">
          
          <div class="col-lg-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">ข้อมูลบริษัท / หน่วยงาน</h4>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>
                          #
                        </th>
                        <th>
                          โลโก้
                        </th>
                        <th>
                         ชื่อบริษัท / หน่วยงาน
                        </th>
                        <th>
                        ข้อมูลติดต่อ
                        </th>
                        <th>
                        จัดการ
                        </th>
                     
                      </tr>
                    </thead>
                    <tbody>
                    <?php
$num_record='0';
$qData = $sql_process->runQuery(
"SELECT
tbl_company.cmn_id,
tbl_company.cmn_code,
tbl_company.cmn_logo,
tbl_company.cmn_name,
tbl_company.cmn_phone,
tbl_company.cms_address,
tbl_company.crt_by,
tbl_company.crt_date,
tbl_company.upd_by,
tbl_company.upd_date,
tbl_company.cmn_status,
tbl_company.is_delete
FROM
tbl_company
WHERE
tbl_company.is_delete ='1' 
ORDER BY
tbl_company.cmn_id DESC
");
$qData->execute();
while($rowData= $qData->fetch(PDO::FETCH_OBJ)) {
$num_record++;
if(!empty($rowData->cmn_logo)){
    $pathimg="../images/images_company/".$rowData->cmn_logo;
}else{
    $pathimg="../images/images_web/25135673-origpic-10657f.png";
}
// $strFileName='data:image/png;base64,' . base64_encode(file_get_contents($pathimg));
$strFileName=base64_encode_image ($pathimg);
?>
                      <tr>
                        <td class="font-weight-medium">
                         <?=$num_record?>
                        </td>
                        <td>
                        <a class="thumbnail" href="<?=$strFileName?>" data-lightbox="example-set-<?=$rowData->cmn_code?>" data-title="<?=$rowData->cmn_name?>">
                        <div class="gallery">
                        <img src="<?=$strFileName?>" alt="<?=$rowData->cmn_name?>"  class="example-image"/>
                        </div>
                        </a>
                        </td>
                        <td>
                        <?=$rowData->cmn_name?>
                        </td>
                       
                        <td>
                       เบอร์โทร : <?=$rowData->cmn_phone?> <br>
                       ที่อยู่ : <?=$rowData->cms_address?> <br>
                   

                        </td>
                        <td>
            <button class="btn btn-success btn-block" onclick="window.location.href='?zone=CompanyEdit&cmned=<?=$rowData->cmn_code?>'">แก้ไข
              
              </button>

              <button class="btn btn-danger btn-block" OnClick="move<?=$rowData->cmn_code?>();">ลบ
            
              </button>

              <script>
                        function move<?=$rowData->cmn_code?>() {
                          swal({
                            title: "ลบ <?=$rowData->cmn_name?> และข้อมูลที่เกี่ยวข้องออกจากระบบ",
                            text: "",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#DD6B55",
                            confirmButtonText: "ใช่!",
                            cancelButtonText: "ไม่ใช่!",
                            closeOnConfirm: false,
                            closeOnCancel: false
                          },
                          function(isConfirm){
                            if (isConfirm) {
                              swal("ทำรายการเรียบร้อย!", "ปิดหน้าต่างนี้เพื่อทำรายการใหม่", "success");
                            location.href = '?zone=CompanyData&DELCompany=<?=$rowData->cmn_code?>';
                            } else {
                              swal("ยกเลิกการทำรายการ", "ปิดหน้าต่างนี้เพื่อทำรายการใหม่", "error");
                            }
                          });
                        }
               </script>

                        </td>
                      </tr>
<?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>