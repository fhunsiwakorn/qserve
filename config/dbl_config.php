<?php
date_default_timezone_set('Asia/Bangkok');
$name_system = "I-Survey"; ///สำหรับเปลี่ยนได้ .  Q-Service
$detail_system = "บริษัท ไอดีไดรฟ์ จำกัด  ( IDDRIVES .,Ltd )";
$actual_link_site = "https://survey.e-dct.com/"; ///สำหรับเปลี่ยนได้
$timestamp = strtotime('16-10-2019');
$version = "Version 2.1.$timestamp";

///แสดง Error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

///LOGO
$logo = "../images/images_web/003.jpg";
$logo2 = "../images/images_web/edit_new.png";
$logo3 = "../images/images_web/002_edits.jpg";



///
class Database
{
    private $host = "localhost";
    private $db_name = "qservice";
    private $username = "root";
    private $password =  "@P@SS.W0rd";
    public $conn;

    public function dbConnection()
    {

        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
