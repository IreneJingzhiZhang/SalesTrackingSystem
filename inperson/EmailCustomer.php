<?php
class EmailCustomer
{
public function getCustomerIdnEmail($quoteid)
  	{
	$dsn = "mysql:host=students;dbname=un";
	$password = "pwd";
	$username = "un";   	
	
	  
	 $pdo = new PDO($dsn, $username, $password);
	 $query = "select cid,custemail from quote where id =".$quoteid."";	   
	 $stmt = $pdo->prepare($query);
	 $stmt->execute();
	 $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 $count = $stmt->rowCount();
	 
	 if($count == 1){
	 $custom =  $this->getCustomerInfo($row['cid']);
	 
	 if(!empty($custom))
	 {
		$composed =  $this->composeEmail($custom['name']);
		if(!empty($composed))
		{
			//,,$custom['address']
			$this->sendEmail($row['custemail'],$composed);
	{
		}
	 }
	  	 }
	 else{
	  
	  echo "email or password does not exist."; // wrong details 
	 }
	  
	}
	
  }
	
	function getCustomerInfo($custId)
	{
		
	$dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";    
	$password = "student";
	$username = "student"; 
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	 $query = "SELECT name,city FROM customers WHERE id = ".$custId."";
	 $stmt = $pdo->prepare($query);
	 $stmt->execute();
	 $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 $count = $stmt->rowCount();
	 
	 if($count > 0){
		 return $row;
		 
	 }
	}
	catch(PDOException $e){
	 echo $e->getMessage();
	}
		
	}
	
	function composeEmail($name)
	{
		return "Hello ".$name." \n\n
		
		Your Recent Quote has been sanctioned. We are looking forward for a confirmation from you, so that we will proceed to the next steps. \n\n
		Regards,
		STS		
		";
		
	}
	
	function sendEmail($email,$composed)
	{
		//echo $email;
		//echo $composed;
		 mail($email, "Quote Status", $composed, "From:" . "z1791600@students.niu.edu");
		
	} 
}
  ?>