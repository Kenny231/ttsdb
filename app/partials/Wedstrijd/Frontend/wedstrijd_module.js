define([
	'app',
  './config/wedstrijd_route',
	'./services/wedstrijd_service',
	'./services/score_service',
	'./controllers/create_wedstrijd_controller',
	'./controllers/read_wedstrijd_controller'
], function (app) {
    console.log('Wedstrijd module loaded.');
});
