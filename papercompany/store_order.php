<html>
    <body>
<?php

require_once("dbcreds.php");
session_start();

        // put this code block at the top of all secure pages in the site
        // to make sure the current browser is logged in 
        if($_SESSION['ValidUser'] == true) {
            //echo "Welcome back " . $_SESSION['EmployeeName'] . "<BR>";
        } else {
        echo "You must <a href='login.php'>login</a> in order to access this site.";
        exit;
        }
# get connected to the DB
try {
  $custDBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
 
}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
}

# SQL INSERT
try {
    # prepare the SQL shortcut!
    $custSQL = $custDBH->prepare("INSERT INTO orders (orderCust, orderDate, orderNotes, orderTotals) value (:ordercust, :orderdate, :ordernotes, :ordertotal)");

    # bind some data values into the named parameters in the prepared statement
    $custSQL->bindParam(':ordercust', $_POST["fcustid"]);
    $custSQL->bindParam(':orderdate', $_POST["forderdate"]);
    $custSQL->bindParam(':ordernotes', $_POST["fnotes"]);
    $custSQL->bindParam(':ordertotal', $_POST["ftotal"]);

    # submit the SQL statement to MySQL for processing
    $custSQL->execute();
   
  }
  catch(PDOException $e) {
      echo "There has been an issue (#35) with the database connection.  Please see your administrator"; // $e->getMessage();
  }
  

?>
        Order successfully added.
        <br></br>
        <a href="view_orders.php">View Orders</a><br>
        <a href="mainmenu.php">Main Menu</a>
    </body>
</html>