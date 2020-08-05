<html>
    <body>
<?php

require_once("dbcreds.php");

# get connected to the DB
try {
  $empDBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
 
}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
}

// print_r($_POST);

# process an SQL INSERT
try {
    # prepare the SQL shortcut!
    $empSQL = $empDBH->prepare("UPDATE orders 
    SET orderCust=:ocust, orderDate=:odate, orderNotes=:onotes, orderTotals=:ototals 
    WHERE orderID=:orderid");

    # bind some data values into the named parameters in the prepared statement
    $empSQL->bindParam(':orderid', $_POST["fordid"]);
    $empSQL->bindParam(':ocust', $_POST["fordcust"]);
    $empSQL->bindParam(':odate', $_POST["forddate"]);
    $empSQL->bindParam(':onotes', $_POST["fordnotes"]);
    $empSQL->bindParam(':ototals', $_POST["fordtotals"]);

    # submit the SQL statement to MySQL for processing
    $empSQL->execute();
   
  }
  catch(PDOException $e) {
      echo "There has been an issue (#39) with the database connection.  Please see your administrator"; // $e->getMessage();
  }
  

?>
        Employee has been updated.
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="view_orders.php"><span class='glyphicon glyphicon-list' aria-hidden='true'></span> Return to Orders</a>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="mainmenu.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Return to the menu</a>


    </body>
</html>