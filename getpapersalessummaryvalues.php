<?php

// The first line reads the raw post input that was sent to the server.
// Note that we are expecting a JSON array, not form fields.
$postdata = file_get_contents("php://input");

//echo "Here is what was posted: " . $postdata;

// debug code -- send whatever was posted right back to the client
//    so that it can be viewed if logged by the Android app
//echo "here are the posted values";
//echo $postdata;
//exit;

/* sample of incoming data from the client
{ "AuthCode":"abc123" }
*/


// parse the JSON string into an associative array called parsedJSON
$parsedJSON = json_decode($postdata, true);
//echo "about to see if it parsed okay";
// bail out if it's not valid JSON data
if($parsedJSON==null) exit;
//echo "it parsed okay";
// bail out if they did not send an email address value
if(!array_key_exists('AuthCode', $parsedJSON)) exit; // $parsedJSON['AuthCode'] = "abc123"

// note: this is where you would include the necessary database code to
// lookup the credentials that were passed from the application
 
$dbLookupSuccess = 0;

// get database stuff going
$servername = "localhost";
$dbname = "papercompany";
$username = "paper202020";
$password = "Qwerty7!";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	// set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	// echo "Connected successfully"; 

	// compute the md5 hash of the password the user entered
	$tmpAuthCode = $parsedJSON['AuthCode'];
	
	$STH = $conn->prepare('SELECT * from employees WHERE employeeAuth=:param_auth');
	$STH->bindParam(':param_auth', $tmpAuthCode);
	 
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_ASSOC);

	//echo "about to execute SQL";
	$STH->execute();
	//echo "SQL ran";
	
	
	if($emprow = $STH->fetch()) {
		// yes, they are authenticated
		$dbLookupSuccess = 1;
		
		// whole lotta SQL here to obtain sums
		$STH = $conn->prepare('SELECT count(orderID) as todaysCount, sum(orderTotals) as orderTotal
		FROM orders WHERE orderDate BETWEEN DATE_SUB(CURDATE(), INTERVAL 7 DAY) AND CURDATE()');

		$STH->execute();

		$result = $STH->fetch();
		$todaysCount = $result['todaysCount'];
		$orderTotal = $result['orderTotal'];
		
		$arr = array( "Status" => "okay", 
			"OrderCount" => "$todaysCount", 
			"OrderTotal" => "$orderTotal");
	}
	
} // end try
catch(PDOException $e)
	{
	echo "678";
	die();

} // end catch


 
// echo the application data in json format
if($dbLookupSuccess>0) {

/*  example of JSON output 
{ "Status":"okay",
  "OrderCount":"23",
  "OrderTotal":"8723.22" }  */

	echo json_encode($arr);
} else {
	echo "INVALIDCREDENTIALS";
}

// See more at: http://www.semurjengkol.com/populating-android-listview-with-json-based-data-fetched-from-mysql-server-using-php/#sthash.Cm5BFS6C.dpuf



?>