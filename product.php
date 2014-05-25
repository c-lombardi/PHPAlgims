<?php

if (isset($_POST['searchTerm']))
{
	$searchTerm = $_POST['searchTerm'];
}
if (isset($_GET['PrinterID']))
{
	$PrinterID = $_GET['PrinterID'];
}
if (!empty($PrinterID))
{
	$productsQuery = sprintf("SELECT p.ProductID, p.ProductName, p.SKU, p.ProductPrice, p.ProductDescription, p.ProductWeight
		FROM Products As p
		INNER JOIN PrinterCompatibilities As pc
		WHERE pc.PrinterID = '%d'
		AND p.ProductID = pc.ProductID", $PrinterID);
}
else if(!empty($searchTerm))
{
	$productsQuery = sprintf("SELECT p.ProductID, p.ProductName, p.SKU, p.ProductPrice, p.ProductDescription, p.ProductWeight
	FROM Products As p
	WHERE p.SKU LIKE '%s%%'
	OR p.ProductName LIKE '%s%%'
	OR p.ProductPrice LIKE '%s%%'
	OR p.ProductDescription LIKE '%s%%'
	OR p.ProductWeight LIKE '%s%%'", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm); 
	
}
else
{
	$productsQuery = sprintf("SELECT * FROM Products");
}
$products = mysql_query($productsQuery);
echo "";
echo "<table><th>Product Name</th><th>SKU</th><th>Product Price</th><th>Product Description</th><th>Product Weight</th><th>Quantity</th><th></th>";
while ($product = mysql_fetch_assoc($products)) {
	echo "<tr><form action='/algims/index.php?action=addToCart' method='POST'><td>".$product['ProductName']."
	</td><td>".$product['SKU']."
	</td><td>".$product['ProductPrice']."
	</td><td>".$product['ProductDescription']."
	</td><td>".$product['ProductWeight']."
	</td><td><input type='number' name='quantity' min='1'>
	</td><td><input type='hidden' name='SKU' value='".$product['SKU']."'/>
	</td><td><input type='submit' value='Add To Cart' />
	</td></form></tr>";
}
echo "</table>"
?>