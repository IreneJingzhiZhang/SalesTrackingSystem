<?php

class Customer {
	  var $id;
	  var $name;
	  var $city;
	  var $street;
	  var $contact;
	  
	  // create employee from array
	  function __construct($row) {
		  $this->id = $row ['id'];
		  $this->name = $row ['name'];
		  $this->city = $row ['city'];
		  $this->street = $row ['street'];
		  $this->contact = $row ['contact'];		 	
	  }
  }

?>
