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

# locate the customer data based on cid value
try {
    
    # process an SQL SELECT
    $stmt = $conn->prepare("SELECT custID, custName, custContact, custPhone FROM customers WHERE custID=:cidParam");
    $stmt->bindParam(':cidParam', $_GET["cid"]);
    $stmt->execute();

    // set the array that the fetch() function generates to be an associative array
    // (in which the column names are the subscript values)
    $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    # fetch the matching row and create some temp vars with its cust info values
    if($row = $stmt->fetch()) {
        $custid      = $row["custID"];
        $custname    = $row["custName"];
        $custcontact = $row["custContact"];
        $custphone   = $row["custPhone"];
    } else {
        echo "Customer EDIT Error #888 -- please contact support";
        exit;
    }


}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}




?>


<h2>Edit Customer</h2>

<form method="POST" action="store_edited_customer.php">
  Customer name:<br>
  <input type="hidden" name="fcid" value="<?php echo $custid; ?>">
  <input type="text" name="fcustname" value="<?php echo $custname; ?>">
  <br><br>
  Contact Person:<br>
  <input type="text" name="fcontact" value="<?php echo $custcontact; ?>">
  <br><br>
  Phone:<br>
  <input type="text" name="fphone" value="<?php echo $custphone; ?>">
  <br><br>
  <br><br>
  <input type="submit" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be saved.</p>
<br><br>
        <a href="view_customers.php">Return to customers</a>
        <br><br>
        <a href="mainmenu.php">Return to the menu</a>
</body>
</html>
