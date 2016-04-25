define(['app'], function (app) {
	'use strict';

	app.config(['$routeProvider', function ($routeProvider) {
		$routeProvider
			.when('/', {
				templateUrl: '/app/partials/home/frontend/views/home.html',
				controller: 'HomeController'
			});
	}]);
});
