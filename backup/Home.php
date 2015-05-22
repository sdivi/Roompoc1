 	<div class="page-header">
		<h2>Conference Room Booking System
		<a href="Login.html" ng-click="logout()" class="pull-right" ng-controller="LogoutController">Logout</a></h2>
	</div>
	
	<div class="container">
		<div>
			<div class="col-md-12">
				<div id="myCarousel" class="carousel slide" data-interval="3000">
					<!-- Carousel indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
						<li data-target="#myCarousel" data-slide-to="3"></li>
					</ol>   
					<!-- Carousel items -->
					<div class="carousel-inner">
						<div class="item active">
							<img src="images/room1.jpg" class="image-responsive" alt="First slide">
						</div>
						<div class="item">
							<img src="images/room2.jpg" class="image-responsive" alt="Second slide">
						</div>
						<div class="item">
							<img src="images/room3.jpg" class="image-responsive" alt="Third slide">
						</div>
						<div class="item">
							<img src="images/room5.jpg" class="image-responsive" alt="Fourth slide">
						</div>
					</div>
					
					<div class="col-md-2" style="position:absolute; top:0px;">
						<ul class="nav nav-pills nav-stacked">
							<li><a href="#">Home</a></li>
							<li><a href="#">Book a Room</a></li>
							<li><a href="#">Check Availability</a></li>
							<li><a href="#">Reshedule</a></li>
							<li><a href="#">Status</a></li>
							<li><a href="#">Contact Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

	</div>
	
	<nav class="navbar navbar-default" role="navigation">
		<p class="navbar-text navbar-left">&copy;copyrights CLS 2014</p>
	</nav>
