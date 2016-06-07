define(['app'], function (app) {
  'use strict';

  app.config(['$routeProvider', function ($routeProvider) {
    $routeProvider
      .when('/toernooi/create', {
        templateUrl: '/ttsdb/app/partials/toernooi/frontend/views/create_toernooi.html',
        controller: 'CreateToernooiController'
      })
      .when('/toernooi/read', {
        templateUrl: '/ttsdb/app/partials/toernooi/frontend/views/read_toernooi.html',
        //controller: 'ReadToernooiController' -- Gedefinieerd in view.
      })
      .when('/toernooi/overzicht/:toernooiId/:subToernooiId', {
        templateUrl: '/ttsdb/app/partials/toernooi/frontend/views/toernooi_overzicht.html',
        //controller: 'ReadToernooiController' -- Gedefinieerd in view.
      })
      .when('/subtoernooi/create/:toernooiId', {
        templateUrl: '/ttsdb/app/partials/toernooi/frontend/views/create_sub_toernooi.html',
        controller: 'CreateSubToernooiController'
      })
      .when('/subtoernooi/read/:toernooiId', {
        templateUrl: '/ttsdb/app/partials/toernooi/frontend/views/read_sub_toernooi.html',
        //controller: 'ReadSubToernooiController' -- Gedefinieerd in view.
      });
  }]);
});
