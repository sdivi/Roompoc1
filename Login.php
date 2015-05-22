<?php
session_start();
$session_id_val = '';
//echo "Session echo  ".$_SESSION["userId"];
	if(isset($_SESSION["userId"]))
	{
		$session_id_val = $_SESSION["userId"];
	} 

		?> 
	<div class="loginDiv">
	<h2>Login</h2>
	<form method="post" class="form-horizontal">
	
	<div class="form-group" >
		<label for="name" class="col-md-4 control-label">Email Id</label>
		<div class="col-md-6">
			<input name="name" type="text" id="lname" class="form-control" placeholder="UserName" ng-model="email" required />
		</div>
	</div>
	<div class="form-group">
		<label for="pwd" class="col-md-4 control-label">Password</label>
		<div class="col-md-6">
			<input name="pwd" type="password" id="lpwd" class="form-control"  ng-model="pwd" placeholder="********" required/>
		</div>
	</div>
	<div class="form-group">
		<span ng-bind="loginErrorMsg" class="col-md-offset-3 col-md-6" style="color:red"></span>
	</div>
	<div class="form-group">
		<div class="col-md-offset-4 col-md-6">
			<button type="submit" class="btn btn-default" ng-click="login('homePage')">Login</button>
			<button type="reset" class="btn btn-default" ng-click="loginErrorMsg=''">Reset</button>
		</div>
	</div>
	<input type="hidden" name="session_name" id="session_id" value="<?php echo $session_id_val;?>" />
	</form>
	</div>

