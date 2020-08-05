<html>
    <body>
<?php

session_start();
unset($_SESSION['ValidUser']);
unset($_SESSION['CustomerName']);
header("location:home.html");
?>

</html>