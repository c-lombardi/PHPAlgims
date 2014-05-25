<?php


foreach ($_SESSION['cart'] as $item)
{
	$checkIfCartExistsQuery = sprintf("SELECT sc.Email, sc.SKU
	FROM ShoppingCarts As sc
	WHERE sc.Email = '%s'
	AND sc.SKU = '%s'
	AND sc.Active = 1", $_SESSION['email'], $item->sku);
	if(mysql_num_rows(mysql_query($checkIfCartExistsQuery)) > 0)
	{
		$updateCartItemQuery = sprintf("UPDATE ShoppingCarts
		SET Quantity = '%d'
		WHERE Email = '%s' 
		AND SKU = '%s'", $item->quantity, $_SESSION['email'], $item->sku);
		if(mysql_query($updateCartItemQuery))
		{
		
		}
		else
		{
			header('Location: /algims/index.php?action=printer');
			die;
		}
	}
	else
	{
		$insertCartItemQuery = sprintf("INSERT INTO ShoppingCarts (Email, Quantity, SKU, Active)
		VALUES ('%s','%d','%s',1)", $_SESSION['email'], $item->quantity, $item->sku);
		if(mysql_query($insertCartItemQuery))
		{
			
		}
		else
		{
			header('Location: student5.upj.pitt.edu/algims/index.php?action=login');
			die;
		}
	}
}
header('Location: /algims/index.php?action=getCartData');
die;
?>