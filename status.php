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
		
		<div class="table-responsive col-md-12" ng-init="row='row';inrow='inrow';sortOrder1='caret';orderByName='requestId';">
			<div style="min-height:240px">
				<table class="table table-hover">
					<thead>
						<th></th>
						<th ng-click="clickSort1()">Request Id<span ng-class="sortOrder1"></span></th>
						<th ng-click="clickSort2()">Room Name<span ng-class="sortOrder2"></span></th>
						<th ng-click="clickSort3()">Date<span ng-class="sortOrder3"></span></th>
						<th ng-click="clickSort4()">Start Time<span ng-class="sortOrder4"></span></th>
						<th ng-click="clickSort5()">End Time<span ng-class="sortOrder5"></span></th>
						<th ng-click="clickSort6()">Status<span ng-class="sortOrder6"></span></th>
					</thead>
					<tbody ng-repeat="record in statusDetails | filter:search | orderBy : orderByName | offset: currentPage*itemsPerPage | limitTo: itemsPerPage" >            
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