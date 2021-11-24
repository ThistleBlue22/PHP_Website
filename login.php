<?php
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>The Nexus Login Page</title>
    
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
    <link rel="stylesheet" href="styles.css"><!-- This imports the settings of CSS from the external file styles.css -->
    
</head>
    
<body>
<center>
<h2>Customer Login</h2>
<table border="0">
    

<form action="./scripts/username.php" method="POST">

    <tr>
        <td width="125"></td>
        <td align="center"><p>Username:<br><input type="text" name="Username" id="Username" placeholder="Enter your Name" maxlength="50" size="46" required></p></td>
        <td width="125"></td>
    </tr>
    
    <tr>
        <td width="125"><a href="index.php">Return to Home</a></td>
        <td align="center"><p>Password:<br><input type="password" name="Password" id="password" placeholder="Enter your Password" size="46" onkeyup='check();' required></p></td>
        <td width="125"></td>
    </tr>
    
    <tr>
        <td width="125"></td>
        <td align="center"><p>Confirm Password:<br><input type="password" name="ConfirmPassword" id="confirm_password" placeholder="Re-Enter your Password" size="46" onkeyup='check();' required></p></td>
        <td width="125" align="center"><span id='message'></span></td>
    </tr>
    
    <tr>
        <td width="125"></td>
        <td align="center"><p><button type="reset">Reset Information</button>   <button type="submit" id="submit" disabled="true">Submit Information</button></p></td>
        <td width="125"></td>
    </tr>
    
</form>
    <tr><td width="125"></td><td><center>&copy;Conor Porteous</center></td><td width="125"></td></tr>
</table>
</center>
    
</body>
</html>