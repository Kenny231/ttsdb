define([
  'require',
    'angular',
    'app'
], function (require, angular, app) {
  'use strict';

  require(['dom-ready!'], function (document) {
    angular.bootstrap(document, ['app']);
  });
});
