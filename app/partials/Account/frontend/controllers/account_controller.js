define(['app'], function (app) {
	app.controller('AccountController', ['$scope', '$http', '$localStorage', 'accountService', function ($scope, $http, $localStorage, accountService) {
		$scope.login = function () {
			accountService
			.login($scope.username, $scope.password)
			.success(function(response) {
				if (response.error)
					$scope.login_error = response.error;
				else
					$localStorage.loggedIn = true;
			});
		}
	}]);
});
