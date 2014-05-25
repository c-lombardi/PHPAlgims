<?php
	session_start();
	if (empty ($_GET ['OrderID']))
	{
		header('Location:http://student5.upj.pitt.edu/algims/admin/index.php?action=orders');
		die;
	}
	if($orderid = $_GET['OrderID'])
	{
		$_SESSION['OrderID'] = $_GET['OrderID'];
		header('Location:http://student5.upj.pitt.edu/algims/admin/index.php?action=orderDetails');
		die;
	}
?>