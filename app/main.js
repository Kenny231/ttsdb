require.config({
	paths: {
		'jquery': 'libs/jquery/jquery.min',
		'angular': 'libs/angular/angular.min',
		'angular.aria': 'libs/angular/angular-aria.min',
		'angular.route': 'libs/angular/angular-route.min',
		'angular.storage': 'libs/angular/angular-storage.min',
		'angular.animate': 'libs/angular/angular-animate.min',
		'angular.material': 'libs/angular/angular-material.min',
		'angular.bootstrap': 'libs/bootstrap/js/ui-bootstrap-tpls.min',
		'md.datatable': 'libs/md-datatable/md-data-table.min',
		'dom-ready': 'libs/dom-ready/dom-ready'
	},
	shim: {
		'angular.aria': ['angular'],
		'angular.route': ['angular'],
		'angular.storage': ['angular'],
		'angular.animate': ['angular'],
		'angular.material': ['angular', 'angular.aria', 'angular.animate'],
		'angular': {
			'exports': 'angular',
			deps: [
				'jquery'
			]
		},
		'jquery': {
			'exports': 'jquery'
		},
		'angular.bootstrap': ['angular'],
		'md.datatable': ['angular.material'],
		'dom-ready': ['angular']
	},
	deps: [
		'./partials/home/frontend/home_module',
		'./partials/toernooi/frontend/toernooi_module',
		'./partials/resources/frontend/resources_module',
		'./partials/login/frontend/login_module',
		'./partials/registratie/frontend/registratie_module',
		'bootstrap'
	],
	priority: [
		"angular"
	],
	urlArgs: "bust=" + (new Date()).getTime()
});
