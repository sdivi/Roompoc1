<div class="row" ng-controller="ActionController">
<div class="bookRoomDiv col-md-offset-2 col-md-8">

	<ul class="nav nav-tabs" ng-init="tab1Class='active'">
		<li role="presentation" class="" ng-class="tab1Class"><a>Step1</a></li>
		<li role="presentation" class="" ng-class="tab2Class"><a>Step2</a></li>
		<li role="presentation" class="" ng-class="tab3Class"><a>Step3</a></li>
		<li role="presentation" class="" ng-class="tab4Class"><a>Step4</a></li>
	</ul>
	
	<!--Tab1-->
	<div class="tab1" ng-init="tab1Flag=true" ng-show="tab1Flag">
		<form name="myForm" class="form-horizontal" role="form" novalidate>
			<div class="form-group">
				<label for="location" class="col-md-3 col-md-offset-1 pull-left">Select Location</label>
				<div class="col-md-6">
					<select id="location" ng-model="selectedLocation" class="form-control" ng-init="getLocation()" ng-change="getBranch()" ng-options="itr for itr in locations" required>
						<option value="">--Select--</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="branch" class="col-md-3  col-md-offset-1 pull-left">Select Branch</label>
				<div class="col-md-6">
					<select id="branch" ng-model="selectedBranch" class="form-control" ng-selected="!selectedLocation"  ng-disabled="!selectedLocation" ng-options="branch for branch in branches" required>
						<option value="">--Select--</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<label for="agenda" class="col-md-3 col-md-offset-1 pull-left">Agenda</label>
				<div class="col-md-6">
					<input type="text" name="agenda" ng-model="agenda" class="form-control" id="agenda" required placeholder="Agenda">
				</div>
			</div>
			
			<div class="form-group" style="margin-top:50px">
				<div class="col-md-offset-1 col-md-9">
					<button class="btn btn-primary pull-left" ng-disabled="true" ng-click="">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Prev
					</button>
					<button ng-disabled="myForm.$invalid" class="btn btn-primary pull-right" ng-click="nextOne()">Next
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</button>
				</div>
			</div>
			
			
		</form>
	</div>
	<!--Tab2-->
	<div class="tab2" ng-init="tab2Flag=false" ng-show="tab2Flag">
		<form name="myForm1" class="form-horizontal" style="margin-top: -20px" role="form" novalidate>
			<div class="row"  style="height:110px" ng-init="timeShowPicker=false" >
				<div class="col-md-4">
					<div class="form-group">
						<label for="date" class="col-md-offset-1 col-md-2 pull-left">Date</label>
						<div class="col-md-offset-1 col-md-8">
							<input class="form-control" type="date" id="date" min="<?php echo date("Y-m-d"); ?>" ng-model="selecteddate" ng-change="changeDate()" required></input>
						</div>
					</div>
				</div>
				<div class="col-md-4" ng-show="timeShowPicker">
					<div class="form-group"  style="margin-bottom:0px" class="col-md-4" ng-init="flag=false">
						<label for="startTime" class="col-md-5">Start Time</label>
						<div class="input-group col-md-7">
							<input class="form-control" id="startTime" type="text" placeholder="Start time" ng-model="editStart" readonly=true required>
								<span class="input-group-addon"><span ng-click="showStartHour()" class="glyphicon glyphicon-time"></span></span>
						</div>
					</div>
				</div>
				<div class="col-md-4" ng-show="timeShowPicker">
					<div class="form-group" style="margin-bottom:0px" class="col-md-4" ng-init="flag=false">
						<label for="endTime" class="col-md-4">End Time</label>
						<div class="input-group col-md-7">
							<input class="form-control" type="text" id="endTime" placeholder="End time" ng-model="editEnd" readonly=true required>
								<span class="input-group-addon"><span ng-click="showEndHour()" class="glyphicon glyphicon-time"></span></span>
						</div>
					</div>
				</div>
				<div class="col-md-8 pull-right">
					<div ng-init="timeShowS=false" class="col-md-6" ng-show="timeShowS">
						<table class="pull-right">
							<tr>
								<td><a href="" ng-click="timeIncS()"><i class="glyphicon glyphicon-chevron-up arrow"></i></a></td>
								<td class="seperator">&nbsp;</td>
								<td><a href="" ng-click="minIncS()"><i class="glyphicon glyphicon-chevron-up arrow2"></i></a></td>
							</tr>
				
							<tr>
								<td><input type="text" ng-model="timeS" readonly=true style="width:30px;text-align:center;margin-right:7px;"></input></td>
								<td class="seperator">:</td>
								<td><input type="text" ng-model="minS" readonly=true style="width:30px;text-align:center;margin-left:7px;"></input></td>
							</tr>
				
							<tr>
								<td><a href="" ng-click="timeDecS()"><i class="glyphicon glyphicon-chevron-down arrow"></i></a></td>
								<td class="seperator">&nbsp;</td>
								<td><a href="" ng-click="minDecS()"><i class="glyphicon glyphicon-chevron-down arrow2"></i></a></td>
							</tr>
						</table>
					</div>
					
					<div ng-init="timeShowE=false" class="col-md-4 pull-right" ng-show="timeShowE">
						<table class="pull-right">
							<tr>
								<td><a href="" ng-click="timeIncSE()"><i class="glyphicon glyphicon-chevron-up arrow"></i></a></td>
								<td class="seperator">&nbsp;</td>
								<td><a href="" ng-click="minIncSE()"><i class="glyphicon glyphicon-chevron-up arrow2"></i></a></td>
							</tr>
							
							<tr>
								<td><input type="text" ng-model="timeSE" readonly=true style="width:30px;text-align:center;margin-right:7px;"></input></td>
								<td class="seperator">:</td>
								<td><input type="text" ng-model="minSE" readonly=true style="width:30px;text-align:center;margin-left:7px;"></input></td>
							</tr>
							
							<tr>
								<td><a href="" ng-click="timeDecSE()"><i class="glyphicon glyphicon-chevron-down arrow"></i></a></td>
								<td class="seperator">&nbsp;</td>
								<td><a href="" ng-click="minDecSE()"><i class="glyphicon glyphicon-chevron-down arrow2"></i></a></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-1  col-md-7" style="padding-left:0px">
					<div ng-repeat="itr in rooms" class="col-md-2" ng-init="btn='btn'">
						<button id={{btn+itr.roomid}} ng-click="checkTimings(itr.roomid);showTimingsDiv(itr.roomid)" type="button" class="btn btn-default roomBut" ng-disabled=true>
							<img id={{itr.roomid}} ng-src={{roomImgUrl}} height="40px" width="40px" alt="Room"><p style="color:black;word-break: break-all">{{itr.roomname}}</p>
						</button>
					</div> 
				</div>
				<div class="col-md-3 availableDiv" ng-show="showAvailableTimings">
					<h5 style="color:black">Available Timings for <span style="color: #2d5fa2">{{roomName}}</span> of capacity {{capacity}}</h5>
					<p ng-repeat="r in arr"><a href="" ng-click="selectedTime(r.start,r.end)" style="color:darkcyan">{{r.start}}----{{r.end}}</a></p>
				</div>
			</div>
			<div class="form-group" style="margin-top:20px">
				<div class="col-md-offset-1 col-md-9">
					<button class="btn btn-primary pull-left" ng-disabled="false" ng-click="tab1Flag=true;tab2Flag=false;tab3Flag=false;tab4Flag=false;tab1Class='active';tab2Class='';tab3Class='';tab4Class='';timeShowPicker=false;">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Prev
					</button>
					<button ng-disabled="myForm1.$invalid" class="btn btn-primary pull-right" ng-click="nextTwo()">Next
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</form>
		<!--<button class="button" ng-click="checkavailability()" value="submit">Next</button><br/><br/>-->
			
	</div>
	
	<!--Tab3-->
	<div class="tab3" ng-init="tab3Flag=false" ng-show="tab3Flag">
		<form name="myForm2" class="form-horizontal" role="form" novalidate>
			<div class="form-group">
				<label for="agenda" class="col-md-3 col-md-offset-1 pull-left">Agenda</label>
				<div class="col-md-6">
					<input type="text" name="agenda" ng-model="agenda" class="form-control" id="agenda" required>
				</div>
			</div>
			<div class="form-group">
				<label for="host" class="col-md-3 col-md-offset-1 pull-left">Host Name</label>
				<div class="col-md-6">
					<input type="text" name="host" ng-model="hostName" class="form-control" id="host" required placeholder="Host Name">
				</div>
			</div>
			<div class="form-group">
				<label for="participants" class="col-md-3 col-md-offset-1 pull-left">Number of Participants</label>
				<div class="col-md-6">
					<input type="number" min="1" max="50" name="participants" ng-model="participants" class="form-control" id="participants" required placeholder="Participant Number">
				</div>
			</div>
			
			<div class="form-group">
				<label for="mailIds" class="col-md-3 col-md-offset-1 pull-left">Mail Ids of Participants</label>
				<div class="col-md-6">
					<textarea class="form-control" rows="3" name="mailIds" id="mailIds" ng-model="mailIds" placeholder="name1@domain.ext , name2@domain.ext , .."></textarea>
				</div>
			</div>
	
			<div class="form-group">
				<div class="col-md-offset-1 col-md-9" style="margin-top:50px">
					<button class="btn btn-primary pull-left" ng-disabled="false" ng-click="tab1Flag=false;tab2Flag=true;tab3Flag=false;tab4Flag=false;tab1Class='';tab2Class='active';tab3Class='';tab4Class='';timeShowE=false;timeShowS=false">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Prev
					</button>
					<button ng-disabled="myForm2.$invalid" class="btn btn-primary pull-right" ng-click="finish()">Proceed
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					</button>
				</div>
			</div>
		</form>
	</div>
	
	<!--Tab4-->
	<div class="tab4 row" ng-init="tab4Flag=false" ng-show="tab4Flag">
		<h2 class="col-md-offset-4 col-md-8"  style="margin-top:-40px;margin-bottom:30px;color:darkcyan">Confirm Details !!!</h2>
		<form name="finalForm" class="form-horizontal" role="form" novalidate>
		<div class="col-md-6">
			<div class="form-group">
				<label for="selectedLocation" class="col-md-5 col-md-offset-1 pull-left">Select Location</label>
				<div class="col-md-6">
					<input type="text" name="selectedLocation" ng-model="selectedLocation" class="form-control" id="selectedLocation" readonly=true>
				</div>
			</div>
			<div class="form-group">
				<label for="selectedBranch" class="col-md-5 col-md-offset-1 pull-left">Select Branch</label>
				<div class="col-md-6">
					<input type="text" name="selectedBranch" ng-model="selectedBranch" class="form-control" id="selectedBranch" readonly=true>
				</div>
			</div>
			<div class="form-group">
				<label for="agenda" class="col-md-5 col-md-offset-1 pull-left">Agenda</label>
				<div class="col-md-6">
					<input type="text" name="agenda" ng-model="agenda" class="form-control" id="agenda" readonly=true>
				</div>
			</div>
			<div class="form-group">
				<label for="date" class="col-md-5 col-md-offset-1 pull-left">Date</label>
				<div class="col-md-6">
					<input type="text" name="date" ng-model="selecteddate" class="form-control" id="date" readonly=true>
				</div>
			</div>
			<div class="form-group">
				<label for="room" class="col-md-5 col-md-offset-1 pull-left">Room Name</label>
				<div class="col-md-6">
					<input type="text" name="room" ng-model="roomName" class="form-control" id="room" readonly=true>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="editStart" class="col-md-4 col-md-offset-1 pull-left">Start Time</label>
				<div class="col-md-6">
					<input type="text" name="editStart" ng-model="editStart" class="form-control" id="editStart" readonly=true>
				</div>
			</div>
			<div class="form-group">
				<label for="editEnd" class="col-md-4 col-md-offset-1 pull-left">End Time</label>
				<div class="col-md-6">
					<input type="text" name="editEnd" ng-model="editEnd" class="form-control" id="editEnd" readonly=true>
				</div>
			</div>
			<div class="form-group">
				<label for="host" class="col-md-4 col-md-offset-1 pull-left">Host Name</label>
				<div class="col-md-6">
					<input type="text" name="host" ng-model="hostName" class="form-control" id="host" readonly=true>
				</div>
			</div>
			<div class="form-group">
				<label for="participants" class="col-md-4 col-md-offset-1 pull-left">Number of Participants</label>
				<div class="col-md-6">
					<input type="text" name="participants" ng-model="participants" class="form-control" id="participants" readonly=true>
				</div>
			</div>
		</div>	
			<div class="form-group">
				<div class="col-md-offset-5 col-md-7">
					<button class="btn btn-primary" ng-click="tab1Flag=true;tab2Flag=false;tab3Flag=false;tab4Flag=false;tab1Class='active';tab2Class='';tab3Class='';tab4Class=''" style="padding: 6px 20px;">Modify</button>
					<button class="btn btn-success" ng-click="submitBooking()"  data-toggle="modal" data-target="#myModal" style="margin-left:30px">Submit</button>
					<!-- Modal -->
					<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog  modal-sm">
							<div class="modal-content">
							  <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"></button>
								<h4 class="modal-title" id="myModalLabel">Registration Successful !!!</h4>
							  </div>
							  <div class="modal-body">
								<img src="images/okay.jpg" alt="okay" width="50px" style="margin-left:100px">
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" ng-click="returnToBook()">Ok</button>
								
							  </div>
							</div>
						</div>
					</div>
					<!-- Modal Ends -->	
				</div>
			</div>
			
			
		</form>
	</div>
	
</div>

</div>