<?php

class SalesAdmin {
	  var $id;
	  var $firstname;
	  var $lastname;
	  
	  // create employee from array
	  function __construct($row) {
		  $this->id = $row ['id'];
		  $this->firstname = $row ['fname'];
		  $this->lastname = $row ['lname'];
			  
	  }
  }

?>
