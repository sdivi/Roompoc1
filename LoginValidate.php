<?php
session_start();
include 'connection.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

//echo "<pre>";
//print_r($request);

@$email = $request->email;
@$password = $request->password;

//echo json_encode($request);

$conn = dbconnection();
$qstr="select * from login where email='".$email."' and password='".$password."'";

$result = mysql_query($qstr);
$numrows = 0;
if($result)
	$numrows = mysql_num_rows($result);

if($numrows > 0){	
		$_SESSION["userId"]=$email;

		echo $_SESSION["userId"];
	
}
//else
	//echo "failure";
?>