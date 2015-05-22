<?php
include 'connection.php';

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);

@$location=$request->location;
@$branch=$request->branch;
@$date=$request->selecteddate;

$conn = dbconnection();

  //fetching complete room details;
     $query2="select roomid,roomname from room where location='".$location."' and branch='".$branch."'";
	 $resset2=mysql_query($query2);
	 $roomdetails= array(); 
	 while($row=mysql_fetch_array($resset2)){
	    $temparray=array();
		$temparray['roomid']=$row['roomid'];
		$temparray['roomname']=$row['roomname'];
		array_push($roomdetails,$temparray);	   
	 }
       echo json_encode($roomdetails);

 
?>