<?php  
session_start();
//include "../salesperson/SalesPersonEntity.php";
//include "../inperson/InPersonEntity.php";
//include "../admin/SalesAdminEntity.php";
  // require_once 'dbconfig.php';
  
   if(isset($_POST['submit']) && $_POST['submit'] == 'login' &&$_POST['usertype'])
   {
	 $dsn = "mysql:host=students;dbname=un";
    // $username = "";
	$password = "psd";
	$username = "un";   
	$usertype = $_POST['usertype'];
	$uname = trim($_POST['username']);
	$pass = trim($_POST['password']);
	
  //  $password = md5($user_password);
	
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	 $query = "SELECT * FROM ".$usertype." WHERE id=".$uname." and password='".$pass."'";
	 $stmt = $pdo->prepare($query);
	 $stmt->execute();
	 $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 $count = $stmt->rowCount();
	 
	 if($count == 1){
	   $_SESSION['employee'] = $row;
	   if($usertype == 'inperson')
		   echo $row["type"];
		   else
		  echo "1";
	  	 }
	 else{
	  
	  echo "email or password does not exist."; // wrong details 
	 }
	  
	}
	catch(PDOException $e){
	 echo $e->getMessage();
	}
   }
?>