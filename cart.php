<?php
if (!empty($_SESSION['cart']))
{
	$total = 0;
	$shippingCost = 0;
	echo "<form action='/algims/index.php?action=submitCart' method='POST'><table><th>Product Name</th><th>SKU</th><th>Product Price</th><th>Product Description</th><th>Product Weight</th><th>Quantity</th>";
	foreach($_SESSION['cart'] as $item) {
		$getCartItemsQuery = sprintf("SELECT *
		FROM Products
		WHERE SKU = '%s'", $item->sku);
		$getCartItems = mysql_query($getCartItemsQuery);
		while ($cartItems = mysql_fetch_assoc($getCartItems))
		{
			echo "<tr><td>".$cartItems['ProductName']."
	</td><td>".$cartItems['SKU']."
	</td><td>".$cartItems['ProductPrice']."
	</td><td>".$cartItems['ProductDescription']."
	</td><td>".$cartItems['ProductWeight']."
	</td><td>".$item->quantity."
	</td></tr>";
			$total += $cartItems['ProductPrice'];
		}
	};
	echo "<select name='shippingID'>";
	$getAllShippingOptionsQuery = sprintf("SELECT *
		FROM ShippingInformation");
	$getAllShippingOptions = mysql_query($getAllShippingOptionsQuery);
	while ($AllShippingOptions = mysql_fetch_assoc($getAllShippingOptions))
	{
		echo "<option value='".$AllShippingOptions['ShippingID']."'>".$AllShippingOptions['ShippingName']." ".$AllShippingOptions['ShippingRate']."</option>";
	}
	echo "</select><br />";
	
echo "Total Cost: $".$total." <input type='hidden' value='".$total."' name='total' /><input type='submit' value='Checkout'/></table></form>";
}


?>