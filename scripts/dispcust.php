<?php

session_start();

$Username = $_SESSION['username']; //sets $Username to the Session data for 'username'
$Password = $_SESSION['password']; //sets $Password to the Session data for 'password'


$user="root"; //sets $user to root, the main user of the database system
$pass=""; //sets the value $pass to nothing, as the main user of the database systems has no password

$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_cp', $user, $pass);//prepares a new PDO statement to connect to the database system

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM customer where Username = '$Username' and ConfirmPassword = '$Password' ";//The sql statement for taking the information from the database where the two values match

try
{
    $stmt = $db->query($sql);
    $result = $stmt->setFetchMode(PDO::FETCH_NUM);
        
        if ($row = $stmt->fetch())
        {
            ?><!DOCTYPE HTML>
                  <html>
                  <head>
                    <title>Customer Display Page</title>
                    
                    
                    
                    <script>
                        var check = function() 
                        {
                        if (document.getElementById('password').value == document.getElementById('confirm_password').value) 
                        {
                            document.getElementById('message').style.color = 'green';
                            document.getElementById('message').innerHTML = 'matching';
                            submit.disabled = false;
                        } 
                        else 
                        {
                            document.getElementById('message').style.color = 'red';
                            document.getElementById('message').innerHTML = 'not matching';
                            submit.disabled = true;
                        }
                        }
                    </script>
                      
                      <link rel="stylesheet" href="../styles.css"><!-- This imports the settings of CSS from the external file styles.css -->
                  </head>
                      
                      <?php
                  echo "<body>
                  <center>
                  <h2>Customer Update Page</h2>";
            echo "<table align='center'>";
            echo "<tr><td></td><td></td></tr>";
            echo "</table>";
            
            echo "<form action=\"./update_customer.php\" method=\"post\">";
            
            echo "<table align='center' border='0'>";
                
                echo "<tr><td style='width:25px;height:25px;'></td><td>Customer ID: </td><td>$row[0]</td></tr>";
            
                echo "<tr><td></td><td>Username: </td><td><input type=\"text\" name=\"Username\" value=\"$row[1]\"></td></tr>";
            
                echo "<tr><td></td><td>Address 1: </td><td><input type=\"text\" name=\"Address1\" value=\"$row[2]\"</td></tr>";
            
                echo "<tr><td></td><td>Address 2: </td><td><input type=\"text\" name=\"Address2\" value=\"$row[3]\"</td></tr>";
            
                echo "<tr><td></td><td>Post Code: </td><td><input type=\"text\" name=\"PostCode\" value=\"$row[4]\"</td></tr>";
            
                echo "<tr><td></td><td>Password: </td><td><input type=\"password\" name=\"Password\" id='password' onkeyup='check();'></td></tr>";
            
                echo "<tr><td></td><td>Confirm Password: </td><td><input type=\"password\" name=\"ConfirmPassword\" id='confirm_password' onkeyup='check();'></td><td><span id='message'></span></td></tr>";
            
            echo "</table>";
            
            echo "<br><input type=\"hidden\" name=\"CustomerID\" value=\"$row[0]\">";
            
            echo "<br><input type=\"submit\" id='submit' disabled='true' value=\"Update Customer\"></center>";
            
            
            echo "</form>";
            
            echo "</body></html>";
        }
    //else This else is no longer needed, but is left in to show previous version of this script
    //{
        //header("Location: ../index.php"); At this point, this isn't needed as this page can only be accessed when logged in.
    //}
}
catch (PDOException $e)
    {
    echo $e->getMessage();
    }
?>