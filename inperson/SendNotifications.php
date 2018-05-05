  <?php  
  

  
 class SendNotifications
{
  
 	public function getSalesPersonInfo($quoteid)
  	{
		
	$dsn = "mysql:host=students;dbname=un";
	$password = "pwd";
	$username = "un";   	
	
	  try{
	 $pdo = new PDO($dsn, $username, $password);
	 $query = "select sp.firstname,sp.lastname,q.semail from quote q,salesperson sp where q.id =".$quoteid." and q.sid = sp.id";	   
	 $stmt = $pdo->prepare($query);
	 $stmt->execute();
	 $row = $stmt->fetch(PDO::FETCH_ASSOC);
	 $count = $stmt->rowCount();
	 
	 if($count == 1){
	
	 
	 
		 $nam = $row['firstname'] . ", " . $row['lastname'];
		$composed =  $this->composeEmail($nam);
		if(!empty($composed))
		{
			//,,$custom['address']
			$this->sendEmail($row['semail'],$composed);
	
	 }
	  	 }
	 else{
	  
	  echo "email or password does not exist."; // wrong details 
	 }
	  }
	
	 catch(PDOException $e){
	 echo $e->getMessage();
	}
	}
	  
		
	
	public function composeEmail($name)
	{
		return "Hello ".$name." \n\n
		
		Your Recent Quote has been sanctioned. We will keep you updated with any further change on the quote status \n\n
		Regards,
		STS		
		";
		
	}
	
	public function sendEmail($email,$composed)
	{
		//echo $email;
		//echo $composed;
		 mail($email, "Quote Status", $composed, "From:" . "z1791600@students.niu.edu");
		
	} 
  
}  
  ?>
