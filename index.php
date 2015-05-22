<?php
session_start();
$session_id_val = '';
//echo "Session echo  ".$_SESSION["userId"];
	if(isset($_SESSION["userId"]))
	{
		$session_id_val = $_SESSION["userId"];
	} 

		?>  
		<!Doctype html>
		<html ng-app="myApp">
		<head>
		<meta charset="UTF-8">
		<title>Book a Room</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/Login.css">
		<link rel="stylesheet" type="text/css" href="css/Index.css">
		</head>
		<body ng-controller="LoginController">
			<ng-view></ng-view>
			<script src="js/jquery.min.js"></script>
			<script src="js/bootstrap.min.js"></script>
			<script src="js/angular.min.js"></script>
			<script src="js/Script.js"></script>
			<input type="hidden" name="session_name" id="session_id" value="<?php echo $session_id_val;?>" />

			<script>
			$(document).ready(function(){				
				var sessionId=$("#session_id").val();
				console.log("Session Id : "+sessionId);
				if(sessionId!='')
					window.location.href = "http://localhost/Room_POC/#/homePage";			
			});
			</script>
			
		</body>
		</html>
