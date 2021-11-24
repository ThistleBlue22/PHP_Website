<?php

$CustomerID = $_POST['CustomerID'];
$Username = $_POST['Username'];
$Address1 = $_POST['Address1'];
$Address2 = $_POST['Address2'];
$PostCode = $_POST['PostCode'];
$Password = $_POST['Password'];


$crypted_pass = crypt($Password, 'salt_string');


$user = "root";//sets $user to root, the main user of the database system
$pass = "";//sets the value $pass to nothing, as the main user of the database systems has no password

$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_cp', $user, $pass);//prepares a new PDO statement to connect to the database system

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "UPDATE customer SET
        Username = '$Username',
        Address1 = '$Address1',
        Address2 = '$Address2',
        PostCode = '$PostCode',
        Password = '$crypted_pass',
        ConfirmPassword = '$crypted_pass'
        WHERE CustomerID='$CustomerID' ";//This 

$stmt = $db->prepare($sql);

$stmt->execute();

header("Location: ../index.php");

?>