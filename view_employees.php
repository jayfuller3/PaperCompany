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
	        $('#myemployeetable').DataTable();
        } );

	    </script>
    </head>
    <body>
        <table id="myemployeetable" class="display" style="width:100%">
        <thead>
            <tr><th></th><th>Employee Last Name</th><th>Employee First Name</th><th>Employee Email</th><th>Employee Phone</th><th>Employee DOB</th><th></th></tr>
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

    if($_SESSION['EmployeeType'] == "Owner" || $_SESSION['EmployeeType'] == "Clerk") {
        //echo "Logged in as " . $_SESSION['Employee'] . "<BR>";
    } else {
        echo "You do not have permission to view this." . "<BR>";
        echo "Return to <a href='mainmenu.php'>main menu</a>.";
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

    $sql = $connstr->prepare("SELECT empID, empLName, empFName, empEmail, empPhone, empDOB FROM employees");
    $sql->execute();

    $row = $sql->setFetchMode(PDO::FETCH_ASSOC);

    # loop through all rows in the resultset and send them to the browser at HTML rows
     while($row = $sql->fetch()) {
        $empid = $row["empID"];
        echo "<tr><td align='center'>&nbsp;&nbsp;" .
             "<a href='edit_employee.php?eid=$empid'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span></a>" . 
             "<td>" . $row['empLName'] . "</td>"  .
             "<td>" . $row['empFName'] . "</td>"  .
             "<td>" . $row['empEmail'] . "</td>" .
             "<td>" . $row['empPhone'] . "</td>" .
             "<td>" . $row['empDOB'] . "</td>"  .
             "<td align='center'>" . "<a href='delete_employee.php?eid=$empid'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></a></tr>";
     }
}

catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>
        </tbody></table>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="employeeform.php"><span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add Employee</a>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="mainmenu.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Main Menu</a>
    </body>
</html>