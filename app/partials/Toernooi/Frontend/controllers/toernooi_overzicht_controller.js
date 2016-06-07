define(['app'], function (app) {
  app.controller('ToernooiOverzichtController', [
    '$scope',
    '$http',
    '$filter',
    '$mdDialog',
    '$routeParams',
    '$location',
    'toernooiOverzichtService',
    'DatatableService',
  function ($scope, $http, $filter, $mdDialog,$routeParams, $location, toernooiOverzichtService, DatatableService) {

    $scope.show_toernooi_buttons = true;
    $scope.toernooi_form_style = "thumbnail form-style";
    // Form data
    $scope.formData = {};
    // Update (detail) pagina page
    $scope.formData.page = 1;


    $scope.main_page = 1;


    $scope.submit = function() {
      $aantal_poules = $scope.formData.aantal_poules;

      var data = {
        toernooi_id:	$routeParams.toernooiId,
        subtoernooi_id: $routeParams.subToernooiId,
        aantal_poules: $aantal_poules
      };
      toernooiOverzichtService
      .createPoules(data)
      .success(function(response) {
          if (!response.error)
            $location.path('/');
        });
    }

    $scope.relocate = function() {
        var path = '/wedstrijd/read/' + $routeParams.toernooiId + '/' + $routeParams.subToernooiId;
        $location.path(path);
    }


  }]);
});
