require.config({
	paths: {
		'jquery': 'libs/jquery/jquery.min',
		'jquery.datatables': 'libs/jquery/jquery-datatables.min',
		'angular': 'libs/angular/angular.min',
		'angular.route': 'libs/angular/angular-route.min',
		'angular.storage': 'libs/angular/angular-storage.min',
		'angular.animate': 'libs/angular/angular-animate.min',
		'angular.bootstrap': 'libs/bootstrap/js/ui-bootstrap-tpls.min',
		'dom-ready': 'libs/dom-ready/dom-ready'
	},
	shim: {
		'angular.route': ['angular'],
		'angular.storage': ['angular'],
		'angular.animate': ['angular'],
		'angular': {
			'exports': 'angular',
			deps: [
				'jquery'
			]
		},
		'jquery': {
			'exports': 'jquery'
		},
		'jquery.datatables': ['jquery'],
		'angular.bootstrap': ['angular'],
		'dom-ready': ['angular']
	},
	deps: [
		'./partials/home/frontend/home_module',
		'./partials/toernooi/frontend/toernooi_module',
		'./partials/resources/frontend/resources_module',
		'bootstrap'
	],
	priority: [
		"angular"
	],
	urlArgs: "bust=" + (new Date()).getTime()
});
