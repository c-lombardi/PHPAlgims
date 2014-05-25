<?php

if (isset($_GET['BrandID']))
{
	$BrandID = $_GET['BrandID'];
}
if (!empty($BrandID))
{
	$printersQuery = sprintf("SELECT p.PrinterName, p.PrinterID
		FROM Printers As p
		INNER JOIN BrandCompatibilities As bc
		WHERE bc.BrandID = '%d'
		AND p.PrinterID = bc.PrinterID", $BrandID);
}
else
{
	$printersQuery = sprintf("SELECT * FROM Printers");
}
$printers = mysql_query($printersQuery);
echo "<form action='/algims/index.php' method='GET'>";
echo "<select name='PrinterID' multiple size='10' onchange='this.form.submit()'> ";
while ($printer = mysql_fetch_assoc($printers)) {
	echo "<option value='".$printer['PrinterID']."'>".$printer['PrinterName']."</option>";
}
echo "<input type='hidden' name='action' value='product'>";
echo "</form>"
?>