<?php
session_start();



$name = $_SESSION['username'];

$now = time();

$user = "root";
$pass = "";

$db = new PDO("mysql:host=localhost;dbname=my_ecommerce_cp", $user, $pass);
	
$item = $_SESSION["ID"];

$stmt = $db->query("select name, price from products where ID = '$item' ");

//$stmt->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

while($row = $stmt->fetch())
{
    
    
    
    $itemname = $row[0];
    $price = $row[1];
    
    
    
    $sql = ("INSERT INTO orders(CustomerName, ItemName, OrderPrice, DateTime) values(:CustomerName, :ItemName, :OrderPrice, :DateTime)");
    
    $stmt = $db->prepare($sql);
    
    
    $stmt->execute(array("CustomerName" => $name,
                         "ItemName" => $itemname,
                         "OrderPrice" => $price,
                         "DateTime" => $now
                        ));
    

}














header("Location: ../products.php");

?>