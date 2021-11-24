<?php

session_start();

$browser = get_browser();

$user="root";//sets $user to root, the main user of the database system
$pass="";//sets the value $pass to nothing, as the main user of the database systems has no password

$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_cp', $user, $pass);//prepares a new PDO statement to connect to the database system

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>

<!DOCTYPE html>

<html>
<head>
<title>The Nexus Homepage</title>
    <link rel="stylesheet" href="styles.css"><!-- This imports the settings of CSS from the external file styles.css -->
</head>
    
<body>
<!-- This sets the body up and applies the colour of grey to the background -->
   
    
    <center>
    
    <table border="0"><!-- Creating a table for the main content of the website -->
        
            
            
        <tr>    
        <td><img src="https://pbs.twimg.com/profile_images/477184473717407745/0sw0DsTY_400x400.png" height="200" width="200"></td>
        <td width="750"><font size="16">Welcome to The Nexus! </font><br><?php echo $browser->device_type; ?> version</td>
        
        <?php  
           
        if(isset($_SESSION['username']))
        //Checking whether the username session information is set
            
        {
            //Executing code if set.
            echo "<td width='200'> Welcome " . $_SESSION['username'] . "<br><br>"; 
            
            ?>
            
            <a href='scripts/dispcust.php'><font size='5'>My Account</font></a><br>
            
            <?php
            
            echo "<a href='./cart.php'><font size='5'>Cart</font></a><br>";
            echo "<a href='logout.php'><font size='5'>Logout</font></a></td>";
        
        }
        else
        {
            //Otherwise executing this code on failure of the if(isset)
            echo "<td width='200'>Welcome Guest <br>";
            
            echo "<a href='login.php'><font size='5'>Login</font></a><br>";
            
            echo "<a href='./cart.php'><font size='5'>Cart</font></a><br>";
            
            echo "<a href='newcust.php'><font size='5'>Register</font></a></td>";
        
        }
            
        ?>
        
        </tr>
        <tr>
        <td><a href="products.php">Store Products</a><br>
            <a href="scripts/images.php">Image Gallery</a>
            
            
            </td>
        <td width="750" height="400"><?php
    
        
        $row = 'select * from products order by rand()';
        //along with the below if statement, this allows for a single random product to be displayed on the main page after every reload
            
        $stmt = $db->query($row);
        $result = $stmt->setFetchMode(PDO::FETCH_NUM);
        
        if($row=$stmt->fetch(PDO::FETCH_ASSOC))
        //along with the above $row(rand) statement, this allows for a single random product to be displayed on the main page after every reload
        {
            
        ?> 
        <img src=" <?php echo $row['ImagePath'] ; ?>" height="200" width="300"><br><br><br><br><br>
        <!-- This allows the displaying of the images -->
            
        <?php
		echo  $row['Name'] . "<br><br>";
		echo "£" . $row['Price'] . "<br><br>";
            
        }//This block of code above allows the display of the randomly chosen product from the database of items. Only one is ever displayed at once.
            
            
            
        
            
            
        ?></td>
        
        </tr>
        <tr><td height="50"></td><td><center>&copy;Conor Porteous</center></td><td></td></tr>
        <!-- This sets the bottom three rows of the 3x3 table and includes the copyright symbol and my name in the center -->
            
        
    
    </table>
    
    
    
    
    
    
    
    
    
    
    
    
    </center>
    
</body>
    
    
    
</html>