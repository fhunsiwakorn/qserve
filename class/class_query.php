<?php
class function_query
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
	
	public function insert($table, array $data)
{

    /*
     * Check for input errors.
     */
    if(empty($data)) {
        throw new InvalidArgumentException('Cannot insert an empty array.');
    }
    if(!is_string($table)) {
        throw new InvalidArgumentException('Table name must be a string.');
    }

    $fields = implode(",", array_keys($data));
    $placeholders = ':' . implode(", :", array_keys($data));

    $sql = "INSERT INTO {$table} ($fields) VALUES ({$placeholders})";

    // ///แสดง sql
	// echo "<center>";
	// var_dump($sql);
	// echo "</center>";

    // Prepare new statement
    $stmt = $this->conn->prepare($sql);

    /*
     * Bind parameters into the query.
     *
     * We need to pass the value by reference as the PDO::bindParam method uses
     * that same reference.
     */
    foreach($data as $placeholder => &$value) {

        // Prefix the placeholder with the identifier
        $placeholder = ':' . $placeholder;

        // Bind the parameter.
        $stmt->bindparam($placeholder, $value);

    }

    /*
     * Check if the query was executed. This does not check if any data was actually
     * inserted as MySQL can be set to discard errors silently.
     */

    if(!$stmt->execute()) {
        throw new ErrorException('Could not execute query');
    }

    /*
     * Check if any rows was actually inserted.
     */
    if($stmt->rowCount() == 0) {

        var_dump($this->pdo->errorCode());

        throw new ErrorException('Could not insert data into users table.');
    }

    return true;

}


public function update($table, array $data,array $Where)
{

    /*
     * Check for input errors.
     */
    if(empty($data)) {
        throw new InvalidArgumentException('Cannot insert an empty array.');
    }
    if(!is_string($table)) {
        throw new InvalidArgumentException('Table name must be a string.');
    }

	///fields update
    $fields = implode("', '", array_keys($data));
    $placeholders = ':' . implode(', :', array_keys($data));
	$fields5=array_keys($data);
	///fields where
	$fields2 = "'" . implode("', '", array_keys($Where)) . "'";
    $placeholders2 = ':' . implode(', :', array_keys($Where));

	$sql = "UPDATE  {$table} SET ";
	///fields update
	$keys = array_keys($data); 
	for($i = 0; $i < count($data); $i++)
	{

			$sql .= $keys[$i]."=:".$keys[$i] ;
		
		  
		 // Parse to add commas
		 if($i != count($data)-1)
		 {
			 $sql .= ',' ; 
		 }
	 }
	 $sql .= " WHERE ";
///fields Where
$keys2 = array_keys($Where); 
for($i = 0; $i < count($Where); $i++)
{
	// if(is_string($data[$keys[$i]])){
	// 	$sql .= $keys2[$i]."='".$Where[$keys2[$i]]."'" ;
	// }else{
	// 	$sql .= $keys2[$i]."=".$Where[$keys2[$i]] ;
	// }
	
	$sql .= $keys2[$i]."=:".$keys2[$i] ;
	  
	 // Parse to add commas
	 if($i != count($Where)-1)
	 {
		 $sql .= ' AND ' ; 
	 }
 }
	 ///แสดง sql
	// echo "<center>";
	// var_dump($sql);
	// echo "</center>";
    // Prepare new statement
    $stmt = $this->conn->prepare($sql);

    /*
     * Bind parameters into the query.
     *
     * We need to pass the value by reference as the PDO::bindParam method uses
     * that same reference.
     */
    foreach($data as $placeholder => &$value) {

        // Prefix the placeholder with the identifier
        $placeholder = ':' . $placeholder;

        // Bind the parameter.
        $stmt->bindparam($placeholder, $value);

    }

	foreach($Where as $placeholder2 => &$value2) {

        // Prefix the placeholder with the identifier
        $placeholder2 = ':' . $placeholder2;

        // Bind the parameter.
        $stmt->bindparam($placeholder2, $value2);

    }
    /*
     * Check if the query was executed. This does not check if any data was actually
     * inserted as MySQL can be set to discard errors silently.
     */
	
    if(!$stmt->execute()) {
        throw new ErrorException('Could not execute query');
    }

    /*
     * Check if any rows was actually inserted.
     */
    if($stmt->rowCount() == 0) {

        // var_dump($this->pdo->errorCode());

        throw new ErrorException('Could not insert data into users table.');
    }

    return true;

}

public function delete($table,$where){
	try
	{
	if($where==NULL)	{
		$stmt = $this->conn->prepare("DELETE FROM $table  WHERE $where ='$where' ");
	}else{
		$stmt = $this->conn->prepare("DELETE FROM $table");
	}
	
	$stmt->execute();
	return true;
}
catch(PDOException $e)
{
	echo $e->getMessage();
}

}

public function fastQuery($sql)
{
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt;
}

public function rowsQuery($sql)
{
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $total_data=$stmt->rowCount();
    return $total_data;
}

public function QueryField1($table,$fields,$where)
	{
		$stmt = $this->conn->prepare("SELECT $fields FROM $table WHERE $where");
		$stmt->execute();
		$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $dataRow["$fields"];
	}

public function QueryField2($table,$fields,$command,$where)
	{
        // $command= SUM,AVG,MAX,MIN
		$stmt = $this->conn->prepare("SELECT $command($fields) AS resultFields FROM $table WHERE $where");
		$stmt->execute();
		$dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $dataRow["resultFields"];
}

public function lookupfild($Field,$table,$Where,$Value)
{
    $stmt = $this->conn->prepare("SELECT $Field FROM $table WHERE $Where='$Value'");
    $stmt->execute();
    $dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
    return $dataRow[$Field];
}
////หาฟิวล่าสุดหรือเก่าสุด
public function lookupfild2($Field,$table,$Orderindex,$Orderby)
{
    $stmt = $this->conn->prepare("SELECT $Field FROM $table  ORDER BY $Orderindex $Orderby");
    $stmt->execute();
    $dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
    return $dataRow[$Field];
}
   
public function lookupfild3($Field,$table,$Condition)
{
    $stmt = $this->conn->prepare("SELECT $Field FROM $table WHERE $Condition");
    $stmt->execute();
    $dataRow=$stmt->fetch(PDO::FETCH_ASSOC);
    return $dataRow[$Field];
}

public function fechdata($table,$Condition)
{
    $req = $this->conn->prepare("SELECT * FROM $table WHERE $Condition");
    $req->execute();
    $data_fech = $req->fetchAll();
    return   $data_fech;
    
}



}
?>