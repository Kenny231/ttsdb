define(['app'], function (app) {
	'use strict';

	app.config(['$routeProvider', function ($routeProvider) {
		$routeProvider
			.when('/', {
				templateUrl: '/ttsdb/app/partials/home/frontend/views/home.html',
				controller: 'HomeController'
			});
	}]);
});
