<?

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
if (isset($_POST['LoginPassword']))
	$LoginPassword = $_POST['LoginPassword'];
if (isset($_POST['UserName']))
	$UserName = $_POST['UserName'];

if (!empty($FirstName) && !empty($LastName) && !empty($Email) && !empty($Address) && !empty($City) && !empty($ZipCode) && !empty($PhoneNumber) && !empty($CreditCardNumber) && !empty($StateID) && !empty($LoginPassword) && !empty($UserName))
{
	$checkIfAccountExistsQuery = sprintf("SELECT *
	FROM Users As u
	INNER JOIN Logins As l 
	WHERE u.Email = '%s' 
	AND l.UserName = '%s'", $Email, $UserName);
	$checkIfAccount = mysql_query($checkIfAccountExistsQuery);
	while($exists = mysql_fetch_assoc($checkIfAccount))
	{
		header('Location: /algims/index.php?action=createAccount&error=ERROR:%20USERNAME%20OR%20EMAIL%20INFORMATION%20IS%20ALREADY%20TAKEN');
		die;
	}
	$addAccountQuery = sprintf("INSERT INTO Users (FirstName, LastName, Email, Address, City, ZipCode, PhoneNumber, CreditCardNumber, StateID)
	VALUES ('%s','%s','%s','%s','%s','%d','%s','%s','%d')", $FirstName, $LastName, $Email, $Address, $City, $ZipCode, $PhoneNumber, $CreditCardNumber, $StateID);
	if(mysql_query($addAccountQuery))
	{
		$addLoginQuery = sprintf("INSERT INTO Logins (LoginPassword, UserName, Email)
		VALUES ('%s','%s','%s')", $LoginPassword, $UserName, $Email);
		if(mysql_query($addLoginQuery))
		{
			header('Location: /algims/index.php?action=login');
			die;
		}
	}
}
header('Location: /algims/index.php?action=createAccount&error=ERROR:%20MISSING%20DATA%20ON%20CREATE%20ACCOUNT%20FORM');
 die;
?>