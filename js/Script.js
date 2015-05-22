var app = angular.module('myApp',[]);

app.config(['$routeProvider',function($routeProvider){
 $routeProvider.when('/',{
	templateUrl : 'Login.php',
	controller : 'LoginController'
 }).when('/homePage',{
	templateUrl : 'Home.php',
	controller : 'ActionController'
 }).when('/logout',{
	templateUrl : 'Login.php',
	controller : 'LoginController'
 }).otherwise({
	redirectTo : 'Login.php'
 });

}]);

app.run(['$anchorScroll',function($rootScope,$anchorScroll) {
	$rootScope.id=987654;
		$rootScope.bookingDetails=null;
    $rootScope.showAvailableTimings =false;
	//$anchorScroll.yOffset = 50;
}]);

app.controller('LoginController',function($scope,$http,$location){
	
	$scope.login=function(path){
	var request = $http({
		method: "post",
		url: "LoginValidate.php",
		data: {
			email: $scope.email,
			password: $scope.pwd
		}
		,headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
	});
 
	request.success(function (data,status,headers,config) {
		console.log("login status : "+data);
		if(data)
		{
			var session = document.getElementById("session_id").value;
			console.log("js session : "+session);
			if(session!='')
			{
				window.location.href = "http://localhost/Room_POC/#/homePage";						
			}
			$location.path(path);
		}
		else{
			$scope.loginErrorMsg="Invalid Credentials";
		}
	});
	};
	
});

