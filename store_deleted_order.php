<html>
    <body>
<?php

require_once("dbcreds.php");

# get connected to the DB
try {
  $custDBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
 
}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
}

// print_r($_POST);

# process an SQL INSERT
try {
    # prepare the SQL shortcut!
    $custSQL = $custDBH->prepare("DELETE FROM orders WHERE orderID=:orderid");

    # bind some data values into the named parameters in the prepared statement
    $custSQL->bindParam(':orderid', $_POST["fordid"]);

    # submit the SQL statement to MySQL for processing
    $custSQL->execute();
   
  }
  catch(PDOException $e) {
      echo "There has been an issue (#39) with the database connection.  Please see your administrator"; // $e->getMessage();
  }
  

?>
        Order has been deleted.
        <br><br>
        <a href="view_orders.php">Return to orders</a>
        <br><br>
        <a href="mainmenu.php">Return to the menu</a>

    </body>
</html>