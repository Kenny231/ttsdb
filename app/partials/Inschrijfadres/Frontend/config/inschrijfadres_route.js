 define(['app'], function (app) {
	'use strict';

	app.config(['$routeProvider', function ($routeProvider) {
		$routeProvider
			.when('/inschrijfadres/create', {
				templateUrl: '/ttsdb/app/partials/inschrijfadres/frontend/views/create_inschrijfadres.html',
				controller: 'CreateInschrijfadresController'
			});
	}]);
});
