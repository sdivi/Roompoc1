<?php
session_start();
if( isset( $_SESSION['userId'] ) )
{
	include 'connection.php';
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	$email=$_SESSION['userId'];
	$date = date('Y-m-d');

	$conn = dbconnection();
	$qstr="select * from booking,room where email='".$email."' and date >= '".$date."' and booking.roomid=room.roomid";

	$result = mysql_query($qstr);
	$retrunstr = array();
		while($row = mysql_fetch_array($result))
		 {	
			$temparray = array();
			$temparray['requestId'] = $row['requestid'];
			$temparray['roomName'] = $row['roomname'];
			$temparray['startTime'] = $row['starttime'];
			$temparray['endTime'] = $row['endtime'];
			$temparray['date'] = $row['date'];
			$temparray['agenda'] = $row['agenda'];
			$temparray['host'] = $row['host'];
			$temparray['attendees'] = $row['attendees'];
			$temparray['status'] = $row['status'];
			$temparray['location'] = $row['location'];	
			$temparray['branch'] = $row['branch'];	
			$temparray['capacity'] = $row['capacity'];	
			array_push($retrunstr,$temparray);
		 }
		 
	echo json_encode($retrunstr);
}
else{
	?>
	<div>Your Session has been Expired... Please Login..</div>
	<?php
}
?>