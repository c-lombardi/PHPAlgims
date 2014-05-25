<?php

if (isset($_SESSION['admin']))
{
	header('Location: http://student5.upj.pitt.edu/algims/admin/index.php?action=orders');
}

echo <<<_END
	
	<form method="post" action="processLogin.php">
		UserName: <input type='text' name='username' /><br />
		Password: <input type='password' name='password' /><br />
		<input type='submit' value='Login' /><br />
	</form>
_END;
?>