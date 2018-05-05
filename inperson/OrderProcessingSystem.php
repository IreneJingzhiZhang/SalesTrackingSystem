<?php
class OrderProcessingSystem
{
public function getCommNConfDetails($qid)
{
$obj = $this->getQuotePriceandCustomer(trim($qid));
$fp = fsockopen( "udp://blitz.cs.niu.edu", 4446, $errno, $errstr );
if (!$fp) die("$errstr ($errno)<br>");
$message = "".trim($qid).":".trim($obj["custname"]).":".trim($obj["price"])."";
//echo $message."\n";
//echo "Sending: $message<br>";
fwrite( $fp, $message ) or die("write failed<br>");
$response = fread($fp, 1024);
fclose($fp);
//echo $response;
if(!empty($response))
{
	$details = explode("approved: " ,$response);
	$details1 = explode(":" ,$details[1]);
	$commissionper = trim(substr($details1[2], 0, -1));
	//echo $commissionper."    ".$details1[0];
	$commission = $this->calculateCommision(trim($obj["price"]),$commissionper);
	//echo "coom is : ". $commission;
	$this->InsertConfirmationNumber($qid,$details1[0]);
	$this->UpdateSalesCommision($qid,$commission);
}

}


public function getQuotePriceandCustomer($qid)
{
	//salescommission
	
	$dsn = "mysql:host=students;dbname=un";
    // $username = "";
	$password = "pwd";
	$username = "un";   	
	
	
	
  //  $password = md5($user_password);
	
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	$query = "select custname,price from quote where id = ".$qid."";
	 
	
	 $stmt = $pdo->prepare($query);
	 $stmt->execute();	 
	  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 $count = $stmt->rowCount();
	
	 if($count > 0){
		 foreach($rows as $row)
	  {	 
		 return $row;
		 }
		
	 }
	 
	  
	}
	catch(PDOException $e){
	 echo $e->getMessage();
	}
	
	
	
	}


public function calculateCommision($price,$compercent)
{
	//echo "price " .$price;
	//echo "percent " .$compercent;
	return ($price*$compercent/100.0);
	}

public function InsertConfirmationNumber($qid,$confNo)
{
	$dsn = "mysql:host=students;dbname=z1791600";   
	$password = "Shivaya.8513";
	$username = "z1791600"; 
	
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	 $query = "Update quote set confirm_no= ".$confNo." where id =".$qid."";
	// echo $query;
	 $stmt = $pdo->prepare($query);
	// $stmt->execute();
	 if($stmt->execute())
{
unset($stmt);

//echo "1";
}
	 else{
	  
	  echo "Failed to update. Please do check values"; // wrong details 
	 }
	  
	}
	catch(PDOException $e){
	 echo $e->getMessage();
	}
	
	}

public function UpdateSalesCommision($qid,$commission)
{
	//salescommission
	
	$dsn = "mysql:host=students;dbname=z1791600";
    // $username = "";
	$password = "Shivaya.8513";
	$username = "z1791600";   	
	
	
	
  //  $password = md5($user_password);
	
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	$query = "select sid from quote where id = ".$qid."";
	 
	
	 $stmt = $pdo->prepare($query);
	 $stmt->execute();	 
	  $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 $count = $stmt->rowCount();
	 
	 if($count > 0){
		 
		 unset($stmt);
		 foreach($rows as $row)
		 {
		 $query = "update salesperson set salescommission = salescommission + ".$commission." where id = ".trim($row["sid"])."";
		 $stmt = $pdo->prepare($query);
	     $stmt->execute();
		 break;
		 }
		 unset($stmt);
	 }
	 
	  
	}
	catch(PDOException $e){
	 echo $e->getMessage();
	}
	
	
	
	}

}
?>