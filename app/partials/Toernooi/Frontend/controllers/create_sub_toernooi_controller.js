define(['app'], function (app) {
  app.controller('CreateSubToernooiController', [
    '$scope',
    '$http',
    '$filter',
    '$location',
    '$routeParams',
    'subToernooiService',
  function ($scope, $http, $filter, $location, $routeParams, toernooiService) {
    // Form data
    $scope.formData = {};
    // pagina
    $scope.formData.page = 1;
    /*
     * LICENTIES
     */
    $scope.formData.licenties = [];
    $scope.select_licenties = [
      'A',
      'B',
      'C',
      'D',
      'E'
    ];
    /*
     * Methode die wordt aangeroepen als het formulier
     * gesubmit wordt.
     */
    $scope.submit = function() {
      var data = {
        toernooi_id: 				$routeParams.toernooiId,
        categorie_naam:     $scope.formData.categorie_naam,
        geslacht:           $scope.formData.geslacht,
        enkel:              $scope.formData.enkel,
        licenties:          $scope.formData.licenties
      };
      toernooiService
      .create(data)
      .success(function(response) {
        if (!response.error) {
          var path = '/subtoernooi/read/';
          $location.path(path.concat($routeParams.toernooiId));
        }
      });
    }
  }]);
});
