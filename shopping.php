<?php

$brandsQuery = sprintf("SELECT * FROM Brands");
$brands = mysql_query($brandsQuery);
echo "<form action='/algims/index.php' method='GET'>";
echo "<select name='BrandID' size='10' multiple onchange='this.form.submit()'>";
while ($brand = mysql_fetch_assoc($brands)) {
	echo "<option value='".$brand['BrandID']."'>".$brand['BrandName']."</option>";
}
echo "<input type='hidden' name='action' value='printer'>";
echo "</form>"
?>