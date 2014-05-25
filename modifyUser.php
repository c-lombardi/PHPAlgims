<?php
if (isset($_POST['FirstName']))
	$FirstName = $_POST['FirstName'];
if (isset($_POST['LastName']))	
	$LastName = $_POST['LastName'];
if (isset($_POST['Email']))
	$Email = $_POST['Email'];
if (isset($_POST['Address']))
	$Address = $_POST['Address'];
if (isset($_POST['City']))
	$City = $_POST['City'];
if (isset($_POST['ZipCode']))
	$ZipCode = $_POST['ZipCode'];
if (isset($_POST['PhoneNumber']))
	$PhoneNumber = $_POST['PhoneNumber'];
if (isset($_POST['CreditCardNumber']))
	$CreditCardNumber = $_POST['CreditCardNumber'];
if (isset($_POST['StateID']))
	$StateID = $_POST['StateID'];

if (!empty($FirstName) && !empty($LastName) && !empty($Email) && !empty($Address) && !empty($City) && !empty($ZipCode) && !empty($PhoneNumber) && !empty($CreditCardNumber) && !empty($StateID))
{
	$checkIfAccountExistsQuery = sprintf("SELECT *
	FROM Users As u
	WHERE u.Email = '%s'", $_SESSION['email']);
	if (mysql_num_rows(mysql_query($checkIfAccountExistsQuery)>1))
	{
		header('Location: algims/index.php?action=editUser&error=ERROR:%20EMAIL%20INFORMATION%20IS%20ALREADY%20TAKEN');
		die;
	}
	$addAccountQuery = sprintf("UPDATE Users 
		SET FirstName = '%s', LastName = '%s', Email = '%s', Address = '%s', City = '%s', ZipCode = '%d', PhoneNumber = '%s', CreditCardNumber = '%s', StateID = '%d'
		WHERE Email = '%s'", $FirstName, $LastName, $Email, $Address, $City, $ZipCode, $PhoneNumber, $CreditCardNumber, $StateID, $_SESSION['email']);
	if(mysql_query($addAccountQuery))
	{
		$_SESSION['email'] = $Email;
		header('Location: /algims/index.php?action=shopping');
		die;
	}
}
header('Location: /algims/index.php?action=editUser&error=ERROR:%20MISSING%20DATA%20ON%20EDIT%20ACCOUNT%20FORM');
die;
?>