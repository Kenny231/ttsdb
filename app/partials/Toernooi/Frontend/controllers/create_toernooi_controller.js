define(['app'], function (app) {
  app.controller('CreateToernooiController', ['$scope', '$http', '$filter', '$location', 'toernooiService', function ($scope, $http, $filter, $location, toernooiService) {
    // Form data
    $scope.formData = {};
    // pagina
    $scope.formData.page = 1;
    /*
     * Methode die wordt aangeroepen als het formulier
     * gesubmit wordt.
     */
    $scope.submit = function() {
      var data = {
        naam: 				$scope.formData.toernooinaam,
        type: 				$scope.formData.toernooitype,
        postcode:     $scope.formData.postcode,
        plaatsnaam:   $scope.formData.plaatsnaam,
        straatnaam:   $scope.formData.straatnaam,
        huisnummer:   $scope.formData.huisnummer,
        start_datum: 	$filter('date')($scope.formData.start_datum, "yyyy-MM-dd"),
        eind_datum:   $filter('date')($scope.formData.eind_datum, "yyyy-MM-dd"),
        organisatie: 	$scope.formData.organisatie,
        tijd: 				$filter('date')($scope.formData.aanvangstijdstip, "HH:mm:ss")
      };
      toernooiService
      .create(data)
      .success(function(response) {
        if (!response.error)
          $location.path('/');
      });
    }
    /*
     *Select data
    */
    $scope.select_toernooi = [
      'Ladder',
      'Familie',
      'Prestatie'
    ];
    $scope.formData.toernooitype = $scope.select_toernooi[0];
  }]);
});
