<?php
    require "../include/connect.php";
    $username=$_SESSION['username'];

    $sql = "SELECT * FROM customers WHERE username=?";
    $res = $dbh->prepare($sql);
    $res->bind_param("s",$username);
    $res->execute();
    $result=$res->get_result();

    $row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="sv">
  <head>
     <meta charset="utf-8">
     <title>Admin</title>
<link rel="stylesheet" href="css/stilmall.css">
  </head>
  <body id="admin">
    <div id="wrapper">

<?php
 require "masthead.php" ;
 require "menu.php";
?>

<main> <!--Huvudinnehåll-->
Admin sida

<br>
<table>
                <tr>
                    <th>Användarnamn</th>
                    <th>Förstanamn</th>
                    <th>Efternamn</th>
                    <th>Adress</th>
                    <th>Postkod</th>
                    <th>Stad</th>
                    <th>Telefonnummer</th>
                </tr>
                <tr>
                    <?php
                        echo <<<TR
                            <td>{$row['username']}</td>
                            <td>{$row['firstname']}</td>
                            <td>{$row['lastname']}</td>
                            <td>{$row['adress']}</td>
                            <td>{$row['zip']}</td>
                            <td>{$row['city']}</td>
                            <td>{$row['phone']}</td>
TR;
                    ?>
                </tr>
            </table>
</main>

<?php
require "footer.php";
?>

</div>
  </body>
</html>