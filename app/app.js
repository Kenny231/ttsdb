define([
	'angular',
	'angular.aria',
	'angular.route',
	'angular.storage',
	'angular.animate',
	'angular.material',
	'angular.bootstrap',
	'md.datatable',
], function (angular) {
	'use strict';
	var app = angular.module('app', [
		'ngAria',
		'ngRoute',
		'ngStorage',
		'ngAnimate',
		'ngMaterial',
		'ui.bootstrap',
		'md.data.table'
	]);
	app.run(function($rootScope, $location, $localStorage) {
    $rootScope.$on("$locationChangeStart", function(event, next, current) {
			if ($localStorage.loggedIn == 'undefined' || !$localStorage.loggedIn)
    		$location.path('/login');
    });
	});
	return app;
});
