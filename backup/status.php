<div class="row" ng-controller="ActionController">
	<div class="bookRoomDiv col-md-offset-2 col-md-8">
		<form class="form-horizontal col-md-12" role="form">
			<div class="form-group">
				<div style="margin-top:20px" class="col-sm-4 pull-left">
					<label><h3 style="font-family: Georgia">Booked History</h3></label>
				</div>
			 <div class="form-group">
				<div style="margin-top:20px" class="col-sm-3 pull-right">
					<input type="text" name="searchName" class="form-control" ng-model="search.roomName" placeholder="Room Name"/>
				</div>
			</div>	
		</form>
		
		<div class="table-responsive col-md-12" ng-init="row='row';inrow='inrow';sortOrder1='caret'">
			<div style="min-height:240px">
				<table class="table table-hover">
					<thead>
						<th></th>
						<th ng-click="clickSort1()">Request Id<span class="order"><span class="" ng-class="tabCol=sortOrder1"></span></span></th>
						<th ng-click="sortOrder2='caretReverse'">Room Name<span class="" ng-class="tabCol=sortOrder2" style="margin: 10px 5px;"></span></span></th>
						<th ng-click="sortOrder3='caretReverse'">Date<span class="" ng-class="tabCol=sortOrder3" style="margin: 10px 5px;"></span></span></th>
						<th ng-click="sortOrder4='caretReverse'">Start Time<span class="" ng-class="tabCol=sortOrder4" style="margin: 10px 5px;"></span></span></th>
						<th ng-click="sortOrder5='caretReverse'">End Time<span class="" ng-class="tabCol=sortOrder5" style="margin: 10px 5px;"></span></span></th>
						<th ng-click="sortOrder6='caretReverse'">Status<span class="" ng-class="tabCol=sortOrder6" style="margin: 10px 5px;"></span></span></th>
					</thead>
					<tbody ng-repeat="record in statusDetails | filter:search | offset: currentPage*itemsPerPage | limitTo: itemsPerPage | orderBy : requestId" >            
						<tr id={{row+record.requestId}}>
							<td>
								<a ng-click="showDetails = ! showDetails; changeImageSrc(record.requestId)">
									<img id={{record.requestId}} src="images/details_open.png" alt="^" width="20px" height="20px">
								</a>
							</td>
							<td data-sortable="true">{{record.requestId}}</td>
							<td>{{record.roomName}}</td>
							<td>{{record.date}}</td>
							<td>{{record.startTime}}</td>
							<td>{{record.endTime}}</td>
							<td>{{record.status}}</td>
						</tr>
						<tr  id={{inrow+record.requestId}} ng-show="showDetails" style="background-color:rgba(0, 255, 255, 0.2)">
							<td></td>
							<td colspan="4">
								<p>Location : {{record.location}}</p>
								<p>Branch : {{record.branch}}</p>
								<p>Agenda : {{record.agenda}}</p>
								<p>Host Name : {{record.host}}</p>
								<p>No. of Attendees : {{record.attendees}}</p>	
							</td>
							<td colspan="2">						
								<p><button ng-show="record.status=='Pending'" ng-click="setRequestId(record.requestId)" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Cancel Request</button></p>
							</td>
						</tr>
					</tbody>			
				</table>
			</div>	
				<div>
				  <td colspan="7">
					<div class="form-group pagination pull-left">
					  <select class="form-control" ng-model="itemsPerPage">
						<option>5</option>
						<option>10</option>
						<option>25</option>
						<option>50</option>
					  </select>
					</div>	
					<div class="pull-right">
					  <ul style="list-style:none" class="pagination">
						<li ng-class="prevPageDisabled()">
						  <a href ng-click="prevPage()"> <</a>
						</li>
						<li ng-repeat="n in range()"  ng-class="{active: n == currentPage}" ng-click="setPage(n)">
						  <a href="">{{n+1}}</a>
						</li>
						<li ng-class="nextPageDisabled()">
						  <a href ng-click="nextPage()">></a>
						</li>
					  </ul>
					</div>
				  </td>
				</div>
			<!-- Modal -->
				<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog  modal-sm">
						<div class="modal-content">
							<div class="modal-header">
								<h4 class="modal-title" id="myModalLabel">Confirm to cancel ??</h4>
							</div>
							<div class="modal-body">
								Are you sure to cancel the request {{id}}
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal" ng-click="cancelRequest(id)">Yes</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
							</div>
						</div>
					</div>
				</div>
			<!-- Modal Ends -->	
		</div>
	</div>
</div>

<!--
ng-click="cancelRequest(record.requestId)"
-->