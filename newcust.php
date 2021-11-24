<?php
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>The Nexus Registration</title>
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
    <style>
    body {font-family: Arial, Helvetica, sans-serif;}


.modal {
    display: none; 
    position: fixed; 
    z-index: 1; 
    padding-top: 100px; 
    left: 0;
    top: 0;
    width: 100%; 
    height: 100%; 
    overflow: auto; 
    background-color: rgb(0,0,0); 
    background-color: rgba(0,0,0,0.4); 
}


.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
}


.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
    
    
    </style><!-- This content is taken from w3schools in which they show how to make a modal box work, this is the exact code they use -->

</head>

<body>
    
    
    
<center>
    




<table border="0">
<tr>
    <td><img src="https://pbs.twimg.com/profile_images/477184473717407745/0sw0DsTY_400x400.png" height="200" width="200"></td>
    <td><h2>New Customer Details Page</h2></td>
    <td width="200"></td>
    
</tr>
    
<tr>
    <td><a href="index.php">Return to Home</a></td>
    <td>
    <h3><font color="#000000">The Nexus Customer Details</font></h3>
        
    
    
    <form action="./scripts/insert_customer.php" method="POST">
        
    <p>Username:<br><input type="text" name="Username" placeholder="Please give your name.." size="46" required></p>
        
    <p>Address 1:<br><input type="text" name="Address1" placeholder="Please give your address.." size="46" required></p>
        
    <p>Address 2:<br><input type="text" name="Address2" placeholder="Please give your address..(not required)" size="46"></p>
        
    <p>Post Code:<br><input type="text" name="PostCode" placeholder="Please give your Post Code.." size="46" required></p>
        
    <p>Password:<br><input type="password" name="Password" id="password" placeholder="Please give a secure Password.." onkeyup='check();' size="46" required></p>
        
        <p>Verify password: <br><input type=password name="ConfirmPassword" id="confirm_password" placeholder="Please Re-Type your password." onkeyup='check();' size="46" required></p><p><span id='message'></span></p>
        
    <p><button type="reset">Start Over</button><button type="submit" id="submit" disabled="true">Send Now</button></p>
    </form>
        
    
    
    
    </td>
    <td>
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <button type="button" id="myBtn">Why two password fields?</button>
        
        <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Having two password fields reduces the chance of associating an incorrect password to your account</p>
        </div>
        
        </div>
        
    <script>
    var modal = document.getElementById('myModal');
        
    var btn = document.getElementById('myBtn');
        
    var span = document.getElementsByClassName('close')[0];
        
        btn.onclick = function()
        {
            modal.style.display = "block";
        }
        
        span.onclick = function()
        {
            modal.style.display = "none";
        }
        
        window.onclick = function(event)
        {
            if (event.target == modal)
                {
                    modal.style.display = "none";
                }
        }
        
    </script>
    
    </td>
    
</tr>
    <tr><td></td><td>&copy;Conor Porteous</td></tr>
    
</table>
    



</center>
</body>
</html>