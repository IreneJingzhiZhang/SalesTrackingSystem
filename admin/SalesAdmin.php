<?php
session_start();
include "SalesAdminEntity.php";
if(!isset($_SESSION['employee']))
{
 header("Location: signin.php");
}
else
{
	 $emp = new SalesAdmin (  $_SESSION['employee'] );
	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login Form using jQuery Ajax and PHP MySQL</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link href="style.css" rel="stylesheet" media="screen">

</head>

<body>

<div class="container">
    <div class='alert alert-success'>
  <button class='close' data-dismiss='alert'>&times;</button>
   <strong>Hello '<?php 
   
   echo $emp ->id; ?></strong>  Welcome to the members page.
    </div>
</div>

</div>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>