define(['app'], function (app) {
  'use strict';

  app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
    .when('/wedstrijd/create/:toernooiId/:subToernooiId', {
      templateUrl: '/ttsdb/app/partials/wedstrijd/frontend/views/create_wedstrijd.html',
      controller: 'CreateWedstrijdController'
    })
    .when('/wedstrijd/read/:toernooiId/:subToernooiId', {
      templateUrl: '/ttsdb/app/partials/wedstrijd/frontend/views/read_wedstrijd.html',
    });
  }]);
});
