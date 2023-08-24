<?php

class USER
{

	private $conn;

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	


	public function doLogin($username,$password)
	{
		try
		{

$stmt = $this->conn->prepare("SELECT
tbl_user.user_id,
tbl_user.user_password,
tbl_user.user_status
FROM 
tbl_user
WHERE
tbl_user.user_name=:user_name_login AND tbl_user.is_delete='1'");
$stmt->execute(array(':user_name_login'=>$username));
			  $row=$stmt->fetch(PDO::FETCH_ASSOC);
			  if (password_verify($password, $row['user_password']) && $stmt->rowCount() == 1) {
				$_SESSION['userSession'] = $row['user_id'];
				$_SESSION['user_status'] = $row['user_status'];
					return true;
			  } else{
			   	return false;
			  }

		}
		catch(PDOException $e)
		{
			echo $e->getMessage();
		}
	}

	public function is_loggedin()
	{
		if(isset($_SESSION['userSession']))
		{
			return true;
		}
	}

	public function redirect($url)
	{
		header("Location: $url");
	}

	public function doLogout()
	{
		session_destroy();
		unset($_SESSION['userSession']);
		return true;
	}

	public function mf($stlg_code,$country_id)
	{
	
		$stmt = $this->conn->prepare("SELECT stlg_text FROM tbl_system_language WHERE stlg_code='$stlg_code' AND country_id='$country_id'");
		$stmt->execute();
		$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $dataRow["stlg_text"];
	}
	
}


?>
