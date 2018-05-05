<?php  
   session_start();
//include "../salesperson/SalesPersonEntity.php";
//include "../inperson/InPersonEntity.php";
//include "../admin/SalesAdminEntity.php";
  // require_once 'dbconfig.php';
  
   if(isset($_POST['submit']) && $_POST['submit'] == 'addquote')
   {
	 $dsn = "mysql:host=students;dbname=z1791600";
    // $username = "";
	$password = "Shivaya.8513";
	$username = "z1791600";   	
	$sid = trim($_POST['empid']);
	$cid = trim($_POST['custid']);
	$cname = trim($_POST['custname']);
	$cemail = trim($_POST['custemail']);
	$semail = trim($_POST['empemail']);
	$qdescription = trim($_POST['qdescription']);
	$qprice = trim($_POST['qprice']);
	$qdiscount = trim($_POST['qdiscount']);
	$qsecretnotes = trim($_POST['qsecretnotes']);
	$qstatus = 'NEW';
	
  //  $password = md5($user_password);
	
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	 
	 $query = "Insert into quote(cid,sid,status,price,discount,description,secretnotes,custname,custemail,semail) values(".$cid.",".$sid.",'".$qstatus."',".$qprice.",".$qdiscount.",'".$qdescription."','".$qsecretnotes."',\"".$cname."\",'".$cemail."','".$semail."') ";
	// echo $query;
	 $stmt = $pdo->prepare($query);
	// $stmt->execute();
	 if($stmt->execute())
{
unset($prepared);
echo "1";
}
	 else{
	  
	  echo "Failed to insert. Please do check values"; // wrong details 
	 }
	  
	}
	catch(PDOException $e){
	 echo $e->getMessage();
	}
   }
  
?>
