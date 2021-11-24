<?php

session_start();

$user="root";//sets $user to root, the main user of the database system
$pass="";//sets the value $pass to nothing, as the main user of the database systems has no password 



?>

<!DOCTYPE html>
<html>
<head>
	<title>The Nexus Products</title>
    
    <link rel="stylesheet" href="styles.css"><!-- This imports the settings of CSS from the external file styles.css -->
</head>

<body>
<center>
<table border="0">
	<tr>
		<td><img src="https://pbs.twimg.com/profile_images/477184473717407745/0sw0DsTY_400x400.png" height="200" width="200"></td>
			<td colspan="1" align="center"><a href="index.php">Return to Home</a></td> <!-- This will return the user to the home page. -->
		<td width="150">
            <?php
            
            if(isset($_SESSION['username']))//checks if the username Session data is set
            
            {
            
            
            echo "Welcome " . $_SESSION['username'] . "<br><br>"; 
            
            }
            
            ?></td>
	</tr>
	
	<tr>
		<td valign="top">
		
		</td>
		<td valign="top">
			<h2>Product Display</h2>
			<table border="0">
			
	<?php
	echo "<tr>";
        //echo "<td>Item ID</td>";
		echo "<td>Product Image</td>";
		echo "<td>Product Name</td>";
		echo "<td>Price</td>";
	echo "</tr>";
	
	?>
                
    <?php
	$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_cp', $user, $pass);//prepares a new PDO statement to connect to the database system
	$stmt = $db->query('select*from products');
	while($row=$stmt->fetch(PDO::FETCH_ASSOC))
	{
        ?>
        <form method='POST' action="./scripts/productPage.php" id="<?php $row['ID'] ?>">
        <?php
        
		echo "<tr>";
        //echo "<td><input type='text' name='ID' value=' " . $row['ID'] . "' size='1' readonly></td>";
		echo "<td>"; ?> <img src=" <?php echo $row['ImagePath']; ?>" height="100" width="150"> <?php echo "</td>";//Displays the Image
		echo "<td>" . $row['Name']."</td>";//Displays the Name
		echo "<td>£" . $row['Price']."</td>";//Displays the Price with a £ inserted to provide a proper price value
        
        ?>
                
        <td><input type="submit" name="productpage" value="View Product Page"></td>
            
            
        <input type="hidden" name="ID" value="<?php echo $row["ID"] ?>"><!-- adds the hidden value of ID -->
               
        </form>       
        
               <?php 
        
		echo "</tr>";
       
	}
                
        
                
    
		
	?>
                
         </table>
            
            
            
            
		</td>
		<td valign="top">&nbsp;</td>
	</tr>
	<tr>
		<td width="100">&nbsp;</td>
			<td><center>&copy;Conor Porteous</center></td>
		<td width="100">&nbsp;</td>
	</tr>
		
	</table>
    
    
    
	</center>
	

</body>
</html>