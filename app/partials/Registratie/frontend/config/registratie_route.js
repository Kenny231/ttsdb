define(['app'], function (app) {
	'use strict';

	app.config(['$routeProvider', function ($routeProvider) {
		$routeProvider
			.when('/aanmelden/:toernooiId', {
				templateUrl: '/ttsdb/app/partials/registratie/frontend/views/aanmelden_speler.html',
				controller: 'AanmeldenController'
			})
			.when('/tselectie', {
				templateUrl: '/ttsdb/app/partials/registratie/frontend/views/toernooi_selectie.html',
				controller: 'ToernooiSelectieController'
			});
	}]);
});
