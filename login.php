<?php
echo <<<_END
	
	<form method="post" action="/algims/index.php?action=processLogin">
		UserName: <input type='text' name='username' /><br />
		Password: <input type='password' name='password' /><br />
		<input type='submit' value='Login' /><br />
	</form>
_END;
?>