<?php


    class InPerson {
	  var $id;
	  var $firstname;
	  var $lastname;
	  var $type;	
	  // create employee from array
	  function __construct($row) {
		  $this->id = $row ['id'];
		  $this->firstname = $row ['fname'];
		  $this->lastname = $row ['lname'];
		  $this->type = $row ['type'];
			  
	  }
  }

?>
