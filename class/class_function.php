<?php
$date_default = date("Y-m-d");
///สร้างรหัส
function random_password($max_length = 20)
{
    $text = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $text_length = mb_strlen($text, 'UTF-8');
    $pass = '';
    for ($i = 0; $i < $max_length; $i++) {
        $pass .= @$text[rand(0, $text_length)];
    }
    return $pass;
}

function DateThai($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear";
}
function DateThai_2($strDate)
{
    $strYear = date("Y", strtotime($strDate)) + 543;
    $strMonth = date("n", strtotime($strDate));
    $strDay = date("j", strtotime($strDate));
    $strHour = date("H", strtotime($strDate));
    $strMinute = date("i", strtotime($strDate));
    $strSeconds = date("s", strtotime($strDate));
    $strMonthCut = array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
    $strMonthThai = $strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear, $strHour:$strMinute";
}

function DateDiff($strDate1, $strDate2)
{
    return (strtotime($strDate2) - strtotime($strDate1)) /  (60 * 60 * 24);  // 1 day = 60*60*24
}
function TimeDiff($strTime1, $strTime2)
{
    return (strtotime($strTime2) - strtotime($strTime1)) /  (60 * 60); // 1 Hour =  60*60
}
function DateTimeDiff($strDateTime1, $strDateTime2)
{
    return (strtotime($strDateTime2) - strtotime($strDateTime1)) /  (60 * 60); // 1 Hour =  60*60
}

//  echo "Date Diff = ".DateDiff("2008-08-01","2008-08-31")."<br>";
//  echo "Time Diff = ".TimeDiff("00:00","19:00")."<br>";
//  echo "Date Time Diff = ".DateTimeDiff("2008-08-01 00:00","2008-08-01 19:00")."<br>";

function DatetoYMD($sendDate1)
{
    ///2018-03-19
    $arrstartx2 = explode("/", $sendDate1);
    $stday2 = $arrstartx2[0];
    $stmonth2 = $arrstartx2[1];
    $styear2 = $arrstartx2[2];
    $udhd_affter = "$styear2-$stmonth2-$stday2";
    return $udhd_affter;
}


function DatetoDMY($sendDate2)
{
    // 10/05/2018
    $arrstartx = explode("-", $sendDate2);
    $stday = $arrstartx[0];
    $stmonth = $arrstartx[1];
    $styear = $arrstartx[2];
    $udhd_before = "$styear/$stmonth/$stday";
    return $udhd_before;
}

function DatetoDMYTime($sendDate2)
{

    $cut = explode(" ", $sendDate2);

    // 10/05/2018
    $arrstartx = explode("-", $cut[0]);
    $stday = $arrstartx[0];
    $stmonth = $arrstartx[1];
    $styear = $arrstartx[2];
    $udhd_before = "$styear/$stmonth/$stday" . " $cut[1]";
    return $udhd_before;
}


///ลบไฟล์
function delfile($namefile, $pathfile)
{
    $del_img_file = "$pathfile" . "/" . "$namefile";
    @unlink($del_img_file);
    return  $del_img_file;
}
///เพิ่มรูปภาพแบบ Resize
function add_images($tmp_name, $name, $pathimg)
{
    // $imageupload = $_FILES['imageupload']['tmp_name'];
    // $imageupload_name = $_FILES['imageupload']['name'];
    $imageupload = $tmp_name;
    $imageupload_name = $name;
    $arraypic = explode(".", $imageupload_name);
    $count = count($arraypic);
    $filename = $arraypic[0]; //ชื่อไฟล์
    $filetype = $arraypic[$count - 1]; //นามสกุลไฟล์
    if ($filetype == "gif" || $filetype == "jpg" || $filetype == "jpeg" || $filetype == "png" ||  $filetype == "JPG" ||  $filetype == "PNG" || $filetype == "png") {  ////ตรวจสอบระเภทรูปภาพ
        $newimage = random_password(6) . "." . $filetype;  ////Randomชื่อรูปภาพ
        copy($imageupload, "$pathimg" . $newimage); //อัพโหลดไปยัง folder
        ///Resize รูปภาพ
        $width = 600; //*** Fix Width & Heigh (Autu caculate) ***//
        $size = GetimageSize($imageupload);
        $height = round($width * $size[1] / $size[0]);
        // $images_orig = ImageCreateFromJPEG($imageupload); 
        //$images_orig = imagecreatefrompng($imageupload);
        if ($filetype == "jpg" || $filetype == "jpeg" || $filetype == "JPG") {
            $images_orig = ImageCreateFromJPEG($imageupload);
            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
            $images_fin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
            ImageJPEG($images_fin, "$pathimg" . $newimage);
            ImageDestroy($images_orig);
            ImageDestroy($images_fin);
        }
        return  $newimage;
    }
}

