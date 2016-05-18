define(['app'], function (app) {
	app.controller('LoginController', ['$scope', 'loginService', function ($scope, loginService) {
		$scope.login = function () {
			loginService
			.login($scope.username, $scope.password)
			.success(function(response) {
				if (response.error)
					$scope.login_error = response.error;
			});
		}
	}]);
});
