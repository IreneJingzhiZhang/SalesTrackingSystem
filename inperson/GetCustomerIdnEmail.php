  <?php  
   
//include "../salesperson/SalesPersonEntity.php";
//include "../inperson/InPersonEntity.php";
//include "../admin/SalesAdminEntity.php";
  // require_once 'dbconfig.php';
  include "../salesperson/CustomerEntity.php";
   if(isset($_POST['submit']) && $_POST['submit'] == 'getcustomer')
   {
	 $dsn = "mysql:host=blitz.cs.niu.edu;dbname=csci467";
    // $username = "";
	$password = "student";
	$username = "student";   
	$searchtext = trim($_POST['stext']);
		
  //  $password = md5($user_password);
	
	try
	{ 
	 $pdo = new PDO($dsn, $username, $password);
	 if(empty($searchtext))
	 $query = "SELECT * FROM customers";
	 else if (is_numeric ($searchtext))
	 $query = "SELECT * FROM customers WHERE id = ".$searchtext."";
	 else
	 $query = "SELECT * FROM customers WHERE name LIKE '%".$searchtext."%'";
	 //echo $query;
	 $stmt = $pdo->prepare($query);
	 $stmt->execute();
	 $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
	 $count = $stmt->rowCount();
	 
	 if($count > 0){
		 echo '<table class="table">
    <thead>
      <tr>
        <th>Customer Id</th>
        <th>Customer Name</th>
        <th>City</th>
		 <th>Contact</th>
		 <th>Add Quote</th>
      </tr>
    </thead>
    <tbody>';
	  foreach($rows as $row)
	  {
		  echo '<tr class="success">';
		  $cust = new Customer($row);
		  echo '<td> '. $cust->id .' </td>';
		   echo '<td> '. $cust->name .' </td>';
		    echo '<td> '. $cust->city .' </td>';
			 echo '<td> '. $cust->contact .' </td>';
			echo '<td> <button class="btn btn-success" id="btnAddQuote" type="button" value = "'. $cust->id .'::'.$cust->name.'">Add Quote</button></td>';
		  echo '</tr>';
	  }
	  echo '</tbody>';
	  echo '</table>';
	  	 }
	 else{
	  
	  echo "Customer doesn't exists"; // wrong details 
	 }
	  
	}
	catch(PDOException $e){
	 echo $e->getMessage();
	}
   }
  
  
  
  
  
  

  
  
  
  
  
  ?>
