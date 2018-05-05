<?php

class SalesPerson {
	  var $id;
	  var $firstname;
	  var $lastname;
	  var $email;
	  var $phone;
	  var $address;
	  var $city;
	  var $state;
	  var $salescommission;
	  // create employee from array
	  function __construct($row) {
		  $this->id = $row ['id'];
		  $this->firstname = $row ['firstname'];
		  $this->lastname = $row ['lastname'];
		  $this->email = $row ['email'];
		  $this->phone = $row ['phone'];
		  $this->address = $row ['address'];
		  $this->city = $row ['city'];
		  $this->state = $row ['state'];
		  $this->salecommission = $row ['salecommission'];		
	  }
  }

?>
