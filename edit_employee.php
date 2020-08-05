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

# locate the employee data based on empid value
try {
    
    # process an SQL SELECT
    $stmt = $conn->prepare("SELECT empID, empLName, empFName, empEmail, empPhone, empDOB, empType FROM employees WHERE empID=:empidParam");
    $stmt->bindParam(':empidParam', $_GET["eid"]);
    $stmt->execute();

    // set the array that the fetch() function generates to be an associative array
    // (in which the column names are the subscript values)
    $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    # fetch the matching row and create some temp vars with its cust info values
    if($row = $stmt->fetch()) {
        $empid      = $row["empID"];
        $emplname    = $row["empFName"];
        $empfname = $row["empLName"];
        $empemail   = $row["empEmail"];
        $empphone   = $row["empPhone"];
        $empdob   = $row["empDOB"];
        $emptype  = $row["empType"];

    } else {
        echo "Customer EDIT Error #888 -- please contact support";
        exit;
    }


}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}




?>


<h2>Edit Employee</h2>

<form method="POST" action="store_edited_employee.php">
  Employee last name:<br>
  <input type="hidden" name="fempid" value="<?php echo $empid; ?>">
  <input type="text" name="femplname" value="<?php echo $emplname; ?>">
  <br><br>
  Employee first name:<br>
  <input type="text" name="fempfname" value="<?php echo $empfname; ?>">
  <br><br>
  Email:<br>
  <input type="text" name="fempemail" value="<?php echo $empemail; ?>">
  <br><br>
  Phone:<br>
  <input type="text" name="fempphone" value="<?php echo $empphone; ?>">
  <br><br>
  DOB:<br>
  <input type="text" name="fempdob" value="<?php echo $empdob; ?>">
  <br><br>
  <label for="femptype">Employee Type:</label>
                <select id="femptype" name="femptype">
                    <option value="Owner">Owner</option>
                    <option value="Sales">Sales</option>
                    <option value="Clerk">Clerk</option>
                    <option value="Accountant">Accountant</option>
                </select>
  <br><br>
  <input type="submit" value="Submit">
</form> 

<p>If you click the "Submit" button, the form-data will be saved.</p>
<br><br>
        <a href="view_employees.php">Return to employees</a>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="mainmenu.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Return to the menu</a>
</body>
</html>
