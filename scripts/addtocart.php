<?php

session_start();


$ID = $_POST['ID']; //sets $ID as the hidden ID value from productPage.php

setcookie("ID", $ID, time()+3600, "/"); //sets the cookie "ID" as the previously set $ID


header("Location: ../products.php");//send the user back to the products.php page after setting the cookie.

?>