<?php
if (!empty($_GET['error']))
{
	echo "<span style='color:red;font-size:28;'>".$_GET['error']."</span>";	
}
$GetUserInfoQuery = sprintf("SELECT *
	FROM Users As u
	WHERE u.Email = '%s'", $_SESSION['email']);
$GetUserInfo = mysql_query($GetUserInfoQuery);
while ($GetUser = mysql_fetch_assoc($GetUserInfo))
{
	echo"
	<form method='POST'action='/algims/index.php?action=modifyUser'><br />
			FirstName: <input type='text' name='FirstName' value='".$GetUser['FirstName']."'/><br />
			LastName: <input type='text' name='LastName'  value='".$GetUser['LastName']."'/><br />
			Email: <input type='text' name='Email' value='".$GetUser['Email']."' /><br />
			Address: <input type='text' name='Address' value='".$GetUser['Address']."' /><br />
			City: <input type='text' name='City' value='".$GetUser['City']."' /><br />
			ZipCode: <input type='text' name='ZipCode' value='".$GetUser['ZipCode']."' /><br />
			PhoneNumber: <input type='text' name='PhoneNumber' value='".$GetUser['PhoneNumber']."' /><br />
			CreditCardNumber: <input type='text' name='CreditCardNumber' value='".$GetUser['CreditCardNumber']."' /><br />
			StateID: <select name='StateID'>";
		$StatesQuery = sprintf("SELECT * 
			FROM States");
		$States = mysql_query($StatesQuery);
		while ($State =  mysql_fetch_assoc($States))
		{
		if ($GetUser['StateID'] == $State['StateID'])
			{
				echo "<option selected value='".$State['StateID']."'>".$State['StateName']."</option>";
			}
			else
			{
				echo "<option value='".$State['StateID']."'>".$State['StateName']."</option>";
			}
		}
echo <<<_END
			</select><br />
			<input type='submit' value='Update' />
		</form>
_END;
}
?>