<html>
    <head>

    
        <!-- Bootstrap stuff -->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>




        <!-- Datatables code -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
	    <style type="text/css" class="init">
        </style>
        <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	    <script type="text/javascript" class="init">
	

        $(document).ready(function() {
            $('#myorderstable').DataTable();
        } );


	</script>
    </head>
    <body>
    <table id="myorderstable" class="display" style="width:100%">
        <thead>
            <tr><th></th><th>OID</th><th>Customer Name</th><th>Order Date</th><th>Order Notes</th><th>Order Total</th><th></th></tr>
        </thead><tbody>
<?php

require_once("dbcreds.php");
session_start();

    // put this code block at the top of all secure pages in the site
    // to make sure the current browser is logged in 
    if($_SESSION['ValidUser'] == true) {
        echo "Logged in as " . $_SESSION['Employee'] . "<BR>";
    } else {
    echo "You must <a href='login.php'>login</a> in order to access this site.";
    exit;
    }
# get connected to the DB
try {
    # MySQL with PDO_MYSQL
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection. Please see your administrator"; // $e->getMessage();
}

# output a table of customer data to the browser in proper HTML table format
try {

    # process a SQL SELECT
    $stmt = $conn->prepare("SELECT orderID, orderDate, orderNotes, orderTotals, custName FROM orders, customers WHERE orderCust=custID");
    $stmt->execute();

    // set the resulting array to associative
    // (in which the column names are the subscript values)
    $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);
    
    while($row = $stmt->fetch()) {
        $orderid = $row["orderID"];
        echo "<tr><td align='center'>&nbsp;&nbsp;" .
             "<a href='edit_order.php?oid=$orderid'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>" .  
             "<td>" . $row['orderID'] . "</td>"   .
             "<td>" . $row['custName'] . "</td>"     .
             "<td>" . $row['orderDate'] . "</td>"  .
             "<td>" . $row['orderNotes'] . "</td>"  .
             "<td>" . $row['orderTotals'] . "</td>"  .
             "<td align='center'>&nbsp;&nbsp;" . "<a href='delete_order.php?oid=$orderid'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></td></tr>";
    }
    
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


?>
        </tbody></table>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="orderform.php"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Create Order</a>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="mainmenu.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Return to the menu</a>
    </body>
</html>