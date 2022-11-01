<!DOCTYPE html>
<html>
<head>
<?php
	require_once ("connectdb.php");
	$db = new PDO("mysql:dbname=$db_name;host=$db_host", $username, $password); 
	$rows = $db->query("SELECT * FROM product_table");
?>
</head>
<body>
<h1>
    <?php 
    foreach ($rows as $row) {
    ?>
<br>
ID: <?=$row['ID']?>
<br>
NAME: <?=$row['NAME']?>
<br>
DESCRIPTION: <?=$row['DESCRIPTION']?>
<br>
PRICE: <?=$row['PRICE']?>
<br>
CATEGORY: <?=$row['CATEGORY']?>
<br>
<?php echo '<img width="400" height="300" src="data:image/jpeg;base64,'.base64_encode( $row['IMG'] ). '"/>'; ?>
<?php
    }
?>
<br>
</body>
</html>