function add_file($tmp_name, $name, $pathimg)
{
    $name = $name;
    $tem = $tmp_name;
    $arraypic = explode(".", $name);
    $count = count($arraypic);
    $filename = $arraypic[0]; //ชื่อไฟล์
    $filetype = $arraypic[$count - 1]; //นามสกุลไฟล์
    if ($filetype == "docx" || $filetype == "xlsx" || $filetype == "pptx" || $filetype == "txt" ||  $filetype == "pdf") {
        $nf_name_data = random_password(12) . "." . $filetype;  ////Randomชื่อรูปภาพ
        copy($tem, "$pathimg" . $nf_name_data); //อัพโหลดไปยัง folder

        return  $nf_name_data;
    }
}


//////ฟังก์ชันหาเดือน โดยจาก Y-m-d
function Cut_mont2($date)
{
    $arrayd = explode("-", $date);
    $year = $arrayd[0]; //ปี
    $month = $arrayd[1]; //เดือน
    $day = $arrayd[2]; //วัน

    return $month;
}





// วันที่ ไป ยัง Timestamp
function dateToTime($datetime)
{
    $exp = explode(" ", $datetime);
    $t = explode(":", $exp[1]);
    $d = explode("-", $exp[0]);
    $timestamp = mktime($t[0], $t[1], $t[2], $d[1], $d[2], $d[0]);
    return $timestamp;
}

// Timestame ไปยังวันที่
function timeToDate($timestamp)
{
    //    $timestamp= date("Y-m-d H:i:s", $timestamp);
    $timestamp = date("Y-m-d", $timestamp);
    return $timestamp;
}

//LiNE Notify 
function send_line_notify($message, $token)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "message=$message");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    $headers = array("Content-type: application/x-www-form-urlencoded", "Authorization: Bearer $token",);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}
$message = 'ฉันตกหลุมรักเธอ';
$token = 'lvhdT6MXvnEr21P96A3yKORAxxUnbGCo8jBqXu9Njsu';

//    echo send_line_notify($message, $token);

// require '../plugins/phpmailer/PHPMailerAutoload.php';




// png=รูป ,css=ไฟล์css, javascript=ไฟล์ js

function base64_encode_image($filename)
{
    if ($filename) {
        $exp = explode(".", $filename);
        $filetype = $exp[1];
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:image/' . "png" . ';base64,' . base64_encode($imgbinary);
    }
}

function base64_encode_css($filename)
{
    if ($filename) {
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:text/' . "css" . ';base64,' . base64_encode($imgbinary);
    }
}
function base64_encode_jspath($filename)
{
    if ($filename) {
        $imgbinary = fread(fopen($filename, "r"), filesize($filename));
        return 'data:text/' . "javascript" . ';base64,' . base64_encode($imgbinary);
    }
}
// เปลี่ยนค่าติดลบ เป็น 0 
function positive_number($value)
{
    return ($value = (float)$value) < 0 ? 0 : $value;
}

////ลบไฟล์มั้งหมดใน folder
function remove_dir($dir)
{
    if (is_dir($dir)) {
        $dir = (substr($dir, -1) != "/") ? $dir . "/" : $dir;
        $openDir = opendir($dir);
        while ($file = readdir($openDir)) {
            if (!in_array($file, array(".", ".."))) {
                if (!is_dir($dir . $file)) {
                    @unlink($dir . $file);
                } else {
                    remove_dir($dir . $file);
                }
            }
        }
        closedir($openDir);
        ///ลบ folder
        // @rmdir($dir);
    }
}

function isMobile()
{
    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}
