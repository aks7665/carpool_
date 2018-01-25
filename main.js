var carPool = angular.module('carPool',['ngRoute']);
carPool.config(function ($routeProvider) {
	$routeProvider
	.when('/login',{
		templateUrl: 'pages/login.html',
		controller: 'loginController'
	})
	.when('/findride',{
		templateUrl: 'pages/home.html',
		controller: 'mainController'
	})
  .when('/tripdetail',{
		templateUrl: 'pages/tripdetail.html',
		controller: 'tripdetailController'
	})
  .when('/',{
		templateUrl: 'pages/mainpage.html',
		controller: 'mainpageController'
	})
	.when('/signup',{
		templateUrl: 'pages/signup.html',
		controller: 'signupController'
	})
	.when('/offerride',{
		templateUrl: 'pages/offerride.html',
		controller: 'offerController'
	})
})
//
//
//
carPool.controller('loginController',function($scope,$location) {

	$scope.loginFunc = function() {
			// $location.url('')
			if ($scope.user.email!="" && $scope.user.password !="") {
				 $.ajax({
				 	'type': 'POST',
				 	'url': 'http://localhost/APi/index.php',
				 	'data':{ "lusername":$scope.user.email,"lpswd":$scope.user.password},
				 	success: function (response) {
						if(response==true)
				 		$location.url('')
				    },
				     error: function (xhr) {
				     	console.log(xhr);
				     }
				 })
			}
	}
})
//
carPool.controller('signupController',function($scope,$location,$http) {
	$scope.logId = function() {
		var jdob = document.getElementById("dob").value;
		if ($scope.username!="" && $scope.email!="" && $scope.phoneno!="" && $scope.pswd!="" && jdob!="") {
			$.ajax({
				'type': 'POST',
				'url': 'http://localhost/APi/index.php',
				'data':{ "username":$scope.username, "email":$scope.email,"phoneno":$scope.phoneno,"pswd":$scope.pswd,"dob":jdob },
				success: function (response) {
					console.log(response);
					$location.url('')
			    },
			    error: function (xhr) {
			    	console.log(xhr);
			    }
			})
		}

	}
})
//
carPool.controller('mainpageController',function($scope,$location) {
  $scope.goToHome = function() {
		console.log('Do Something')
		$location.url('home')
	}
})
//
//
carPool.controller('offerController',function($scope,$location) {
	$scope.offerRide = function() {
		var jdate = document.getElementById("rdate").value;
		var jtime = document.getElementById("rtime").value;
		$.ajax({
			'type': 'POST',
			'url': 'http://localhost/APi/index.php',
			'data':{ "userid":"1","car":$scope.rcar,"carno":$scope.rcarno,"depart":$scope.dpointc,"dropoff":$scope.dopointc,"price":$scope.rprice,"detailfrom":$scope.dpointd,"detailto":$scope.dopointd,"date":jdate,"time":jtime,"seats":$scope.rseats,"seats_a":$scope.rseats},
			success: function (response) {
				if (response.responseText=="registered succesfully") {
					console.log(response);
					$location.url('')
				}

		    },
		    error: function (xhr) {
		    	console.log(xhr);
		    }
		})

		console.log($scope.dpointc);
		console.log($scope.dpointd);
		console.log($scope.dopointc);
		console.log($scope.dopointd);
		console.log(jdate);
		console.log(jtime);
		console.log($scope.rprice);
		console.log($scope.rcar);
		console.log($scope.rcarno);
		console.log($scope.rseats);
	}
})
carPool.controller('tripdetailController',function($scope,$location) {
  // $scope.goToHome = function() {
	// 	console.log('Do Something')
	// 	$location.url('home')
	// }
})

carPool.controller('welController',function($scope,$location) {
  $scope.goTofindride = function() {
		console.log('Do Something')
		$location.url('findride')
	}
	$scope.goTobookride = function() {
		console.log('Do Something')
		$location.url('offerride')
	}
})

carPool.controller('mainController',function($scope,$location) {
	$scope.findRide = function() {
		var frdate = document.getElementById("frdate").value;
		$.ajax({
			'type': 'POST',
			'url': 'http://localhost/APi/index.php',
			'data':{ "from":$scope.fromloc,"to":$scope.toloc ,"date":frdate},
			success: function (response) {
				$scope.arr = [];
				console.log(response);
				for (var i in response) {
					$scope.arr.push(response[i]);
				}
				console.log("hey");
				console.log($scope.arr);
				},
				error: function (xhr) {
					console.log(xhr);
				}
		})
		console.log($scope.fromloc[0]);
		console.log($scope.toloc);
		console.log(frdate);
	}

})
