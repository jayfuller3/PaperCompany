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

// Lookup the cid value that was passed as a query string
require_once("dbcreds.php");

# get connected to the DB
try {
  $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
}

# locate the order data based on orderid value
try {
    
    # process an SQL SELECT
    $stmt = $conn->prepare("SELECT orderID, orderCust, orderDate, orderNotes, orderTotals FROM orders WHERE orderID=:orderidParam");
    $stmt->bindParam(':orderidParam', $_GET["oid"]);
    $stmt->execute();

    // set the array that the fetch() function generates to be an associative array
    // (in which the column names are the subscript values)
    $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    # fetch the matching row and create some temp vars with its cust info values
    if($row = $stmt->fetch()) {
        $orderid      = $row["orderID"];
        $ordercust    = $row["orderCust"];
        $orderdate = $row["orderDate"];
        $ordernotes   = $row["orderNotes"];
        $ordertotals   = $row["orderTotals"];

    } else {
        echo "Order EDIT Error #888 -- please contact support";
        exit;
    }


}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}




?>


<h2>Edit Order</h2>

<form method="POST" action="store_edited_order.php">
  Customer ID:<br>
  <input type="hidden" name="fordid" value="<?php echo $orderid; ?>">
  <input type="text" name="fordcust" value="<?php echo $ordercust; ?>">
  <br><br>
  Order Date:<br>
  <input type="text" name="forddate" value="<?php echo $orderdate; ?>">
  <br><br>
  Notes:<br>
  <input type="text" name="fordnotes" value="<?php echo $ordernotes; ?>">
  <br><br>
  Total:<br>
  <input type="text" name="fordtotals" value="<?php echo $ordertotals; ?>">
  <br><br>
  <br><br>
  <input type="submit" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be saved.</p>
<br><br>
        &nbsp;&nbsp;&nbsp;<a href="view_orders.php"><span class='glyphicon glyphicon-list' aria-hidden='true'></span> Return to Orders</a>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="mainmenu.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Return to the menu</a>
</body>
</html>
