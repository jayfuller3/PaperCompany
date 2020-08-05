<html>
<style>
        body {
            background-image: url('papercompanyphoto.jpg');
            background-repeat: no-repeat;
            background-size: cover;
        }
        .logo{
          width: 250px;
          margin: 0 auto;
        }
    </style>
<head>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<!-- Bootstrap stuff -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>
<?php
session_start();

// check to see if just arriving from thte login form page
if($_POST["fempemail"]>"") {
    require_once("dbcreds.php");

    # get connected to the DB
    try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    }
    catch(PDOException $e) {
        echo "There has been an issue (#33) with the database connection.  Please see your administrator"; // $e->getMessage();
    }

    # search table for matching employee
    try {
        
        $stmt = $conn->prepare("SELECT empEmail, empPassword, empFName, empType FROM employees WHERE empEmail=:eemail");
        $stmt->bindParam(':eemail', $_POST["fempemail"]);
        $stmt->execute();

        $hashed_pw = password_hash($_POST["femppassword"], PASSWORD_DEFAULT);
        $row = $stmt->setFetchMode(PDO::FETCH_ASSOC);

        # loop through all rows in the resultset and see if the password value is valid
        while($row = $stmt->fetch()) {
            if (password_verify($_POST["femppassword"], $row['empPassword'])) {
            //echo 'Customer password is verified!<br>';
            $_SESSION['ValidUser'] = true;
            $_SESSION['Employee'] = $row['empFName'];
            $_SESSION['EmployeeType'] = $row['empType'];

            } else {
            echo 'Invalid password.<br>';
            echo "You must <a href='login.php'>login</a> in order to access this site.";
            exit;
            }
                
        }


    }
    catch(PDOException $e) {
        echo "There has been an issue (#57) with the database.  Please see your administrator"; // $e->getMessage();
        exit;
    }

}
else{

}


?>
    <body>
    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Jay's Paper Company</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <div class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Employees
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="employeeform.php">Add New Employee</a>
          <a class="dropdown-item" href="view_employees.php">View All Employees</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="newlogin.php">Create New Employee Login</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Inventory
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="view_inventory.php">View Inventory</a>
          <a class="dropdown-item" href="inventoryform.php">Add Inventory Item</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Orders
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="orderform.php">Create New Order</a>
          <a class="dropdown-item" href="view_orders.php">View All Orders</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Customers
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="customerform.php">Add New Customer</a>
          <a class="dropdown-item" href="view_customers.php">View All Customers</a>
        </div>
      </li>
    </div>
  </div>
  <form class="form-inline" method="POST" action="logout.php">
    <button class="btn btn-dark btn-lg my-2 my-sm-0" type="submit">Logout</button>
  </form>
</nav>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<?php


// put this code block at the top of all secure pages in the site
// to make sure the current browser is logged in 
if($_SESSION['ValidUser'] == true) {
  echo '<div style="color:white;">Logged in as <span style="color:white;">'.$_SESSION['Employee'].'</span></div>';
  echo '<div style="color:white;">Employee type: <span style="color:white;">'.$_SESSION['EmployeeType'].'</span></div>';
   //echo "Logged in as " . $_SESSION['Employee'] . "<BR>";
   //echo "Employee type: " . $_SESSION['EmployeeType'] . "<BR>";
} else {
echo "You must <a href='login.php'>login</a> in order to access this site.";
exit;
}
?>

<div class="row">
    <div class="logo">
      <img src="logo.png" alt="logo" class="logo">
    </div>
</div>
</body>
</html>