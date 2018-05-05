  <?php  
  // session_start();
include "OrderProcessingSystem.php";
include "SendNotifications.php";
//include "../inperson/InPersonEntity.php";
//include "../admin/SalesAdminEntity.php";
  // require_once 'dbconfig.php';
  
   if(isset($_POST['submit']) && $_POST['submit'] == 'createpurchase')
   {
	 $dsn = "mysql:host=students;dbname=un";
    // $username = "";
	$password = "pwd";
	$username = "un";   	
	$qid = trim($_POST['qid']);	
	$sid = trim($_POST['sid']);	
	
  //  $password = md5($user_password);
	
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	 $query = "Update quote set status= 'COMPLETED' where id =".$qid." and sid= ".$sid." ";
	// echo $query;
	 $stmt = $pdo->prepare($query);
	// $stmt->execute();
	 if($stmt->execute())
{
unset($stmt);
$ops = new OrderProcessingSystem();
$ops->getCommNConfDetails(trim($qid));
$notify = new SendNotifications();
$notify->getSalesPersonInfo(trim($qid));
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
