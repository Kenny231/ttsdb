define(['app'], function (app) {
	'use strict';

	app.config(['$routeProvider', function ($routeProvider) {
		$routeProvider
			.when('/toernooi', {
				templateUrl: '/ttsdb/app/partials/toernooi/frontend/views/toernooiaanmaken.html'
			});
	}]);
});
