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
        
        </head>
    <body>
        <?php
        session_start();

        // put this code block at the top of all secure pages in the site
        // to make sure the current browser is logged in 
        if($_SESSION['ValidUser'] == true) {
            echo "Logged in as " . $_SESSION['Employee'] . "<BR>";
        } else {
        echo "You must <a href='login.php'>login</a> in order to access this site.";
        exit;
        }

        if($_SESSION['EmployeeType'] == "Owner") {
            //echo "Logged in as " . $_SESSION['Employee'] . "<BR>";
        } else {
            echo "You do not have permission to view this." . "<BR>";
            echo "Return to <a href='mainmenu.php'>main menu</a>.";
        exit;
        }

        ?>

        <h2>New Employee Form</h2>

        <form method="POST" action="store_employee.php">
            Employee Last Name<br>
            <input type="text" name="femplname" value="">
            <br><br>
            Employee First Name:<br>
            <input type="text" name="fempfname" value="">
            <br><br>
            Employee Email:<br>
            <input type="email" name="fempemail" value="">
            <br><br>
            Employee Phone:<br>
            <input type="text" name="fempphone" value="">
            <br><br>
            <label for="fempdob">Employee Date of Birth:</label><br>
            <input type="date" name="fempdob" value="">
            <br><br>
            <label for="femptype">Employee Type:</label>
                <select id="femptype" name="femptype">
                    <option value="Owner">Owner</option>
                    <option value="Sales">Sales</option>
                    <option value="Clerk">Clerk</option>
                    <option value="Accountant">Accountant</option>
                </select>
            <br>
            <input type="submit" value="Submit">
            <br><br>
        </form> 

        &nbsp;&nbsp;&nbsp;<a href="view_employees.php"><span class='glyphicon glyphicon-list' aria-hidden='true'></span> View Employees</a><br><br>
        &nbsp;&nbsp;&nbsp;<a href="mainmenu.php"><span class='glyphicon glyphicon-home' aria-hidden='true'></span> Main Menu</a>

</body>
</html>