<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<title>ADMIN | LPJ</title>
</head>
<body>

	<?php
if (isset($_POST['adminPass']) && strcmp($_POST['adminPass'], 'LpJr0cks20k5') == 0) {
	echo 'Bravo maggle';
}
	?>
	<form method="POST action="admin.php">
		<input id="adminPass" class="centre" type="password"/>
		<input type="submit"/>
	</form>
</body>
</html>