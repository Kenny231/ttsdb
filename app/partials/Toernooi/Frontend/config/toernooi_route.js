define(['app'], function (app) {
	'use strict';

	app.config(['$routeProvider', function ($routeProvider) {
		$routeProvider
			.when('/toernooi/create', {
				templateUrl: '/ttsdb/app/partials/toernooi/frontend/views/create_toernooi.html',
				controller: 'CreateToernooiController'
			})
			.when('/toernooi/read', {
				templateUrl: '/ttsdb/app/partials/toernooi/frontend/views/read_toernooi.html',
				//controller: 'ReadToernooiController' -- Gedefinieerd in view.
			});
	}]);
});
