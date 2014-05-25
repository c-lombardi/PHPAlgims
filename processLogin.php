<?php


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
	$checkIfAdminQuery = sprintf("SELECT a.AdminUserName, a.AdminEmail
		FROM Admins As a
		WHERE a.AdminUserName = '%s'
		AND a.AdminPassword = '%s'", $username, $password);
	$checkIfAdmin = mysql_query($checkIfAdminQuery);
	while ($ifAdmin = mysql_fetch_assoc($checkIfAdmin))
	{
		$_SESSION['admin'] = true;
		$_SESSION['username'] = $ifAdmin['AdminUserName'];
		$_SESSION['email'] = $exists['AdminEmail'];
		header('Location: /student5.upj.pitt.edu/algims/index.php?action=admin');
		die;	
	} 
	if (!$ifAdmin)
	{
		$checkIfRowExistsQuery = sprintf("SELECT l.UserName, l.Email
		FROM Logins As l
		WHERE l.LoginPassword = '%s' 
		AND l.UserName = '%s'", $password, $username);
		$checkIfRowExists = mysql_query($checkIfRowExistsQuery);
		while ($exists = mysql_fetch_assoc($checkIfRowExists))
		{
			$_SESSION['username'] = $exists['UserName'];
			$_SESSION['user'] = true;
			$_SESSION['email'] = $exists['Email'];
			header('Location: /algims/index.php?action=putCartData');
			die;
		}
	}
}
header('Location: student5.upj.pitt.edu/algims/index.php?action=shopping');
die;
?>