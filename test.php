<?php 
	$host="192.168.1.101";
	$username="root";
	$password="";
	$database="network";
	$conn= mysqli_connect($host,$username,$password,$database);
	if (mysqli_connect_errno())
	{
		die(mysqli_connect_error());
	}
	date_default_timezone_set('Asia/Kolkata');
?>
