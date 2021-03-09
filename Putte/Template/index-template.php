<?php
	
	require "masthead.php";
	require "menu.php";
	require "../include/connect.php";
	$username=$_SESSION['username'];

	$sql = "SELECT * FROM customers WHERE username=?";
	$res = $dbh->prepare($sql);
	$res->bind_param("s",$username);
	$res->execute();
	$result=$res->get_result();

	$row = $result->fetch_assoc();
	$str='';
	if($_SESSION['status'] == 1)
	{
		$str=<<<TABLE
	<tr>
		<th>Admin</th>
	</tr>
	<br>
	<br>
	<tr>
		<th>Användarnamn: </th>
		<td>{$row['username']} </td>
	</tr>
	<br>
	<tr>
		<th>Förstanamn: </th>
		<td>{$row['firstname']} </td>
	</tr>
	<br>
	<tr>
		<th>Efternamn:</th>
		<td>{$row['lastname']} </td>
	</tr>
	<br>
	<tr>
		<th>Adress: </th>
		<td>{$row['adress']} </td>
	</tr>
	<br>
	<tr>
		<th>Postkod: </th>
		<td>{$row['zip']} </td>
	</tr>
	<br>
	<tr>
		<th>Stad: </th>
		<td>{$row['city']} </td>
	</tr>
	<br>
	<tr>
		<th>Telefonnummer:</th>
		<td>{$row['phone']} </td>
	</tr>
TABLE;
	}

	else
	{
		$str = 'Startsida för min webbutik';
	}
?>
<!DOCTYPE html>
<html lang="sv">
	<head>
		<meta charset="utf-8">
		<title>Min onlinebutik</title>
		<link rel="stylesheet" href="css/stilmall.css">
	</head>
	<body id="index">
		<div id="wrapper">

			<main> <!--Huvudinnehåll-->
				<?php echo $str; ?>
			</main>


		</div>
		<!--Egen fil -->
		<?php
			require "footer.php";
		?>
    </body>
</html>