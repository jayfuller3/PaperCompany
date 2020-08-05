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
	        $('#myinventorytable').DataTable();
        } );

	    </script>
    </head>
    <body>
        <table id="myinventorytable" class="display" style="width:100%">
        <thead>
            <tr><th></th><th>Item ID</th><th>Item Name</th><th>Item Price</th><th>Item Description</th><th>Retail Price</th><th></th></tr>
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

# connect to DB papercompany
try {
    $connstr = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $connstr->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();

}

//output table of employee data to browser in html table
try {

    $sql = $connstr->prepare("SELECT * FROM inventory");
    $sql->execute();

    $row = $sql->setFetchMode(PDO::FETCH_ASSOC);

    # loop through all rows in the resultset and send them to the browser at HTML rows
     while($row = $sql->fetch()) {
        $invid = $row["invID"];
        echo "<tr><td align='center'>&nbsp;&nbsp;" .
             "<a href='edit_inventory.php?iid=$invid'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>" . 
             "<td>" . $row['invID'] . "</td>"  .
             "<td>" . $row['invName'] . "</td>"  .
             "<td>" . $row['invPrice'] . "</td>" .
             "<td>" . $row['invDescription'] . "</td>" .
             "<td>" . $row['invRetail'] . "</td>" .
             "<td align='center'>" . "<a href='delete_inventory.php?iid=$invid'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></tr>";
     }
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
        </tbody></table>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="inventoryform.php"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Create Item</a>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="mainmenu.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Main Menu</a>
    </body>
</html>