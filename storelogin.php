<html>
    <body>
<?php
require_once("dbcreds.php");

try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
    echo "There has been an issue (#33) with the database connection.";
}

//store password
try{
    $hashedpw = password_hash($_POST["femppassword"], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE employees SET empPassword = :epass WHERE empEmail=:eemail");
    $stmt->bindParam(':eemail', $_POST["fempemail"]);
    $stmt->bindParam(':epass', $hashedpw);
    $stmt->execute();
    echo "Password saved";
    //echo "<a href='mainmenu.php'>Return to Main Menu</a>";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<br>
<a href="mainmenu.php">Return to Main Menu</a>
</body>
</html>