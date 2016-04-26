define(['app'], function (app) {
	'use strict';

	app.config(['$routeProvider', function ($routeProvider) {
		$routeProvider
			.when('/login', {
				templateUrl: '/ttsdb/app/partials/account/frontend/views/login.php',
				controller: 'AccountController'
			});
	}]);
});
