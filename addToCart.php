<?php

if (!empty($_POST['quantity']))
{
	$quantity = $_POST['quantity'];	
}
if (!empty($_POST['SKU']))
{
	$SKU = $_POST['SKU'];
}
if (!empty($_POST['quantity']) && !empty($_POST['SKU']))
{
	$count = -1;
	foreach ($_SESSION['cart'] as $item)
	{
		$count++;
		if ($item->sku == $_POST['SKU'])
		{
			unset($_SESSION['cart'][$count]);
			break;	
		}	
	}
	$myCart = new Cart();
	$myCart->setQuantity($_POST['quantity']);
	$myCart->setSKU($_POST['SKU']);
	$_SESSION['cart'][] = $myCart;
}
if (isset($_SESSION['user']))
{
	if ($_SESSION['user'] == true)
	{
		$checkIfRowExistsQuery = sprintf("SELECT *
		FROM ShoppingCarts As sc
		WHERE sc.Email = '%s' 
		AND sc.SKU = '%s'
		AND sc.Active = 1", $_SESSION['email'], $SKU);
		$checkIfRowExists = mysql_query($checkIfRowExistsQuery);
		$exists = mysql_fetch_assoc($checkIfRowExists);
		if (!$exists && !empty($_POST['SKU'])  && !empty($_POST['quantity']))
		{
			$insertIntoCartQuery = sprintf("INSERT INTO ShoppingCarts(Email, Quantity, SKU, Active)
		VALUES ('%s', '%d', '%s', 1)", $_SESSION['email'], $quantity, $SKU, 1);
			if($insertIntoCart = mysql_query($insertIntoCartQuery));
			{
				header('Location: /algims/index.php?action=cart');
				die;
			}
		}
		else if($exists && !empty($_POST['SKU'])  && !empty($_POST['quantity']))
		{
			$updateCartQuery = sprintf("UPDATE `student5_Algims`.`ShoppingCarts`
		SET `Quantity` = '%d'
		WHERE `ShoppingCarts`.`Email` = '%s'
		AND `ShoppingCarts`.`SKU` = '%s'", $quantity, $_SESSION['email'], $SKU);
			if ($updateCartQuery = mysql_query($updateCartQuery))
			{
				header('Location: /algims/index.php?action=cart');
				die;
			}
		}
	}
}
?>