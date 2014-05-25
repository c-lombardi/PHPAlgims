<?php
if (isset($_GET['error']))
{
	echo "<span class='error'>".$_GET['error']."</span>";
}
echo <<<_END
	<form method="POST"action="/algims/index.php?action=processCreateAccount"><br />
		FirstName: <input type='text' name='FirstName' /><br />
		LastName: <input type='text' name='LastName' /><br />
		Email: <input type='text' name='Email' /><br />
		Address: <input type='text' name='Address' /><br />
		City: <input type='text' name='City' /><br />
		ZipCode: <input type='text' name='ZipCode' /><br />
		PhoneNumber: <input type='text' name='PhoneNumber' /><br />
		CreditCardNumber: <input type='text' name='CreditCardNumber' /><br />
		StateID: <select name='StateID'>
_END;
		$StatesQuery = sprintf("SELECT * 
		FROM States");
		$States = mysql_query($StatesQuery);
		while ($State =  mysql_fetch_assoc($States))
		{
			echo "<option value='".$State['StateID']."'>".$State['StateName']."</option>";
		}
echo <<<_END
		</select><br />
		LoginPassword: <input type='text' name='LoginPassword' /><br />
		UserName: <input type='text' name='UserName' /><br />
		<input type='submit' value='Add Account' />
	</form>
_END;

?>
