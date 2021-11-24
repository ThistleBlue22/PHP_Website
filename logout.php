<?php
session_start();
session_destroy();

setcookie("name", $username, time()-3600*24, "/");
setcookie("password", $crypted_pass, time()-3600*24, "/");
setcookie("ID", $ID, time()-3600, "/");

header("Location: ./index.php");

//this script scraps the cookies for the username and password, therefore logging the user out. It also destroys the sessions if there are any.

?>