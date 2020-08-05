<html>
    <body>
<?php

require_once("dbcreds.php");

# get connected to the DB
try {
  $empDBH = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
 
}
catch(PDOException $e) {
    echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
}

// print_r($_POST);

# process an SQL INSERT
try {
    # prepare the SQL shortcut!
    $empSQL = $empDBH->prepare("UPDATE employees 
    SET empLName=:elname, empFName=:efname, empEmail=:eemail, empPhone=:ephone, empDOB=:edob, empType=:etype 
    WHERE empID=:empid");

    # bind some data values into the named parameters in the prepared statement
    $empSQL->bindParam(':empid', $_POST["fempid"]);
    $empSQL->bindParam(':elname', $_POST["femplname"]);
    $empSQL->bindParam(':efname', $_POST["fempfname"]);
    $empSQL->bindParam(':eemail', $_POST["fempemail"]);
    $empSQL->bindParam(':ephone', $_POST["fempphone"]);
    $empSQL->bindParam(':edob', $_POST["fempdob"]);
    $empSQL->bindParam(':etype', $_POST["femptype"]);

    # submit the SQL statement to MySQL for processing
    $empSQL->execute();
   
  }
  catch(PDOException $e) {
      echo "There has been an issue (#39) with the database connection.  Please see your administrator"; // $e->getMessage();
  }
  

?>
        Employee has been updated.
        <br><br>
        <a href="view_employees.php">Return to employees</a>
        <br><br>
        &nbsp;&nbsp;&nbsp;<a href="mainmenu.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Return to the menu</a>


    </body>
</html>