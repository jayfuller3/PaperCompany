<html>
    <body>
<?php

require_once("dbcreds.php");

try {
    # MySQL with PDO_MYSQL
    $custDBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection. Please see your administrator"; // $e->getMessage();
}

# process a SQL INSERT
try {
    # prepare the SQL shortcut
    $custSQL = $custDBH->prepare("INSERT INTO customers (custName, custContact, custPhone) VALUE (:cname, :ccontact, :cphone)");

    # bind some data values into the named parameters in the prepared statement
    $custSQL->bindParam(':cname', $_POST["fcustname"]);
    $custSQL->bindParam(':ccontact', $_POST["fcontact"]);
    $custSQL->bindParam(':cphone', $_POST["fphone"]);

    # submit the SQL statement to MySql for processing
    $custSQL->execute();
}
catch(PDOException $e) {
    echo "There has been an issue (#35) with the database connection. Please see your administrator";
}

?>
        Thank you for adding that customer.
        <br><br>
        <a href="mainmenu.php">Return to the main menu</a>
        <br><br>
        <a class="dropdown-item" href="view_customers.php">View All Customers</a>
    </body>
</html>