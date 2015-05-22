<?php
session_start();
if( isset( $_SESSION['userId'] ) )
{
	include 'connection.php';
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	$agenda = $request->agenda;
	$selecteddate = $request->selecteddate;
	$roomIdValue = $request->roomIdValue;
	$editStart = $request->editStart;
	$editEnd = $request->editEnd;
	$hostName = $request->hostName;
	$participants = $request->participants;
	$userId=$_SESSION['userId'];
	
	$conn = dbconnection();
	$qstr="INSERT INTO  `pocdb`.`booking` (`email` ,`roomid` ,`starttime` ,`endtime` ,`date` ,`agenda` ,`host` ,`attendees`) 
	VALUES ('".$userId."',  ".$roomIdValue.",  '".$editStart."',  '".$editEnd."',  '".$selecteddate."',  '".$agenda."',  '".$hostName."',  ".$participants.")";

	$result = mysql_query($qstr);
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