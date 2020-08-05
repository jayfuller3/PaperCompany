<!DOCTYPE html>
<html>
<body>
<?php
        session_start();

        // put this code block at the top of all secure pages in the site
        // to make sure the current browser is logged in 
        if($_SESSION['ValidUser'] == true) {
            echo "Logged in as " . $_SESSION['Employee'] . "<BR>";
        } else {
        echo "You must <a href='login.php'>login</a> in order to access this site.";
        exit;
        }

        if($_SESSION['EmployeeType'] == "Owner") {
            //echo "Logged in as " . $_SESSION['Employee'] . "<BR>";
        } else {
            echo "You do not have permission to view this." . "<BR>";
            echo "Return to <a href='mainmenu.php'>main menu</a>.";
        exit;
        }

        ?>

<h2>New Employee Login Info</h2>

<form method="POST" action="storelogin.php">
    Email Address:<br>
    <input type="text" name="fempemail" value="">
    <br><br>
    Create Password:<br>
    <input type="password" name="femppassword" value="">
    <br><br>
    <input type="submit" value="Submit">
</form>
<a href="mainmenu.php">Return to Main Menu</a>
</body>
</html>