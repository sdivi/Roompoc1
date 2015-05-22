<?php
session_start();
if( isset( $_SESSION['userId'] ) )
{
	include 'connection.php';
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	$email=$_SESSION['userId'];
	$id = $request->reqId;
	//echo 'id  '.$id;
	$conn = dbconnection();
	$qstr="delete from booking where requestid=".$id;

	$result = mysql_query($qstr);
	//echo $result;
	if($result)
		echo "success";
	else
		echo "failure";
}
else{
	?>
	<div>Your Session has been Expired... Please Login..</div>
	<?php
}
?>