<?php
	include 'connection.php';
	$conn = dbconnection();
	
	$res = mysql_query("select distinct location from room");
	
	$retrunstr = array();
	while($row = mysql_fetch_array($res)){	
		array_push($retrunstr,$row['location']);
	 }
	 
	  echo json_encode($retrunstr);
	
?>