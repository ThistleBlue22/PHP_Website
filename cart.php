<?php
session_start();//start of session on the page

$user = "root"; //sets $user to root, the main user of the database system
$pass = ""; //sets the value $pass to nothing, as the main user of the database systems has no password

$page = 'index.php'; //connects back to default page

$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_cp', $user, $pass); //prepares a new PDO statement to connect to the database system

?>

<html>
<head>
<title>The Nexus Cart</title>  
    <link rel="stylesheet" href="styles.css"><!-- This imports the settings of CSS from the external file styles.css -->
</head>
<body><!-- applies the colour of grey to the background of the page -->
<center>
    
<table border="1">
    
<tr>
    
<td><img src="https://pbs.twimg.com/profile_images/477184473717407745/0sw0DsTY_400x400.png" height="200" width="200"></td>
    <!-- Reaches out to an image hosted on Twitter as a avatar for a profile -->
    
<td width="1000"></td>
    
    <?php  
           
        if(isset($_SESSION['username']))//checks if the username session data is set, if so it activates and runs the below code to display weither a customer is logged in or not
            
        {
            
            echo "<td width='200'><font size='4'>Customer Checkout</font></td>";//Customer checkout loads if one is logged in
            
        }
        else
        {
            echo "<td width='200'><font size='4'>Guest Checkout</font></td></tr>";//Guest checkout loads if no customer is logged in
        }
    
    
    echo "<tr><td height='300'><a href=./index.php>Return to Home</a></td>";//This redirects the user back to the main index.php page
    
    echo "<td>";
    
    
        if(isset($_COOKIE["Cart"]))//check for the ID Cookie and will activate the code if present
            
        {
            $username = $_SESSION["username"];
            
            $sql = "SELECT name, price, Quantity, SUM(price*Quantity) FROM cart where CustomerName = '$username' group by name";
            
            $stmt = $db->query($sql);
            echo "<table>";
            
            echo "<tr><td>Item Name:</td><td>Price:</td><td>Quantity</td><td>Total Price</td></tr>";
            
            
            while($row=$stmt->fetch(PDO::FETCH_NUM))//begins a while loop
            {
                
                
                
                
                
                echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td></tr>";//loops through the fields within the sql statement 

                
                
            }
            
            echo "</table>";
            
            ?>
            <td>
                <form method="post" action="./scripts/checkout.php">
                <button type="submit">Empty Cart</button>
        
                </form>
            </td>
    <?php
            
            /*
            $cart = $_COOKIE["ID"];//sets the ID Cookie value to $cart
            
            
            $stmt = $db->query($sql);
            $result = $stmt->setFetchMode(PDO::FETCH_NUM);
            
            if($row = $stmt->fetch())
            {
                echo "<td>";
                echo "<table border='0'>";
                echo "<tr><td height='50' width='300'>Item Name</td><td width='300'>Item Price</td>";
                echo "<tr><td height='50' width='300'>" . $row[0] . "</td><td width='300'>£" . $row[1] . "</td></tr>";
                

                
                echo "</table>";
                echo "</td>";
              */
            
            }//this whole block of code, when run, will display the values of the product including the name and price
            
        
        else
        {
            echo "<center>Cart is Empty</center>";//if Cookie ID isn't set, there's nothing to display and so the cart is empty
        }
    echo "</td>";
    ?>
        
</tr>
    <td height="50" width="125"></td><td><center>&copy;Me</center></td><td width="125"></td>
    <!-- This HTML code provides the bottom row in the table, with the copyright centered -->
</table>
</center>
    
</body>


</html>