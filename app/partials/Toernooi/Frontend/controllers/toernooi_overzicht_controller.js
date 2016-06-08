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

    function construct() {
        getList();
        $scope.show_toernooi_buttons = true;
        $scope.toernooi_form_style = "thumbnail form-style";
   }

    construct();
    // Form data
    $scope.formData = {};
    // Update (detail) pagina page
    $scope.formData.page = 1;


    function getList(){
      toernooiOverzichtService
      .getAllPoules($routeParams.toernooiId,$routeParams.subToernooiId)
      .success(function(response) {
        console.log(response);
          $scope.toernooipoules = response;
          if($scope.toernooipoules.length == 0){
            $scope.main_page = 2;
          }else{
            $scope.main_page = 1;
          }
        });
    }


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
            $scope.main_page = 1;
        });
    }

    $scope.relocate = function() {
        var path = '/wedstrijd/read/' + $routeParams.toernooiId + '/' + $routeParams.subToernooiId;
        $location.path(path);
    }

  }]);
});
