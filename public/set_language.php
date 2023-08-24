<?php
require_once('../class/class_user.php');
$auth_user = new USER();
$country_id = isset($_SESSION['country_id']) ? $_SESSION['country_id'] : 1;

$flag_user=$sql_process->lookupfild("country_flag","tbl_master_country","country_id",$country_id);
$flag_name=$sql_process->lookupfild("country_name","tbl_master_country","country_id",$country_id);

// unset($_SESSION['cre_evalc_code']);
///Chk คำ
//ค้นหา
$txt1=$auth_user->mf("IQBHEMEPFRKVMXWMWQLB",$country_id);
//รูป
$txt2=$auth_user->mf("G1KL1UUGXY6N56F3I9Z",$country_id);
//ทำการประเมิน
$txt3=$auth_user->mf("F1THDXB73PEF3P8KJKGE",$country_id);
//คุณเคยทำแบบประเมินแล้ว
$txt4=$auth_user->mf("DRUXJ6B9R7A7O5MQ28",$country_id);
///กลับไปยังหน้าหลัก
$txt5=$auth_user->mf("4X1MKFGU9N9X9V1OJH8",$country_id);
///ประเมินให้กับ
$txt6=$auth_user->mf("V0MUNWY1006DJ6YC0ZA0",$country_id);
// ถัดไป
$txt7=$auth_user->mf("NACJ7UTDOXMIFJG",$country_id);
// กลับไปยังหน้าก่อนหน้า
$txt8=$auth_user->mf("71EQUHC3AI40FMM6GKJE",$country_id);
// แสดงความคิดเห็น
$txt9=$auth_user->mf("1SFC0YEI730XKEM7FZKF",$country_id);
// ชื่อ - นามสกุล
$txt10=$auth_user->mf("BZGTYZ2FJPVT4EXN42",$country_id);
// ข้อเสนอแนะ
$txt11=$auth_user->mf("C1CYSHCU106Q3E6T33OP",$country_id);
// เบอร์ติดต่อ
$txt12=$auth_user->mf("VCI6ZNFHXRURL4L1FAWN",$country_id);
// คะแนน
$txt13=$auth_user->mf("1P4XW0PEALXC62585AB",$country_id);
// ความคิดเห็น
$txt14=$auth_user->mf("ZDVME14A7RA7KCJ3G3RN",$country_id);
// : ชื่อ
$txt15=$auth_user->mf("4E6P6I7TFWPKUT2IHL80",$country_id);