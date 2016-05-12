define(['app'], function (app) {
	'use strict';

	app.config(['$routeProvider', function ($routeProvider) {
		$routeProvider
			.when('/toernooi', {
				templateUrl: '/ttsdb/app/partials/toernooi/frontend/views/toernooiaanmaken.html',
				controller: 'ToernooiController'
			})
			.when('/toernooi/read', {
				templateUrl: '/ttsdb/app/partials/toernooi/frontend/views/read_toernooi.html',
				controller: 'ReadToernooiController'
			});
	}]);
});
