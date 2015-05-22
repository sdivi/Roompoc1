<?php

include 'connection.php';
$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

//echo "<pre>";
//print_r($request);

$roomId = $request->room;
$selecteddate = $request->selecteddate;
//echo $roomId;
//echo json_encode($request);

$conn = dbconnection();
$qstr="select starttime,endtime from booking where roomid='".$roomId."' and date='".$selecteddate."' order by starttime";

$result = mysql_query($qstr);
$retrunstr = array();
	while($row = mysql_fetch_array($result))
	 {	
		$temparray = array();
		$temparray['start'] = $row['starttime'];
		$temparray['end'] = $row['endtime'];
		array_push($retrunstr,$temparray);
	 }
	 
echo json_encode($retrunstr);
?>