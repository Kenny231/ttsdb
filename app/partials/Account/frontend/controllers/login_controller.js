define(['app'], function (app) {
	app.controller('LoginController', ['$scope', '$http', '$localStorage', 'accountService', function ($scope, $http, $localStorage, accountService) {
		$scope.loggedIn = false; 
		if ($localStorage.loggedIn != 'undefined')
			$scope.loggedIn = $localStorage.loggedIn;
		
		$scope.login = function () {			
			accountService
			.login($scope.username, $scope.password)
			.success(function(response) {
				if (response.error)
					$scope.login_error = response.error;
				else {
					$localStorage.loggedIn = true;
					$scope.loggedIn = true;
				}
			});
		}	
	}]);
});	