<?php

class Cart
{
	public $quantity;
	public $sku;
	
	public function setQuantity($q) { 
		$this->quantity = $q; 
	}
	
	public function setSKU($s) { 
		$this->sku = $s; 
	}
	
	public function getQuantity($q) { 
		return $this->quantity; 
	}
	
	public function getSKU($s) { 
		return $this->sku; 
	}
	
}
session_start();
$user = false;
if (isset($_SESSION['user']))
{
	$user = true;
}
$admin = false;	
if (isset($_SESSION['admin']))
{
	$admin = true;	
}

//SQL to get all brands
$serverName = 'localhost:3306';
$userName = 'shoppers';
$password = '40129676';
$databaseName = 'student5_Algims';

$connection = mysql_connect($serverName, $userName, $password) or die (mysql_error());
$database = mysql_select_db($databaseName, $connection);

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
ini_set('display_startup_errors', 'On');
if (!empty($_GET['action']))
{
	$page = $_GET['action'];
}
else
{
	$page = "shopping";
}
echo <<<_END
<html>
  <head>
    <title>Christopher Lombardi and Hannah Sell's Shopping Site</title>
    <link rel="stylesheet" type="text/css" href="CSS/Site.css" />
  </head> 
  <body>
    <div id="frame">
	  <div id="page">

        <div id="header"><h1>
_END;
echo strtoupper("Inks 'R' Us");
echo <<<_END
		</h1></div>
		<div id="searchBar">
		<form method="POST" action="/algims/index.php?action=product">
			<input type='text' name='searchTerm'  placeholder="Enter search text here" />
			<input type='submit' value='Search' />
		</form>
		</div>
_END;
if(!empty($_SESSION['user']) || !empty($_SESSION['admin']))
{
	echo "Hello ".$_SESSION['username'];	
}
echo <<<_END
        <div id="navigation">
_END;
if ($admin)
{
echo <<<_END
			<button onclick="window.location='index.php?action=admin'">Admin</button>
_END;
}
if ($user)
{
echo <<<_END
			<button onclick="window.location='index.php?action=orders'">View Your Orders</button>
			<button onclick="window.location='index.php?action=editUser'">Edit Your Account</button>
_END;
}
if (!$user && !$admin)
{
echo <<<_END
			<button onclick="window.location='index.php?action=login'">Login</button>
			<button onclick="window.location='index.php?action=createAccount'">Create Account</button>
_END;
}
echo <<<_END
			<button onclick="window.location='index.php?action=shopping'">Shopping</button>
			<button onclick="window.location='index.php?action=cart'">Shopping Cart</button>
_END;
if ($user || $admin)
{
echo <<<_END
			<form method="POST"action="/algims/index.php?action=logOut">
				<input type='submit' value='Log Out' />
			</form>
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
	case "admin":
		if (!$admin)
			require "admin.php";
		break;
	case "shopping":
		require "shopping.php";
		break;
	case "printer":
		require "printer.php";
		break;
	case "login":
		if (!$user && !$admin)
			require "login.php";
		break;
	case "cart":        
		require "cart.php";
		break;
	case "product":
		require "product.php";
		break;
	case "orders":
		if ($user)
			require "orders.php";
		break;
	case "editUser":
		if ($user)
			require "editUser.php";
		break;
	case "modifyUser":
		if ($user)
			require "modifyUser.php";
		break;
	case "checkout":
		require "checkout.php";
		break;
	case "createAccount":
		if (!$user && !$admin)
			require "createAccount.php";
		break;	
	case "putCartData":
		require "putCartData.php";
		break;
	case "getCartData":
		require "getCartData.php";
		break;
	case "processLogin":
		require "processLogin.php";
		break;
	case "processCreateAccount":
		require "processCreateAccount.php";
		break;
	case "logOut":
		require "logOut.php";
		break;
	case "addToCart":
		require "addToCart.php";
		break;
	case "submitCart":
		require "submitCart.php";
		break;
	default:	
		require "shopping.php";
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
