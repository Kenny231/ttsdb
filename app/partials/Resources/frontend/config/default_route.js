define(['app'], function (app) {
  'use strict';

  app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
      .otherwise({ redirectTo: '/' });
  }]);
});
