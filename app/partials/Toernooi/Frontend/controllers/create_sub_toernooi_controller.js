define(['app'], function (app) {
  app.controller('CreateSubToernooiController', [
    '$scope',
    '$http',
    '$filter',
    '$location',
    '$routeParams',
    'toernooiService',
    'subToernooiService',
  function ($scope, $http, $filter, $location, $routeParams, toernooiService, subToernooiService) {
    // Form data
    $scope.formData = {};
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

    $scope.select_data = [
    {
      "type" : "Ladder",
      "geslacht" : [
        {"name" : "Gemengd", "value" : ""}
      ],
      "enkel" : [
        {"name" : "Ja", "value" : "1"}
      ]
    }, {
      "type" : "Familie",
      "geslacht" : [
        {"name" : "Gemengd", "value" : ""}
      ],
      "enkel" : [
        {"name" : "Nee", "value" : "0"},
        {"name" : "Ja", "value" : "1"}
      ]
    }, {
      "type" : "Prestatie",
      "geslacht" : [
        {"name" : "Man", "value" : "m"},
        {"name" : "Vrouw", "value" : "v"},
        {"name" : "Gemengd", "value" : ""}
      ],
      "enkel" : [
        {"name" : "Nee", "value" : "0"},
        {"name" : "Ja", "value" : "1"}
      ]
    }];
    $scope.toernooitype;
    $scope.current_selection;

    $scope.categorie = [];
    /*
     * Methode die de index van de select data teruggeeft,
     * op basis van het toernooi type.
     */
    function getIndexByType(type) {
      for (var i=0; i<$scope.select_data.length; i++) {
        if ($scope.select_data[i].type == type)
          return i;
      }
      return 0;
    }

    toernooiService
    .find($routeParams.toernooiId)
    .success(function(response) {
      $scope.toernooitype = response.toernooitype;
      var index = getIndexByType(response.toernooitype);
      $scope.current_selection = $scope.select_data[index];
      $scope.formData.geslacht = $scope.current_selection.geslacht[0];
      $scope.formData.enkel = $scope.current_selection.enkel[0];
    });

    subToernooiService
    .categorieList()
    .success(function(response){
      $scope.categorie = response;
      $scope.formData.categorie_naam = $scope.categorie[0];
    });
    /*
     * Methode die wordt aangeroepen als het formulier
     * gesubmit wordt.
     */
    $scope.submit = function() {
      var data = {
        toernooi_id: 				$routeParams.toernooiId,
        categorie_naam:     $scope.formData.categorie_naam,
        geslacht:           $scope.formData.geslacht.value,
        enkel:              $scope.formData.enkel.value,
        licenties:          $scope.formData.licenties
      };
      subToernooiService
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
