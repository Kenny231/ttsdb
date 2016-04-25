define(['app'], function(app) {
	app.service('accountService', ['$http', function ($http) {
		return {
			login: function(_username, _password) {
				var url = "app/api/login";
				//var url = "http://localhost/app/partials/login/login_handler.php";
				var data = {
					username: _username,
					password: _password
				};
				return $http({
					method: 'POST',
					url: url,
					data: data
				});
			}
		};
	}]);
});
