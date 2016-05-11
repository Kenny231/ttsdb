define([
	'angular',
	'angular.route',
	'angular.storage',
	'angular.animate',
	'angular.bootstrap',
	'jquery.datatables',
], function (angular) {
	'use strict';
	var app = angular.module('app', [
		'ngRoute',
		'ngStorage',
		'ngAnimate',
		'ui.bootstrap',
	]);
	return app;
});
