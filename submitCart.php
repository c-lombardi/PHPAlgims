<?php
if (!empty($_SESSION['cart']) && $_SESSION['user'] && !empty($_POST['shippingID']))
{
	$shippingID = $_POST['shippingID'];	
	
	foreach($_SESSION['cart'] as $item) {
		$getCartIDsQuery = sprintf("SELECT *
		FROM ShoppingCarts As sc
		WHERE sc.SKU = '%s'
		AND sc.Email = '%s'", $item->sku, $_SESSION['email']);
		$getCartIDs = mysql_query($getCartIDsQuery);
		
		while ($cartIDs = mysql_fetch_assoc($getCartIDs))
		{
			
			$insertOrderQuery = sprintf("INSERT INTO Orders (ShippingID, StatusID)
				VALUES ('%d','%d')", $shippingID, 2);
			if (mysql_query($insertOrderQuery))
			{
				
				$insertID = mysql_insert_id();
				$insertOrderDetailsQuery = sprintf("INSERT INTO OrderDetails (ShoppingCartID, OrderID)
				VALUES ('%d', '%d')", $cartIDs['ShoppingCartID'], $insertID);
				if (mysql_query($insertOrderDetailsQuery))
				{
					$deleteCartQuery = sprintf("UPDATE `student5_Algims`.`ShoppingCarts`
					SET `Active` = '0'
					WHERE `ShoppingCarts`.`SKU` = '%s'
					AND `ShoppingCarts`.`Email` = '%s'", $item->sku, $_SESSION['email']);
					if (mysql_query($deleteCartQuery))
					{
						unset($_SESSION['cart']);
						header('Location: /algims/index.php?action=shopping');
						die;
					}	
				}
			}
		}
	}
}


?>
