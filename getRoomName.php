<?php

include 'connection.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

$roomId = $request->room;

$conn = dbconnection();
$qstr="select roomname , capacity from room where roomid='".$roomId."'";
//$qstr2="select roomid,starttime,endtime,date,count(*) from booking  where status="Pending" and roomid=101 group by roomid,endtime,starttime,date";

$result = mysql_query($qstr);
$temparray = array();
	if($row = mysql_fetch_array($result))
	 {	
		$temparray['roomName'] = $row['roomname'];
		$temparray['capacity'] = $row['capacity'];
	 }
	 
echo json_encode($temparray);
?>