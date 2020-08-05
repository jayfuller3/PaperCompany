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
    $custSQL = $custDBH->prepare("INSERT INTO employees (empLName, empFName, empEmail, empPhone, empDOB, empType) value (:emplname, :empfname, :empemail, :empphone, :empdob, :emptype)");

    # bind some data values into the named parameters in the prepared statement
    $custSQL->bindParam(':emplname', $_POST["femplname"]);
    $custSQL->bindParam(':empfname', $_POST["fempfname"]);
    $custSQL->bindParam(':empemail', $_POST["fempemail"]);
    $custSQL->bindParam(':empphone', $_POST["fempphone"]);
    $custSQL->bindParam(':empdob', $_POST["fempdob"]);
    $custSQL->bindParam(':emptype', $_POST["femptype"]);

    # submit the SQL statement to MySQL for processing
    $custSQL->execute();
   
  }
  catch(PDOException $e) {
      echo "There has been an issue (#35) with the database connection.  Please see your administrator"; // $e->getMessage();
  }
  

?>
        Employee successfully added.
        <br></br>
        <a href="view_employees.php">View Employees</a><br>
        <a href="employee_form.html">Add Another Employee</a>
    </body>
</html>