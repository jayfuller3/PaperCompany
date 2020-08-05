<html>
    <body>
<?php

require_once("dbcreds.php");

# get connected to the DB
try {
  $invDBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
 
}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
}

// print_r($_POST);

# process an SQL INSERT
try {
    # prepare the SQL shortcut!
    $invSQL = $invDBH->prepare("UPDATE inventory 
    SET invName=:iname, invPrice=:iprice, invDescription=:idesc, invRetail=:iretail 
    WHERE invID=:iid");

    # bind some data values into the named parameters in the prepared statement
    $invSQL->bindParam(':iid', $_POST["fiid"]);
    $invSQL->bindParam(':iname', $_POST["finvname"]);
    $invSQL->bindParam(':iprice', $_POST["finvprice"]);
    $invSQL->bindParam(':idesc', $_POST["finvdesc"]);
    $invSQL->bindParam(':iretail', $_POST["finvretail"]);

    # submit the SQL statement to MySQL for processing
    $invSQL->execute();
   
  }
  catch(PDOException $e) {
      echo "There has been an issue (#39) with the database connection.  Please see your administrator"; // $e->getMessage();
  }
  

?>
        Inventory has been updated.
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="view_inventory.php"><span class='glyphicon glyphicon-list' aria-hidden='true'></span> Return to Inventory</a>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="mainmenu.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Return to the menu</a>


    </body>
</html>