define(['app'], function (app) {
	app.controller('LoginController', ['$scope', '$location', 'loginService', 'LoginSession', function ($scope, $location, loginService, LoginSession) {
		$scope.login = function () {
			loginService
			.login($scope.username, $scope.password)
			.success(function(response) {
				if (response.error)
					$scope.login_error = response.error;
			  else{
				  LoginSession.login();
					$location.path('/');
				}
			});
		}
	}]);
});
