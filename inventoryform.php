<!DOCTYPE html>
<html>
    <head>

        <!-- Bootstrap stuff -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        
        </head><body>
        
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

        ?>

        <h2>New Inventory Form</h2>

        <form method="POST" action="store_inventory.php">
            Item Name:<br>
            <input type="text" name="finvname" value="">
            <br><br>
            Item Price<br>
            <input type="text" name="finvprice" value="">
            <br><br>
            Item Description:<br>
            <input type="text" name="finvdesc" value="">
            <br><br>
            Item Retail Price:<br>
            <input type="text" name="finvretail" value="">
            <br><br>
            <input type="submit" value="Submit">
        </form>

        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="view_inventory.php"><span class='glyphicon glyphicon-list' aria-hidden='true'></span> View Inventory</a>
        <br><br>
            &nbsp;&nbsp;&nbsp;<a href="mainmenu.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Return to the main menu</a>
    </body>
</html>