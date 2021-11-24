<?php

session_start();

$now = time();


$ID = $_POST['ID']; //sets $ID as the hidden ID value from productPage.php
$quantity = $_POST["quantity"];



$user = "root";
$pass = "";

$db = new PDO("mysql:host=localhost;dbname=my_ecommerce_cp", $user, $pass);

if(isset($_SESSION["username"]))//checks if the username session data is set
{
    $CustomerName = $_SESSION["username"];
    
    $stmt = $db->query("select name, price from products where ID = '$ID' ");
    
    if($row = $stmt->fetch())
    {
        
        $itemName = $row[0];
        $price = $row[1];
        
        $sql = ("INSERT INTO cart(CustomerName, id, name, price, Quantity) value(:CustomerName, :id, :name, :price, :quantity)");
        //sets the SQL statement to be executed
        
        $stmt = $db->prepare($sql);//prepares the sql and database for execution
        
        $stmt->execute(array("CustomerName" => $CustomerName,
                             "id" => $ID,
                             "name" => $itemName,
                             "price" => $price,
                             "quantity" => $quantity
                            ));//executes the SQL statement and inputs the data gathered into the database
        
    }
    
    
    setcookie("Cart", $ID, time()+3600, "/");//sets the cookie Cart to the ID value passed through
    
    
    
    
    header("Location: ../products.php");
}
else
{
    echo "<center><br><br><br><br><br><br><br><br><br>You must be logged in to proceed<br><br>";
    ?>
        <a href="../login.php">Log in!</a>
    <?php
    echo "</center>";
}












//setcookie("ID", $ID, time()+3600, "/"); //sets the cookie "ID" as the previously set $ID


//header("Location: ../products.php");//send the user back to the products.php page after setting the cookie.
?>