<?php

session_start();

$ID = $_POST["ID"];//sets the value $ID to the passed through ID value

$_SESSION['ID'] = $ID;

$user = "root";//sets $user to root, the main user of the database system
$pass = "";//sets the value $pass to nothing, as the main user of the database systems has no password

$db = new PDO("mysql:host=localhost;dbname=my_ecommerce_cp", $user, $pass);//prepares a new PDO statement to connect to the database system

?>

<!DOCTYPE html>
<html>
<head>
    <title><?php
            $prodNum = $_POST["ID"];
            $title = "Select name from products where ID = '$prodNum'";
        
            $stmt = $db->query($title);
        
            $result = $stmt->setFetchMode(PDO::FETCH_NUM);
        
            if($row = $stmt->fetch())
            {
                echo $row[0];
            }
        
        
        
        
            ?>
    </title>
    <link rel="stylesheet" href="../styles.css"><!-- This imports the settings of CSS from the external file styles.css -->
</head>
<body>
<center>
<table border="1">
    <tr>
    <td><img src="https://pbs.twimg.com/profile_images/477184473717407745/0sw0DsTY_400x400.png" height="200" width="200"></td>
			<td width="950"></td>
		<td width="150">
            <?php
            
            if(isset($_SESSION['username']))
            
            {
            
            
            echo "Welcome " . $_SESSION['username'] . "<br><br>"; 
            
            }
            
            ?></td>
	</tr>
    
    
    <tr>
    <td colspan="1" align="center"><a href="../products.php">Return to Products</a></td>
        
    <?php
        
    $ID = $_POST["ID"];
        
    $stmt2 = $db->query("select*from products where ID = '$ID' ");
        
    $result2 = $stmt2->setFetchMode(PDO::FETCH_NUM);
        
            if($row = $stmt2->fetch())
            {
                ?>
                <form method="post" action="./addtocartTest.php">
        
                
                    <td>
                        <center>
                        <img src="<?php echo $row[2]; ?>"><br><br><br>
                        
                        <table>
                        <tr><td>Product Name:</td><td>Product Price:</td></tr>
                        <tr><td><?php echo $row[0] . ". " . $row[1]; ?></td><td><?php echo "£" . $row[3]; ?></td>
                        <td><input type="number" name="quantity" min="1" max="10"><input type="submit" name="addtocart" value="Add to Cart"></td>
                        </tr>
                            
                        
                        </table>
                            
                        </center>
                        
                    </td>
                        
                    
                    <input type="hidden" name="ID" value="<?php echo $row[0] ?>">
                    
                
        
        
                </form>
        
                <?php
                
            }
        
        
        
    ?>
    
    
    </tr>
    
    
</table>    
    
    
</center>
    
    
    
    
    
    
    
    
    
    
    
</body>
</html>