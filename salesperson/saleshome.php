<?php
session_start();
include "SalesPersonEntity.php";
if(!isset($_SESSION['employee']))
{
 header("Location: signin.php");
}

	$emp = new SalesPerson($_SESSION['employee']);
	
	if(empty($emp->email))
	{
		 header("Location: signin.php");
		}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <script type = "text/javascript" src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
$(document).ready(function()
{
$('#btngetCustomer').click(function(e)
{
e.preventDefault();

$.ajax({
type:"post",
dataType: "text",
url:"../php/GetCustomerDetails.php",
data:{submit:"getcustomer",stext:$('#customerdetails').val()},
success:function(res)
{
	
	
	$('#custDetails').html(res);
	
// window.location.href="http://students.cs.niu.edu/~z1791600/SalesTrackingSystem/salesperson/saleshome.php"
},
error:function(data)
{
alert(data);
}


});

}
);

$('#custDetails').on('click','#btnAddQuote',function(e)
{
	var cusdetails = this.value;
if(cusdetails)
{
	var res = cusdetails.split("::");	
	if(res)
	{
		if(res.length == 2)
		{
			
			$('#custid').val(res[0]);
			$('#custname').val(res[1]);
			$('#empid').val('<?php echo $emp->id ?>');
			$('#empemail').val('<?php echo $emp->email ?>');
			$('#qprice').val("");
			$('#qdiscount').val("");
			$('#qdescription').val("");
			$('#qsecretnotes').val("");
			$('#custemail').val("");			
			$('#largeModal').modal('show');
			
			}
	}

	
	
	}
});

$('#addquote').click( function(e)

{
	e.preventDefault();

$.ajax({
type:"post",
dataType: "text",
url:"InsertQuote.php",
data:{submit:"addquote",custid:$('#custid').val(),custname:$('#custname').val(),empid:$('#empid').val(),empemail:$('#empemail').val(),custemail:$('#custemail').val(),qprice:$('#qprice').val(),qdiscount:$('#qdiscount').val(),qsecretnotes:$('#qsecretnotes').val(),qdescription:$('#qdescription').val()},
success:function(res)
{
	
	
	if(res=="1")
	{
		alert("Quote has been inserted successfully");
		$('#largeModal').modal('hide');
		}
		else
{
	alert(res);
	}
	
// window.location.href="http://students.cs.niu.edu/~z1791600/SalesTrackingSystem/salesperson/saleshome.php"
},
error:function(data)
{
alert(data);
}


});

	
	
	});
	


});

</script>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Sales Tracking System</a>
        </div>
        
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="#">Add Quote<span class="sr-only">(current)</span></a></li>
            
          </ul>
         
          
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Add Quote</h1>  
        <div class="container">
          <form class="form-inline">
          <div class="form-group">
  
    <input type="text" class="form-control" id="customerdetails" placeholder="Enter customer id or name">
  
  </div>
          <button class="btn btn-success" id="btngetCustomer" type="button">Get Customer Info</button>
          
          </form>
          <div class="row">
          <div class="col-md-10">
          <div id="custDetails">
          </div>
</div>
</div>
          </div>
        </div>
      </div>
    </div>
<div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
          <label> Quote Details</label>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <!--  <h4 class="modal-title" id="myModalLabel">Cricket</h4> -->
          </div>
          <div class="modal-body">
            <div id="displayhere">
  <form role="form">
   <fieldset disabled>
  <div class="form-group">
   <label for="custid">Customer ID:</label>
  
    <input type="text" class="form-control" id="custid">
    
    </div>
     <div class="form-group">
    <label for="custname">Customer Name:</label>
    
    <input type="email" class="form-control" id="custname">
    
    </div>
    
     <div class="form-group">
     
   <label for="empid">Employee ID:</label>
   
    <input type="email" class="form-control" id="empid">
   
    </div>
     <div class="form-group">
     
     <label for="empmail">Employee Email:</label>
    
    <input type="email" class="form-control" id="empemail">
    
    </div>
    
 </fieldset>
  <div class="form-group">
     
     <label for="empmail">Customer Email:</label>
    
    <input type="email" class="form-control" id="custemail">
    
    </div>
     <div class="form-group">
   <label for="qprice">Price</label>
    <input type="text" class="form-control" id="qprice">    
    </div>
    
    <div>
    <label for="qdiscount">Discount:</label>
    <input type="text" class="form-control" id="qdiscount">
    </div>
     <div class="form-group">
   <label for="qsecretnotes">Scret Notes</label>
    <textarea  rows="5" class="form-control" id="qsecretnotes">
    </textarea>
    </div>
    <div class="form-group">
   <label for="qdescription">Description</label>
    <textarea  rows="5" class="form-control" id="qdescription">
    </textarea>
    </div>
  </form>
  		</div>
          </div>
          <div class="modal-footer">
           <button type="button" class="btn btn-default" id="addquote">Submit</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>            
          </div>
        </div>
      </div>
    </div>
     <!--footer class="footer">
      <div class="container">
        <p class="text-muted">Copy rights Grad 4. All rights reserved</p>
      </div>
    </footer-->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
