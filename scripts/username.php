<?php

$user="root";//sets $user to root, the main user of the database system
$pass="";//sets the value $pass to nothing, as the main user of the database systems has no password

$db = new PDO('mysql:host=localhost;dbname=my_ecommerce_cp', $user, $pass);//prepares a new PDO statement to connect to the database system

$username = $_POST['Username'];//Setting the passed through information up as session data
$Password = $_POST['Password'];//Setting the passed through information up as session data
$crypted_pass = crypt($Password, 'salt_string');

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "SELECT * FROM customer where Username = '$username' and Password = '$crypted_pass' ";//sql statement which compares the information provided to the database information selecting any entries with matching information


try//try this block of code with the provided information
{
    $stmt = $db->query($sql);
    $result = $stmt->setFetchMode(PDO::FETCH_NUM);
        
        if ($row = $stmt->fetch())
        {

            session_start();

            //setcookie("name", $username, time()+3600*24, "/");
            
            //setcookie("password", $crypted_pass, time()+3600*24, "/");

            
            $_SESSION['username'] = $username;//Setting the assigned information up as session data
            $_SESSION['password'] = $crypted_pass;//Setting the assigned information up as session data
            

header("Location: ../index.php");//once the data is set, sends the user to the index.php file which will react to them logging in
            
            
            }
    else
    {
        header("Location: ../login.php");//if anything is wrong, such as the password this script will pick up on that and send the user back to the login.php form to sign in again
    }
    
}
catch (PDOException $e)//catch any errors 
    {
    echo $e->getMessage();
    }
?>