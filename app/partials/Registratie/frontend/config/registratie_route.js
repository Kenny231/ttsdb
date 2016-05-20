define(['app'], function (app) {
	'use strict';

	app.config(['$routeProvider', function ($routeProvider) {
		$routeProvider
			.when('/aanmelden', {
				templateUrl: '/ttsdb/app/partials/registratie/frontend/views/aanmelden_speler.html',
				controller: 'AanmeldenController'
			});
	}]);
});
