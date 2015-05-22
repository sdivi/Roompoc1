<?php
include 'connection.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

@$location=$request->location;

$conn = dbconnection();

$query="select distinct branch from room where location='".$location."'";
$res= mysql_query($query);
$retrunstr = array();
	
	while($row = mysql_fetch_array($res))
	 {	
		
		array_push($retrunstr,$row['branch']);
	 }
	 
	  echo json_encode($retrunstr);