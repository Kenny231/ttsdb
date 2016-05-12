define([
	'angular',
	'angular.aria',
	'angular.route',
	'angular.storage',
	'angular.animate',
	'angular.material',
	'angular.bootstrap',
	'md.datatable'
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
	return app;
});
