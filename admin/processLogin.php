<?php
session_start();
$serverName = 'localhost:3306';
$userName = 'shoppers';
$password = '40129676';
$databaseName = 'student5_Algims';

$connection = mysql_connect($serverName, $userName, $password) or die (mysql_error());
$database = mysql_select_db($databaseName, $connection);

if (!empty($_POST['username']))
{
	$username = $_POST['username'];
}
if (!empty($_POST['password']))
{
	$password = $_POST['password'];
}


if (!empty($_POST['password']) && !empty($_POST['username']))
{
	$checkIfAdminQuery = sprintf("SELECT a.AdminUserName
		FROM Admins As a
		WHERE a.AdminUserName = '%s'
		AND a.AdminPassword = '%s'", $username, $password);
		

	$checkIfAdmin = mysql_query($checkIfAdminQuery);
	
	while ($ifAdmin = mysql_fetch_assoc($checkIfAdmin))
	{
		
		
		$_SESSION['admin'] = true;
		$_SESSION['useremail'] = $ifAdmin['AdminUserName'];
		header('Location: http://student5.upj.pitt.edu/algims/admin/index.php?action=orders');
		die;	
	} 
}
header('Location: http://student5.upj.pitt.edu/algims/admin/index.php?action=login');
die;
?>