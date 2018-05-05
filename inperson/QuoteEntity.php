<?php


    class Quote {
	  var $id;
	  var $cid;
	  var $sid;
	  var $status;
	  var $price;
	  var $discount;
	  var $confirm_no;
	  var $comm_rate;
	  var $description;
	  var $secretnotes;
	  var $custname;
	  var $custemail;	
	  var $semail;	
	  // create employee from array
	  function __construct($row) {
		  $this->id = $row ['id'];
		  $this->cid = $row ['cid'];
		  $this->sid = $row ['sid'];
		  $this->status = $row ['status'];
		  $this->price = $row ['price'];
		  $this->discount = $row ['discount'];
		  $this->confirm_no = $row ['confirm_no'];
		  $this->comm_rate = $row ['comm_rate'];
		  $this->description = $row ['description'];
		  $this->secretnotes = $row ['secretnotes'];
		  $this->custname = $row ['custname'];
		  $this->custemail = $row ['custemail'];
		  $this->semail = $row ['semail'];
			  
	  }
  }

?>
