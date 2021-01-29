<?php
	$dbh = new mysqli("localhost", "dbUser", "hej123", "webbshop");

if(!$dbh)
{
	echo "Ingen kontakt med databasen" ;
	exit;
}
?>