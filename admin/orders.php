<?php
if(session_id() == '') {
	session_start();
}

$serverName = 'localhost:3306';
$userName = 'shoppers';
$password = '40129676';
$databaseName = 'student5_Algims';

$connection = mysql_connect($serverName, $userName, $password) or die (mysql_error());
$database = mysql_select_db($databaseName, $connection);

if (!isset($_SESSION['admin']) || empty($_SESSION['admin']))
{
	header('Location: http://student5.upj.pitt.edu/algims/admin/index.php?action=login');
}
else
{
	$orderQuery = sprintf("SELECT o.OrderID, o.DateOrdered, s.OrderStatus
				  FROM Orders o INNER JOIN Statuses s
				  WHERE o.StatusID = s.StatusID
				  ORDER BY o.DateOrdered");

	$orders = mysql_query($orderQuery);
	
	//echo "<form action ='processing.php' method ='GET'>";
	echo "<table><th> OrderID </th><th> Date Ordered </th> <th> Order Status </th>";
	
	while($order = mysql_fetch_assoc($orders)) 
	{
		echo "<tr><form action ='processing.php' method ='GET'><td><button>".$order['OrderID']."</button></td><td>".$order['DateOrdered']."</td><td>".$order['OrderStatus'].
		"</td><td><input type = 'hidden' name = 'OrderID' value = '".$order['OrderID']."'/>  </form></td></tr>";
	}

	echo "</table>";



}

?>