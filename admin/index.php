<?php
if(session_id() == '') {
	session_start();
}
session_save_path($_SERVER['DOCUMENT_ROOT']);

$admin = false;	
if (isset($_SESSION['admin']))
{
	$admin = true;	
}


ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');

if (!empty($_GET['action']))
{
	$page = $_GET['action'];
}
else
{
	$page = "login";
}
echo <<<_END
<html>
  <head>
    <title>Christopher Lombardi and Hannah Sell's Shopping Site</title>
    <link rel="stylesheet" type="text/css" href="../CSS/Site.css" />
  </head> 
  <body>
    <div id="frame">
	  <div id="page">

        <div id="header"><h1>
_END;
echo strtoupper("Inks 'R' Us - Admin");

echo <<<_END
		</h1></div>
		
		
_END;
if( !empty($_SESSION['admin']))
{
	echo "Hello ".$_SESSION['useremail'];	
}
echo <<<_END
      <div id="navigation"> 
_END;

if ($page == "orders")
{

echo <<<_END
			<button onclick="window.location='index.php?action=logOut'">Log Out</button>
			
_END;
}

if ($page == "orderDetails")
{

echo <<<_END
			<button onclick="window.location='index.php?action=logOut'">Login Out</button>
			<button onclick="window.location='index.php?action=orders'">Orders</button>
_END;
}


echo <<<_END
		</div>
		<hr>
        <div id="Title">
_END;
echo strtoupper($page);
echo <<<_END
		</div>
        <div id="page">
_END;

/*  Why not just add a .php to the action? */

switch ($page) {
	case "":
	case "login":
		require "login.php";
		break;
	case "orders":
		require "orders.php";
		break;
	case "orderDetails":
		require "orderDetails.php";
		break;
	case "logOut":
		require "logOut.php";
		break;
	default:	
		echo "undefined page";
		break;

}
echo <<<_END
			
			</div>
<hr>
        <div id="footer">All ink on this website is &#174C&H Industries and is subject to our respective imaginations.</div>

      </div>
    </div>
  </body>
</html>
_END;
?>
