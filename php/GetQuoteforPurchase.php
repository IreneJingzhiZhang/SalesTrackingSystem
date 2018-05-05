<?php 
   
//include "../salesperson/SalesPersonEntity.php";
//include "../inperson/InPersonEntity.php";
include "../inperson/QuoteEntity.php";
  // require_once 'dbconfig.php';
  include "../salesperson/CustomerEntity.php";
   if(isset($_POST['submit']) && $_POST['submit'] == 'getquote')
   {
	 $dsn = "mysql:host=students;dbname=un";
    // $username = "";
	$password = "pwd";
	$username = "un";   	
	$searchtext = trim($_POST['stext']);
		
  //  $password = md5($user_password);
	
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	 if(empty($searchtext))
	 $query = "SELECT * FROM quote where status='SANCTIONED'";
	 else if (is_numeric ($searchtext))
	 $query = "SELECT * FROM quote WHERE id = ".$searchtext." and status = 'SANCTIONED'";
	 else
	 $query = "SELECT * FROM quote WHERE custname LIKE '%".$searchtext."%' and status = 'SANCTIONED'";
	 //echo $query;
	 $stmt = $pdo->prepare($query);
	 $stmt->execute();
	 $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 $count = $stmt->rowCount();
	 
	 if($count > 0){
		 echo '<table class="table">
    <thead>
      <tr>
        <th>Quote Id</th>
		<th class="col-md-*">Sales Person Id</th>
        <th>Customer Name</th>
        <th>Status</th>
		 <th>Price</th>
		 <th>Discount</th>
		  <th>Description</th>
		 <th>Secret Notes</th>
		  <th>Customer Email</th>
		 <th>Customer Id</th>
      </tr>
    </thead>
    <tbody>';
	  foreach($rows as $row)
	  {
		  echo '<tr class="success">';
		  $quote = new Quote($row);
		  echo '<td> '. $quote->id .' </td>';
		   echo '<td> '. $quote->sid .' </td>';
		    echo '<td> '. $quote->custname .' </td>';
			 echo '<td> '. $quote->status .' </td>';
			 echo '<td> '. $quote->price .' </td>';
			 echo '<td> '. $quote->discount .' </td>';
			 echo '<td> '. $quote->description .' </td>';
			 echo '<td> '. $quote->secretnotes .' </td>';
			  echo '<td> '. $quote->custemail .' </td>';
			   echo '<td> '. $quote->cid .' </td>';
			echo '<td> <button class="btn btn-success" id="btnUpdateQuote" type="button" value = "'. $quote->id .'::'. $quote->sid .'::'. $quote->custname .'::'.$quote->status.'::'.$quote->price.'::'.$quote->discount.'::'.$quote->description.'::'. $quote->secretnotes .'::'. $quote->custemail .'::'. $quote->cid .'">Update Quote</button></td>';
			echo '<td> <button class="btn btn-success" id="btnCreatePurchase" type="button" value = "'. $quote->id .'::'.$quote->sid.'">Create Purchase Order</button></td>';
		  echo '</tr>';
	  }
	  echo '</tbody>';
	  echo '</table>';
	  	 }
	 else{
	  
	  echo "Sorry Quote(s) doesn't exist"; // wrong details 
	 }
	  
	}
	catch(PDOException $e){
	 echo $e->getMessage();
	}
   }
  
  
  
  
  
  

  
  
  
  
  
  ?>