app.controller('ActionController',function($scope,$location,$http,$rootScope){
	
	$scope.logOut = function(){
	console.log("In logout");
		var logoutVar = $http({
				method: "post",
				url: "logout.php",
				headers: { 'Content-Type': 'application/json' }
			});
			
		logoutVar.success(function(data,status,headers,config){
			console.log("In logout"+data);
			$location.path("/");
		});
		logoutVar.error(function(data,status,headers,config){
			alert("AJAX error");
		});
	};

	$scope.showTimingsDiv = function(roomId){
		if(document.getElementById("btn"+roomId).disabled == true )
			$rootScope.showAvailableTimings = false;
		else
			$rootScope.showAvailableTimings = true;
		
	};
	
	
	$scope.getLocation = function(){
		var locationReq=$http({
			method:'get',
			url:'location.php',
			data:{},
			headers:{'Content-Type': 'application/json' }
		});
		
		locationReq.success(function(data,status,headers,config){
		console.log(data);
		$scope.locations=data;
		});

		locationReq.error(function(){
			alert("ajax error");
		});
	};
	
	$scope.getBranch = function(){
		var locationReq=$http({  
			method:'post',
			url:'branch.php',
			data:{
				location:$scope.selectedLocation
			},			
			headers:{'Content-Type': 'application/json' }
		});

		locationReq.success(function(data,status,headers,config){
			console.log(data);
			$scope.branches=data;
		});
		
		locationReq.error(function(){
			alert("ajax error");
		});
	};
	
	$scope.nextOne=function(){
		$scope.roomImgUrl="images/defaultRoom.jpg";
		$scope.tab1Flag=false;
		$scope.tab2Flag=true;
		$scope.tab3Flag=false;
		$scope.tab4Flag=false;
		$scope.tab1Class='';
		$scope.tab2Class='active';
		$scope.tab3Class='';
		$scope.tab4Class='';
		$scope.selecteddate='';
		$scope.editStart='';
		$scope.editEnd='';
		$rootScope.showAvailableTimings=false;
		$scope.timeShowS=false;
		$scope.timeShowE=false;
		var request=$http({   
			method:'post',
			url:'logindao.php',
			data:{
				location    :$scope.selectedLocation,
				branch      :$scope.selectedBranch,
				selecteddate:$scope.selecteddate
			},
			headers:{ 'Content-Type': 'application/json' }
		});
		
		request.success(function(data,status,headers,config){
			console.log(data);
			$scope.rooms=data;
		});
		request.error(function(){
			alert("ajax error");
		});	
	};
	
	$scope.nextTwo = function(){
		$scope.tab1Flag=false;
		$scope.tab2Flag=false;
		$scope.tab3Flag=true;
		$scope.tab4Flag=false;
		$scope.tab4Class='';
		$scope.tab1Class='';
		$scope.tab2Class='';
		$scope.tab3Class='active';
	
	};
	
	$scope.finish = function(){
		$scope.tab1Flag=false;
		$scope.tab2Flag=false;
		$scope.tab3Flag=false;
		$scope.tab4Flag=true;
		$scope.tab1Class='';
		$scope.tab2Class='';
		$scope.tab3Class='';
		$scope.tab4Class='active';
	};
	
	$scope.submitBooking = function(){
		
		var insertRoom = $http({
				method: "post",
				url: "insertRoom.php",
				data: {
					agenda : $scope.agenda,
					selecteddate : $scope.selecteddate,
					editStart : $scope.editStart,
					editEnd : $scope.editEnd,
					hostName : $scope.hostName,
					participants : $scope.participants,
					roomIdValue : $scope.roomIdValue
				}
				,headers: { 'Content-Type': 'application/json' }
			});
			
		insertRoom.success(function(data,status,headers,config){
			console.log("insert after : "+data);
			if(data=="success"){
				//alert("insert successful ");
				$scope.bookRoomDivShow=false;
			}
			else{
				alert("insertion failure ");
			}
			
		
		});
		insertRoom.error(function(data,status,headers,config){
			//console.log("insert after : "+data);
			alert("AJAX error");
		
		});
	
	};
	
	$scope.returnToBook=function(){
		$scope.bookRoomDivShow=true;
		$scope.tab1Flag=true;
		$scope.tab2Flag=false;
		$scope.tab3Flag=false;
		$scope.tab4Flag=false;
		$scope.tab1Class='active';
		$scope.tab2Class='';
		$scope.tab3Class='';
		$scope.tab4Class=''
		$scope.selectedLocation='';
		$scope.selectedBranch='';
		$scope.agenda='';
		$scope.hostName='';
		$scope.participants='';
		$scope.mailIds='';
		$scope.timeShowPicker=false;
	};
	//Change Date function
	
	$scope.changeDate = function(){
		for(i in $scope.rooms){
			$scope.checkTimings($scope.rooms[i].roomid);
		}
		if($scope.showAvailableTimings == true){
			$scope.showAvailableTimings = false;
			$scope.timeShowPicker=false;
			$scope.timeShowE=false;
			$scope.timeShowS=false;
		}
	};
	
	//get available timings
	
	$scope.checkTimings = function(roomId){
		if($scope.showAvailableTimings == false){
			$scope.showAvailableTimings = true;
		}
		var requestRoom = $http({
				method: "post",
				url: "getRoomName.php",
				data: {
					room: roomId
				}
				,headers: { 'Content-Type': 'application/json' }
			});
			
		requestRoom.success(function(data,status,headers,config){
			$scope.roomIdValue = roomId;
			$scope.roomName = data.roomName;
			//console.log("room hai"+$scope.roomName);
			$scope.capacity=data.capacity;
		
		});
		document.getElementById(roomId).src="images/emptyRoom.jpg";
		document.getElementById("btn"+roomId).disabled = false;

		if(!$scope.selecteddate){
			document.getElementById("btn"+roomId).disabled = true;
			document.getElementById(roomId).src="images/defaultRoom.jpg";
			//alert("please select date");
		}
		else{
			var request = $http({
				method: "post",
				url: "roomDet.php",
				data: {
					room: roomId,
					selecteddate:$scope.selecteddate
				}
				,headers: { 'Content-Type': 'application/json' }
			});

			request.success(function (data,status,headers,config) {
				//console.log("room details :"+data);
				
				var array=[];
				$scope.arr=[];
				if(data.length)
				{
					//console.log("length :"+data.length);
					//console.log("data :"+data[0].start);
					var a="09:00:00",b="21:00:00";
					//console.log(data[0].start.substring(0,2)>a.substring(0,2));
					//console.log(data[0].start.substring(3,5)-a.substring(3,5));
					var i;
					for(i=0 ; i < data.length ; i++)
					{
						var time=[];
						if(a.substring(0,2) < data[i].start.substring(0,2)){
							time.start=a.substring(0,5);
							time.end=data[i].start.substring(0,5);						
							array.push(time);
							//console.log(time);
						}
						if(a.substring(0,2) == data[i].start.substring(0,2)){
							if(a.substring(3,5) < data[i].start.substring(3,5))
							{
								time.start=a.substring(0,5);
								time.end=data[i].start.substring(0,5);						
								array.push(time);
								//console.log(time);
							}		
						}
						a=data[i].end.substring(0,5);
					}
					//console.log("i value"+i);
					if(i == data.length)
					{
						//console.log("in 1");
						var time=[];
							if(data[i-1].end.substring(0,2)<b.substring(0,2))
							{
								time.start=data[i-1].end.substring(0,5);
								time.end=b.substring(0,5);
								array.push(time);
							}
							//console.log(time);
					}	
					if(array.length==0)
					{
						var time=[];
						time.start="There are no available slots";
						time.end="Please select an another room";
						array.push(time);
						document.getElementById(roomId).src="images/bookedRoom.jpg";
						document.getElementById("btn"+roomId).disabled = true;
					}
				}
				else
				{
					var time=[];
					time.start="09:00";
					time.end="21:00";
					array.push(time);
					//alert(array[0].start);
					
				}
				$scope.arr=array;
				//alert("In one"+array[0].start + $scope.roomAva);
			});			
		}
		//console.log("In method call end");
	};
	
	//Selecte time
	$scope.selectedTime = function(start,end){
		$scope.timeShowPicker=true;
		$scope.editStart=start;
		$scope.editEnd=end;
		
		//Start time var
		$scope.startValueHour=parseInt(start.substring(0,2));
		$scope.startValueMin=parseInt(start.substring(3,5));
		$scope.endValueHour=parseInt(end.substring(0,2));
		$scope.endValueMin=parseInt(end.substring(3,5))
		
		$scope.timeS=parseInt($scope.editStart.substring(0,2));
		$scope.minS=parseInt($scope.editStart.substring(3,5));	
		
		$scope.timeE=parseInt($scope.editEnd.substring(0,2));
		$scope.minE=parseInt($scope.editEnd.substring(3,5));
		
		if($scope.minE==00)
		{
			$scope.timeE=$scope.timeE-1;
			$scope.minE=45;
			$scope.endValueHour=$scope.endValueHour-1;
			$scope.endValueMin=45;
		}
		else{
			$scope.minE=$scope.minE-15;
			$scope.endValueMin=$scope.endValueMin-15;
		}
		
		//End Time var
		$scope.startValueHourE=$scope.timeS;
		$scope.startValueMinE=$scope.minS;
		$scope.endValueHourE=parseInt(end.substring(0,2));
		$scope.endValueMinE=parseInt(end.substring(3,5))
		
		
		$scope.timeSE=$scope.timeS;
		$scope.minSE=$scope.minS;	
		
		$scope.timeEE=parseInt($scope.editEnd.substring(0,2));
		$scope.minEE=parseInt($scope.editEnd.substring(3,5));
		
		if($scope.minSE==45)
		{
			$scope.timeSE=$scope.timeSE+1;
			$scope.minSE=00;
			$scope.startValueHourE=$scope.startValueHourE+1;
			$scope.startValueMinE=00;
		}
		else{
			$scope.minSE=$scope.minSE+15;
			$scope.startValueMinE=$scope.startValueMinE+15;
		}
	};
	
	$scope.showStartHour = function(){
		$scope.timeShowE=false;
		$scope.timeShowS=!$scope.timeShowS;
	};
	$scope.showEndHour = function(){
		$scope.timeShowS=false;
		$scope.timeShowE=!$scope.timeShowE;
	}; 
	
	//Start Time Logic
	$scope.timeIncS=function(){
		 if($scope.timeS==$scope.timeE)
			{
				$scope.timeS=$scope.timeE;
			}
		else if($scope.timeS==$scope.timeE-1 && ($scope.minS==45 || $scope.minS==30 || $scope.minS==15)){
			$scope.timeS=$scope.timeE;
			$scope.minS=$scope.minE;
		}
		else
			$scope.timeS=$scope.timeS+1;
			
		$scope.editStart = $scope.timeS+":"+$scope.minS;
		$scope.timeSE=$scope.timeS;
		$scope.minSE=$scope.minS;	
		$scope.startValueHourE=$scope.timeS;
		$scope.startValueMinE=$scope.minS;
		
		if($scope.minSE==45)
		{
			$scope.timeSE=$scope.timeSE+1;
			$scope.minSE=00;
			$scope.startValueHourE=$scope.startValueHourE+1;
			$scope.startValueMinE=00;
		}
		else{
			$scope.minSE=$scope.minSE+15;
			$scope.startValueMinE=$scope.startValueMinE+15;
		}
		$scope.editEnd = $scope.timeSE+":"+$scope.minSE;
	};
	
	$scope.timeDecS=function(){
		
		if($scope.timeS > $scope.startValueHour)
			{
					$scope.timeS=$scope.timeS-1;
			}
		if($scope.timeS == $scope.startValueHour && $scope.minS < $scope.startValueMin)
				{
						$scope.minS=$scope.startValueMin;
				}
		
		$scope.editStart = $scope.timeS+":"+$scope.minS;
		$scope.timeSE=$scope.timeS;
		$scope.minSE=$scope.minS;
		$scope.startValueHourE=$scope.timeS;
		$scope.startValueMinE=$scope.minS;
		
		if($scope.minSE==45)
		{
			$scope.timeSE=$scope.timeSE+1;
			$scope.minSE=00;
			$scope.startValueHourE=$scope.startValueHourE+1;
			$scope.startValueMinE=00;
		}
		else{
			$scope.minSE=$scope.minSE+15;
			$scope.startValueMinE=$scope.startValueMinE+15;
		}
		$scope.editEnd = $scope.timeSE+":"+$scope.minSE;
	};
	
	$scope.minIncS=function(){
		if($scope.minS==45)
			{
				if($scope.timeS==$scope.timeE && $scope.minS==$scope.minE)	
					$scope.minS=$scope.minE;	
				else
					$scope.minS=00;
				
				if($scope.timeS<$scope.endValueHour)
				{
					$scope.timeS=$scope.timeS+1;
					$scope.minS=00;
				}
			}
		else if($scope.timeS==$scope.timeE  && $scope.minS==$scope.minE)
		{
			$scope.timeS=$scope.timeE;
			$scope.minS=$scope.minE;
		}
		else
			$scope.minS=$scope.minS+15;
		
		$scope.editStart = $scope.timeS+":"+$scope.minS;	
		$scope.timeSE=$scope.timeS;
		$scope.minSE=$scope.minS;
		$scope.startValueHourE=$scope.timeS;
		$scope.startValueMinE=$scope.minS;
		
		if($scope.minSE==45)
		{
			$scope.timeSE=$scope.timeSE+1;
			$scope.minSE=00;
			$scope.startValueHourE=$scope.startValueHourE+1;
			$scope.startValueMinE=00;
		}
		else{
			$scope.minSE=$scope.minSE+15;
			$scope.startValueMinE=$scope.startValueMinE+15;
		}
		$scope.editEnd = $scope.timeSE+":"+$scope.minSE;
	};
	
	$scope.minDecS=function(){
		if($scope.minS==0 && $scope.timeS>$scope.startValueHour)
			{
				$scope.minS=45;
				$scope.timeS=$scope.timeS-1;
			}
		
		else if($scope.timeS==$scope.startValueHour )
			{
				if($scope.minS <= $scope.startValueMin){
					//$scope.timeS=$scope.startValueHour;
					$scope.minS=$scope.startValueMin;
				}
				else
				{
					//$scope.minS=$scope.startValueMin;
					$scope.minS=$scope.minS-15;
				}
			}
		else
			$scope.minS=$scope.minS-15;
		
		$scope.editStart = $scope.timeS+":"+$scope.minS;
		$scope.timeSE=$scope.timeS;
		$scope.minSE=$scope.minS;
		$scope.startValueHourE=$scope.timeS;
		$scope.startValueMinE=$scope.minS;
		
		if($scope.minSE==45)
		{
			$scope.timeSE=$scope.timeSE+1;
			$scope.minSE=00;
			$scope.startValueHourE=$scope.startValueHourE+1;
			$scope.startValueMinE=00;
		}
		else{
			$scope.minSE=$scope.minSE+15;
			$scope.startValueMinE=$scope.startValueMinE+15;
		}
		$scope.editEnd = $scope.timeSE+":"+$scope.minSE;
	};
	
	//End Time logic
	 $scope.timeIncSE=function(){
		 if($scope.timeSE==$scope.timeEE)
			{
				$scope.timeSE=$scope.timeEE;
			}
		else if($scope.timeSE==$scope.timeEE-1 && ($scope.minSE==45 || $scope.minSE==30 || $scope.minSE==15)){
			$scope.timeSE=$scope.timeEE;
			$scope.minSE=$scope.minEE;
		}
		else
			$scope.timeSE=$scope.timeSE+1;
			
			$scope.editEnd = $scope.timeSE+":"+$scope.minSE;

		
	};

	$scope.timeDecSE=function(){
		
		if($scope.timeSE > $scope.startValueHourE)
			{
					$scope.timeSE=$scope.timeSE-1;
			}
		if($scope.timeSE == $scope.startValueHourE && $scope.minSE < $scope.startValueMinE)
				{
						$scope.minSE=$scope.startValueMinE;
				}
		
		$scope.editEnd = $scope.timeSE+":"+$scope.minSE;
	 
	};
	
	$scope.minIncSE=function(){
		if($scope.minSE==45)
			{
				if($scope.timeSE==$scope.timeEE && $scope.minSE==$scope.minEE)	
					$scope.minSE=$scope.minEE;	
				else
					$scope.minSE=00;
				
				if($scope.timeSE<$scope.endValueHourE)
				{
					$scope.timeSE=$scope.timeSE+1;
					$scope.minSE=00;
				}
			}
		else if($scope.timeSE==$scope.timeEE  && $scope.minSE==$scope.minEE)
		{
			$scope.timeSE=$scope.timeEE;
			$scope.minSE=$scope.minEE;
		}
		else
			$scope.minSE=$scope.minSE+15;
		
		$scope.editEnd = $scope.timeSE+":"+$scope.minSE;	

	};
	
	$scope.minDecSE=function(){
		if($scope.minSE==0 && $scope.timeSE>$scope.startValueHourE)
			{
				$scope.minSE=45;
				$scope.timeSE=$scope.timeSE-1;
			}
		
		else if($scope.timeSE==$scope.startValueHourE )
			{
				if($scope.minSE <= $scope.startValueMinE){
					//$scope.timeS=$scope.startValueHour;
					$scope.minSE=$scope.startValueMinE;
				}
				else
				{
					//$scope.minS=$scope.startValueMin;
					$scope.minSE=$scope.minSE-15;
				}
			}
		else
			$scope.minSE=$scope.minSE-15;
		
		$scope.editEnd = $scope.timeSE+":"+$scope.minSE;	
	};

	//Get Status Function

	$scope.getRoomStatus = function(){
		//console.log("getRoomStatus : " + emailId);
	
		var status = $http({
				method: "post",
				url: "getStatusDetails.php",
				headers: { 'Content-Type': 'application/json' }
			});
			
		status.success(function(data,status,headers,config){
			$scope.statusDetails = data;
			$rootScope.bookingDetails = $scope.statusDetails;
		});
		status.error(function(data,status,headers,config){
			alert("AJAX Error");		
		});	
	};
	
	$scope.changeImageSrc = function(id){
		var n = document.getElementById(id).src;
		if(n.search('details_open')>0)
			document.getElementById(id).src = "images/details_close.png";
		else if(n.search('details_close')>0)
			document.getElementById(id).src = "images/details_open.png";
			
	};	

	$scope.cancelRequest = function(id){
		//console.log("Print id : "+id);
		var statusCancel = $http({
				method: "post",
				url: "requestCancelDAO.php",
				data:{
					reqId : id
				}
				,headers: { 'Content-Type': 'application/json' }
			});
			
		statusCancel.success(function(data,status,headers,config){
			//console.log("Delete after : "+data);
			if(data=="success"){
				document.getElementById("row"+id).remove();
				document.getElementById("inrow"+id).remove();
				for(var i in $rootScope.bookingDetails){
					if($rootScope.bookingDetails[i].requestId == id){
						$rootScope.bookingDetails.splice(i,1);
					}
				}
			}
			else{
				alert("delete failure ");
			}
		});
		statusCancel.error(function(data,status,headers,config){
			alert("AJAX Error");		
		});	
	};
	
	$scope.setRequestId=function(id){
		console.log("In cancel"+id);
		$rootScope.id=id;
	};

	$scope.itemsPerPage = 5;
	$scope.currentPage = 0;

  $scope.range = function() {
	var rangeSize;
	if($rootScope.bookingDetails!=null)
		rangeSize = Math.ceil($rootScope.bookingDetails.length/$scope.itemsPerPage);
    var ret = [];
    var start;
    start = $scope.currentPage;
    if ( start > $scope.pageCount()-rangeSize ) {
      start = $scope.pageCount()-rangeSize+1;
    }

    for (var i=start; i<start+rangeSize; i++) {
      ret.push(i);
    }
    return ret;
  };

  $scope.prevPage = function() {
    if ($scope.currentPage > 0) {
      $scope.currentPage--;
    }
  };

  $scope.prevPageDisabled = function() {
    return $scope.currentPage === 0 ? "disabled" : "";
  };

  $scope.pageCount = function() {
  
  if($rootScope.bookingDetails!=null)
    return Math.ceil($rootScope.bookingDetails.length/$scope.itemsPerPage)-1;
  };

  $scope.nextPage = function() {
    if ($scope.currentPage < $scope.pageCount()) {
      $scope.currentPage++;
    }
  };

  $scope.nextPageDisabled = function() {
    return $scope.currentPage === $scope.pageCount() ? "disabled" : "";
  };

  $scope.setPage = function(n) {
    $scope.currentPage = n;
  };
	
	$scope.clickSort1=function(){
		$scope.sortOrder2='';
		$scope.sortOrder3='';
		$scope.sortOrder4='';
		$scope.sortOrder5='';
		$scope.sortOrder6='';
		if($scope.sortOrder1 == 'caret'){
			$scope.sortOrder1 = 'caretReverse';
			$scope.orderByName = '-requestId';
		}
		else {
			$scope.sortOrder1 = 'caret';
			$scope.orderByName = 'requestId';
		}
	};
	$scope.clickSort2=function(){
		$scope.sortOrder1='';
		$scope.sortOrder3='';
		$scope.sortOrder4='';
		$scope.sortOrder5='';
		$scope.sortOrder6='';
		if($scope.sortOrder2 == 'caret'){
			$scope.sortOrder2 = 'caretReverse';
			$scope.orderByName = '-roomName';
		}
		else{ 
			$scope.sortOrder2 = 'caret';
			$scope.orderByName = 'roomName';
		}
	};
	$scope.clickSort3=function(){
		$scope.sortOrder2='';
		$scope.sortOrder1='';
		$scope.sortOrder4='';
		$scope.sortOrder5='';
		$scope.sortOrder6='';
		if($scope.sortOrder3 == 'caret'){
			$scope.sortOrder3 = 'caretReverse';
			$scope.orderByName = '-date';
		}
		else{ 
			$scope.sortOrder3 = 'caret';
			$scope.orderByName = 'date';
		}
	};
	$scope.clickSort4=function(){
		$scope.sortOrder2='';
		$scope.sortOrder3='';
		$scope.sortOrder1='';
		$scope.sortOrder5='';
		$scope.sortOrder6='';
		if($scope.sortOrder4 == 'caret'){
			$scope.sortOrder4 = 'caretReverse';
			$scope.orderByName = '-startTime';
		}
		else{ 
			$scope.sortOrder4 = 'caret';
			$scope.orderByName = 'startTime';
		}
	};
	$scope.clickSort5=function(){
		$scope.sortOrder2='';
		$scope.sortOrder3='';
		$scope.sortOrder4='';
		$scope.sortOrder1='';
		$scope.sortOrder6='';
		if($scope.sortOrder5 == 'caret'){
			$scope.sortOrder5 = 'caretReverse';
			$scope.orderByName = '-endTime';
		}
		else{ 
			$scope.sortOrder5 = 'caret';
			$scope.orderByName = 'endTime';
		}
	};
	$scope.clickSort6=function(){
		$scope.sortOrder2='';
		$scope.sortOrder3='';
		$scope.sortOrder4='';
		$scope.sortOrder5='';
		$scope.sortOrder1='';
		if($scope.sortOrder6 == 'caret'){
			$scope.sortOrder6 = 'caretReverse';
			$scope.orderByName = '-status';
		}
		else{ 
			$scope.sortOrder6 = 'caret';
			$scope.orderByName = 'status';
		}
	};
	
	
});

app.controller('ScrollCtrl', ['$anchorScroll', '$location', '$scope',
  function ($anchorScroll, $location, $scope) {
    $scope.gotoTop = function() {
      var newHash = 'pageheader';
      if ($location.hash() !== newHash) {
        $location.hash(newHash);
		//$anchorScroll();
      } else {
			$anchorScroll();
      }
    };
  }
]);

app.filter('offset', function() {
    return function(input, start) {
		//start = parseInt(start, 10);
        if (!input || !input.length) 
			return;
        start = +start; //parse to int
        return input.slice(start);
    }
});

