<?php

$serverName = 'localhost:3306';
$userName = 'shoppers';
$password = '40129676';
$databaseName = 'student5_Algims';

$connection = mysql_connect($serverName, $userName, $password) or die (mysql_error());
$database = mysql_select_db($databaseName, $connection);

$orderID = $_SESSION['OrderID'];

if (!isset($_SESSION['admin']) || empty($_SESSION['admin']) )
{
	header('Location: http://student5.upj.pitt.edu/algims/admin/index.php?action=login');
}

else
{
	$orderQuery = sprintf("SELECT p.ProductName, u.FirstName, u.LastName, sc.Email, u.Address, u.City, 
							u.ZipCode,u.PhoneNumber, u.CreditCardNumber, st.StateName
							FROM OrderDetails od INNER JOIN Orders o ON (od.OrderID = o.OrderID)
							INNER JOIN ShoppingCarts sc ON (sc.ShoppingCartID = od.ShoppingCartID)
							INNER JOIN Products p ON (p.SKU = sc.SKU)
							INNER JOIN Users u ON (u.Email = sc.Email)
							INNER JOIN States st ON (u.StateID = st.StateID)
							WHERE o.OrderID ='%d'",$orderID);
							

	$orders = mysql_query($orderQuery);
	
	echo "<table><th> Items </th>";
	while($order = mysql_fetch_assoc($orders))
	{
		echo "<tr><td>".$order['ProductName']."</td></tr>";
	}
	echo "</table>";
	
	
	$orderDTQuery = sprintf("SELECT p.ProductName, u.FirstName, u.LastName, sc.Email, u.Address, u.City, 
							u.ZipCode,u.PhoneNumber, u.CreditCardNumber, st.StateName
							FROM OrderDetails od INNER JOIN Orders o ON (od.OrderID = o.OrderID)
							INNER JOIN ShoppingCarts sc ON (sc.ShoppingCartID = od.ShoppingCartID)
							INNER JOIN Products p ON (p.SKU = sc.SKU)
							INNER JOIN Users u ON (u.Email = sc.Email)
							INNER JOIN States st ON (u.StateID = st.StateID)
							WHERE o.OrderID ='%d'",$orderID);
	$ordersDT = mysql_query($orderDTQuery);
	
	echo "<table><th> First Name </th><th> Last Name </th><th> Email </th><th> Address </th><th> City </th>
			<th> State </th><th> Zip </th><th> Phone </th><th> Credit Card Number </th>";
	if($orderDT = mysql_fetch_assoc($ordersDT))
	{
	echo "<tr><td>".$orderDT['FirstName']."</td><td>".$orderDT['LastName']."</td><td>"
	.$orderDT['Email']."</td><td>".$orderDT['Address']."</td><td>".$orderDT['City']."</td><td>".$orderDT['StateName'].
	"</td><td>".$orderDT['ZipCode']."</td><td>".$orderDT['PhoneNumber']."</td><td>".$orderDT['CreditCardNumber']."</td></tr>";
	}
	echo "</table>";
}

?>