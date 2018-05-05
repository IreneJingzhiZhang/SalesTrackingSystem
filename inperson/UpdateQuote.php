  <?php  
   //session_start();
//include "../salesperson/SalesPersonEntity.php";
//include "../inperson/InPersonEntity.php";
//include "../admin/SalesAdminEntity.php";
  // require_once 'dbconfig.php';
  
   if(isset($_POST['submit']) && $_POST['submit'] == 'updatequote')
   {
	 $dsn = "mysql:host=students;dbname=un";
    // $username = "";
	$password = "pwd";
	$username = "un";   	
	$qid = trim($_POST['qid']);	
	$qdiscount = trim($_POST['qdiscount']);
	if(!isset($_POST['type']))
	{
	$qprice = trim($_POST['qprice']);
	$qdescription = trim($_POST['qdescription']);	
	$qsecretnotes = trim($_POST['qsecretnotes']);	
	}
	
  //  $password = md5($user_password);
	
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	 if(isset($_POST['type']))
	{
		$query = "Update quote set discount = ".$qdiscount." where id =".$qid." ";
	}
	else
	{
	 $query = "Update quote set price = ".$qprice.",discount = ".$qdiscount.", description = '".$qdescription."',secretnotes = '".$qsecretnotes."' where id =".$qid." ";
	}
	 
	 //echo $query;
	 $stmt = $pdo->prepare($query);
	// $stmt->execute();
	 if($stmt->execute())
{
unset($prepared);
echo "1";
}
	 else{
	  
	  echo "Failed to update. Please do check values"; // wrong details 
	 }
	  
	}
	catch(PDOException $e){
	 echo $e->getMessage();
	}
   }
  
  
  
  
  
  

  
  
  
  
  
  ?>
