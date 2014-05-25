<?php

if (isset($_SESSION['email']) && $_SESSION['user'] == true)
{
	$getOrdersQuery = sprintf("SELECT o.DateOrdered, sc.Quantity, sc.SKU, p.ProductName, p.ProductPrice, p.ProductDescription, p.ProductWeight, s.ShippingName, s.ShippingRate
		FROM Orders As o
		INNER JOIN OrderDetails As od
		INNER JOIN ShoppingCarts As sc
		INNER JOIN Products As p
		INNER JOIN ShippingInformation As s
		WHERE sc.Email = '%s'
		AND od.ShoppingCartID = sc.ShoppingCartID
		AND o.OrderID = od.OrderID
		AND s.ShippingID = o.ShippingID
		AND p.SKU = sc.SKU ", $_SESSION['email']); 
	$getOrders = mysql_query($getOrdersQuery);
	echo "<table><th>Product Name</th><th>Product Price</th><th>Quantity</th><th>Product Description</th><th>Product Weight</th><th>Shipping Method</th><th>Date Ordered</th><th>Total Cost</th>";
	while($Orders = mysql_fetch_assoc($getOrders))
	{
		echo "<tr><td>".$Orders['ProductName']."</td><td>".$Orders['ProductPrice']."</td><td>".$Orders['Quantity']."</td><td>".$Orders['ProductDescription']."</td><td>".$Orders['ProductWeight']."</td><td>".$Orders['ShippingName']."</td><td>".$Orders['DateOrdered']."</td><td>".(($Orders['Quantity']*$Orders['ProductPrice'])+$Orders['ShippingRate'])."</td></tr>";
	}
	echo "</table>";
}

?>