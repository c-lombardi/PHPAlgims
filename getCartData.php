<?

$getCartDataQuery = sprintf("SELECT * 
FROM ShoppingCarts As sc
WHERE sc.Email = '%s'
AND sc.Active > 0", $_SESSION['email']);
$getCartData = mysql_query($getCartDataQuery);
while($Cart = mysql_fetch_assoc($getCartData))
{
	$exists = false;
	foreach ($_SESSION['cart'] as $item)
	{
		if ($item->sku == $Cart['SKU'])
		{
			$exists = true;
			break 2;
		}
	}
	if ($exists == false)
	{
		$myCart = new Cart();
		$myCart->setQuantity($Cart['Quantity']);
		$myCart->setSKU($Cart['SKU']);
		$_SESSION['cart'][] = $myCart;
	}
}
header('Location: /algims/index.php?action=product');
die;
?>