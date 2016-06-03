define([
  'angular',
  'angular.aria',
  'angular.route',
  'angular.select',
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
    'ui.select',
    'ui.bootstrap',
    'md.data.table'
  ]);
  app.run(function($rootScope, $location, $localStorage) {
    $rootScope.$on("$locationChangeStart", function(event, next, current) {
      var segment = next.substring(next.indexOf('#')+1, next.length);
      if (segment == '/logout')
        $localStorage.loggedIn = false;
      if ($localStorage.loggedIn == 'undefined' || !$localStorage.loggedIn)
        $location.path('/login');
    });
  });
  return app;
});
