<?php
    if(isset($_POST['username']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset ($_POST['adress']) && isset ($_POST['zip']) && isset ($_POST['city']) && isset ($_POST['phone']) && isset($_POST['password'])){
        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW);
        $adress = filter_input(INPUT_POST,'adress',FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
	    $zip = filter_input(INPUT_POST, 'zip',FILTER_SANITIZE_NUMBER_INT );
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
        $phone = filter_input(INPUT_POST, 'phone',FILTER_SANITIZE_NUMBER_INT);
        $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
		$username = filter_input(INPUT_POST,'username',FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
    }

    require "../include/connect.php";

    // Kontrollera om användaren redan finns
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";
    $res = $dbh -> prepare($sql);
    $res -> bind_param("ss",$username, $mail);
    $res -> execute();
    $result = $res->get_result();
    $row=$result->fetch_assoc();

    //Om en användare redan finns
    if($row !== NULL){
        if($row['username']=== $username){
            header("location:createUser.php?name=$username");
        }

        elseif($row['email'] === $mail){
            header("location:createUser.php?mail=$mail");
        } 
    }
    $str="";

    if(isset($_GET['name'])){
        $usr = $_GET['name'];
        $str = "Användarnamnet $usr är upptaget";
    }
    if(isset($_GET['mail'])){
        $ma = $_GET['mail'];
        $str = "Mailadressen $ma är upptaget";
    }

    //Användaren finns inte i databasen
    else{
        $status = 1;//vanlig användare
        //Tabellen users
        $sql = "INSERT INTO users(username, email, password, status) VALUE (?,?,?,?)";
        $res=$dbh->prepare($sql);
        $res->bind_param("sssi", $username, $mail, $password, $status);
        $res->execute();

        //Tabellen customers
        $sql = "INSERT INTO customers(username, firstname, lastname, adress, zip, city, phone) VALUE (?,?,?,?,?,?,?)";
        $res=$dbh->prepare($sql);

        $str="användare tillagd";
    }

    if($str == ""){
        $str =<<<FORM
        <form action="login2.php" method="post">
        <p><label for="fname">Förnamn:</label>
        <input type="text" id="fname" name="fname"></p>
        <p><label for="enamn">Efternamn:</label>
        <input type="text" id="ename" name="ename"></p>
        <p><label for="mail">Epost:</label>
        <input type="email" id="mail" name="mail"></p>
        <p><label for="adress">Adress:</label>
        <input type="text" id="adress" name="adress"></p>
        <p><label for="zip">Postnummer:</label>
        <input type="text" id="zip" name="zip"></p>
        <p><label for="ort">Postort:</label>
        <input type="text" id="ort" name="ort"></p>
        <p><label for="nummer">Telefon:</label>
        <input type="text" id="nummer" name="nummer"></p>
        <p><label for="pwd">Lösenord:</label>
        <input type="password" id="pwd" name="password"></p>
        <p>
        <input type="submit" value="Skapa användare">
        </p>
        </form>
FORM;
    }

?>
<!DOCTYPE html>

<html lang="sv">
  <head>
     <meta charset="utf-8">
     <title>Logga in</title>
		 <link rel="stylesheet" href="css/stilmall.css">
	</head>
    <body id="login">
    <div id="wrapper">
     	<header><!--Sidhuvud-->
			<h1>Min onlinebutik - Logga in</h1>
        </header>

	 <?php
	  require "masthead.php";
	  require "menu.php";
	?>
	<main> <!--Huvudinnehåll-->
		<section>
		<!--
			<?php echo $str; ?>
			<form action="login2.php" method="post">
            <p><label for="fname">Förnamn:</label>
            <input type="text" id="fname" name="fname"></p>
			<p><label for="enamn">Efternamn:</label>
			<input type="text" id="ename" name="ename"></p>
			<p><label for="mail">Epost:</label>
			<input type="email" id="mail" name="mail"></p>
			<p><label for="adress">Adress:</label>
			<input type="text" id="adress" name="adress"></p>
			<p><label for="zip">Postnummer:</label>
			<input type="text" id="zip" name="zip"></p>
			<p><label for="ort">Postort:</label>
			<input type="text" id="ort" name="ort"></p>
			<p><label for="nummer">Telefon:</label>
			<input type="text" id="nummer" name="nummer"></p>
            <p><label for="pwd">Lösenord:</label>
            <input type="password" id="pwd" name="password"></p>
            <p>
            <input type="submit" value="Skapa användare">
            </p>
			</form>
		-->
		</section>
	</main>
		
		
    </div>
	<?php
		require "footer.php";
	?>

</body>
</html>
