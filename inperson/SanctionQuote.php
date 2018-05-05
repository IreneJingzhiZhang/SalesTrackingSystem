  <?php  
   include 'EmailCustomer.php';
   include 'SendNotifications.php';
  
   if(isset($_POST['submit']) && $_POST['submit'] == 'sanctionquote')
   {
	
	$dsn = "mysql:host=students;dbname=un";
	$password = "pwd";
	$username = "un";   	
	$qid = trim($_POST['qid']);	
	$sid = trim($_POST['sid']);	
 
	
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	 $query = "Update quote set status= 'SANCTIONED' where id =".$qid." and sid= ".$sid." ";
	// echo $query;
	 $stmt = $pdo->prepare($query);
	// $stmt->execute();
	 if($stmt->execute())
{
	$cusmailobj = new EmailCustomer();
	 $cusmailobj->getCustomerIdnEmail($qid);
	 $spObj = new SendNotifications();
	 $spObj->getSalesPersonInfo($qid);
	
unset($stmt);
	

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
