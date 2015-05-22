<?php
session_start();

if( isset( $_SESSION['userId'] ) )
{
	?>
	 <div class="homePage" id="pageheader">
		<div class="color-bar-1"></div>
		<div class="color-bar-2"></div>
		
		<div class="pageheader">
			<h2>Conference Room Booking System</h2>
			
			<ul class="nav nav-pills pull-right">
				<li role="presentation" class="active"><a href="" ng-click="selection='home'"> <span class="glyphicon glyphicon-home" aria-hidden="true"></span></a></li>
				<li role="presentation" class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="" role="button" aria-expanded="false">
					  Room Booking <span class="caret"></span>
					</a>
					<ul class="dropdown-menu" role="menu">
						<li role="presentation" class=""><a href="" ng-click="selection='bookRoom'">Book a Room</a></li>
						<li role="presentation" class=""><a href="" ng-click="selection='checkAvail'">Check Availability</a></li>
						<li role="presentation" class=""><a href="" ng-click="selection='status';getRoomStatus()">Status</a></li>
					</ul>
				</li>
				<li role="presentation" class=""><a href="" ng-click="selection='about'">About Us</a></li>
				<li role="presentation" class=""><a href="" ng-click="selection='help'">Help</a></li>
				<li role="presentation" class=""><a href="" ng-click="logOut()">Logout</a></li>
			</ul>
		</div>
		
		
		<div class="content" ng-switch on="selection">
			<div ng-switch-default ng-include="'parallax.php'">
			</div>
			<div ng-switch-when="bookRoom" ng-include="'bookRoom.php'">
			</div>
			<div ng-switch-when="checkAvail" ng-include="'parallax.php'">
			</div>
			<div ng-switch-when="status" ng-include="'status.php'">
			</div>
			<div ng-switch-when="about" ng-include="'parallax.php'">
			</div>
			<div ng-switch-when="help" ng-include="'parallax.php'">
			</div>
		</div>
		
		<nav class="navbar navbar-default" role="navigation">
			<p class="navbar-text navbar-left">&copy;copyrights CLS 2014</p>
		</nav>
		<div ng-controller="ScrollCtrl">
			<a ng-click="gotoTop()" title="Go to top" id="back-top" class="goto-top" style="display: block;">
				<i class="glyphicon glyphicon-plane"></i>
			</a>
		</div>
	</div>	
<?php
}
else{
	//echo "fghfghf";
	?>
	<div class="col-md-offset-4 col-md-1" style="color:white;margin-top:100px">
		<img src="images/smiley1.jpg" alt="Lets smile" height="100px" width="100px" style="border-radius:10px">
	</div>
	<div class="col-md-3" style="color:white;margin-top:100px">
		<h4>Your Session has been Expired...</h4> <br/>
		<a style="color:white;text-decoration:underline;text-align:center" href="#"><h4><i>Click here to Login</i></h4></a>
	</div>
	<?php
}
?>

<script>
$(document).ready(function(){
	//window.location.reload();
	$(".nav-pills>li").click(function(){
		$(".active").removeClass("active");
		$(this).addClass("active");
	});
});
</script>