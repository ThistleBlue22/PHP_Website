<?php

$Username = $_POST['Username'];//sets $Username as the passed though Username
$Address1 = $_POST['Address1'];//sets $Address1 as the passed though Address1
$Address2 = $_POST['Address2'];//sets $Address2 as the passed though Address2
$PostCode = $_POST['PostCode'];//sets $PostCode as the passed though PostCode
$Password = $_POST['Password'];//sets $Password as the passed though Password
$ConfirmPassword = $_POST['ConfirmPassword'];//sets $ConfirmPassword as the passed though ConfirmPassword

$crypted_pass = crypt($Password, 'salt_string');//encrypts the passed through Password

$crypted_confirm_pass = crypt($ConfirmPassword, 'salt_string');//encrypts the passed through ConfirmPassword

$user = "root";//sets $user to root, the main user of the database system
$pass = "";//sets the value $pass to nothing, as the main user of the database systems has no password

$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_cp', $user, $pass);//prepares a new PDO statement to connect to the database system

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $db->prepare("INSERT INTO customer(Username, Address1, Address2, PostCode, Password, ConfirmPassword) values(:Username, :Address1, :Address2, :PostCode, :Password, :ConfirmPassword)");//sets up the fields to be altered to be filled below

$stmt->execute(array("Username" => $Username,
                     "Address1" => $Address1,
                     "Address2" => $Address2,
                     "PostCode" => $PostCode,
                     "Password" => $crypted_pass,
                     "ConfirmPassword" => $crypted_confirm_pass
                     ));//provides the values to be sent to the database and set the correct values of the new user

header("Location: ../login.php");//sends the user back to the index.php page after the information is sent and set


?>