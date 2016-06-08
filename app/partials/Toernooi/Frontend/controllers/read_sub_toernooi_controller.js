define(['app'], function (app) {
  app.controller('ReadSubToernooiController', [
    '$scope',
    '$http',
    '$filter',
    '$mdDialog',
    '$routeParams',
    '$location',
    'subToernooiService',
    'DatatableService',
  function ($scope, $http, $filter, $mdDialog, $routeParams, $location, toernooiService, DatatableService) {
    $scope.DatatableService = DatatableService;
    function construct() {
      // Zitten we op een subform?
      if ($scope.subFormData == null) {
        list(); // Set datatable data.
        $scope.show_toernooi_buttons = true;
        $scope.toernooi_form_style = "thumbnail form-style";
      }
    }
    construct();
    /*
     * Datatable
     */
    // Sorteer volgorde
    $scope.order = 'categorie_naam';
    /*
     * Methode om alle toernooien op te halen.
     * Deze worden vervolgens ingeladen in de datatable.
     */
    function list() {
      toernooiService
      .list($routeParams.toernooiId)
      .success(function(response) {
        DatatableService.data = response;
      });
    }
    /*
     * Delete callback, deze methode wordt aangeroepen
     * zodra er op de verwijder knop gedrukt wordt.
     * Deze methode zal een record zowel uit de database
     * als de datatable verwijderen.
     */
    $scope.onDelete = function() {
      if (DatatableService.hasSelection()) {
        var item = DatatableService.getSelection();
        toernooiService
        .delete(item.toernooi_id, item.subtoernooi_id)
        .success(function(response) {
          if (!response.error) {
            DatatableService.data.splice($scope.getIndexById(item), 1);
            $scope.row_count = $scope.row_count - 1;
            DatatableService.eraseSelection();
          }
        });
      }
    }
    /*
     * Methode om de index van een toernooi op te halen.
     * Toernooi id en de index zijn niet gelijk aan elkaar.
     *
     * @param id Het toernooi id.
     *
     * @return De bijbehornde index in de datatable.
     */
    $scope.getIndexById = function(id) {
      for(var i = 0; i < DatatableService.data.length; i++) {
        if (DatatableService.data[i].subtoernooi_id == id)
          return i;
      }
    }
    /*
     * Methode om een date string om te zetten
     * naar een date object.
     *
     * @param date String van datum.
     *
     * @return Date object.
     */
    $scope.convertDate = function(date) {
      return new Date(date);
    }
    /*
     * Methode die een dialog scherm weergeeft, zodra iemand
     * een record probeerd te verwijderen.
     */
    $scope.showConfirm = function() {
      if (DatatableService.hasSelection()) {
        var confirm = $mdDialog.confirm()
          .title('Warning')
          .textContent('Weet u zeker dat u dit toernooi wilt verwijderen?')
          .ariaLabel('Verwijder Toernooi')
          .ok('Ja')
          .cancel('Nee');

        $mdDialog.show(confirm).then(function() {
          $scope.onDelete();
        });
      }
    };
    // Form data
    $scope.formData = {};
    /*
     * Update pagina
     */
    // Licenties
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

    toernooiService
    .categorieList()
    .success(function(response) {
      $scope.categorie = response;
    });
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

    $scope.main_page = 1;
    /*
     * Methode om het update formulier met de juiste
     * waardes te vullen.
     */
    $scope.populateFields = function() {
      var item = DatatableService.getSelection();
      $scope.toernooitype = item.type;
      // Waardes invullen
      for (var i=0; i<$scope.categorie.length; i++) {
        if ($scope.categorie[i].toLowerCase() == item.categorie_naam.toLowerCase())
          $scope.formData.categorie_naam = $scope.categorie[i];
      }

      var index = getIndexByType(item.type);
      $scope.current_selection = $scope.select_data[index];

      for (var i=0; i<$scope.current_selection.geslacht.length; i++) {
        var geslacht = $scope.current_selection.geslacht[i];
        if (geslacht.value == item.geslacht)
          $scope.formData.geslacht = geslacht;
        if (geslacht.value == '' && item.geslacht == null)
          $scope.formData.geslacht = geslacht;
      }

      for (var i=0; i<$scope.current_selection.enkel.length; i++) {
        var enkel = $scope.current_selection.enkel[i];
        if (enkel.value == item.enkel)
          $scope.formData.enkel = enkel;
      }

      for (var i=0; i<item.licenties.length; i++)
        $scope.formData.licenties[i] = item.licenties[i];
    }
    /*
     * Wordt aangeroepen, als er op de edit knop gedrukt wordt.
     */
    $scope.onEdit = function() {
      if (DatatableService.hasSelection()) {
        $scope.main_page = 2;
        $scope.populateFields();
      }
    }
    /*
     * Wordt aangeroepen als het edit form gesubmit wordt.
     */
    $scope.submit = function() {
      $scope.main_page = 1;
      var data = {
        toernooi_id:		  $routeParams.toernooiId,
        subtoernooi_id:   DatatableService.getSelection().subtoernooi_id,
        categorie_naam:   $scope.formData.categorie_naam,
        geslacht:         $scope.formData.geslacht.value,
        enkel:            $scope.formData.enkel.value,
        licenties:        $scope.formData.licenties
      };
      toernooiService
      .update(data)
      .success(function(response) {
        var item = DatatableService.getSelection();
        var index = $scope.getIndexById(item.subtoernooi_id);
        // Reload row.
        toernooiService
        .find(item.toernooi_id, item.subtoernooi_id)
        .success(function(resp) {
          DatatableService.data[index] = resp;
          DatatableService.eraseSelection();
        });
      });
     }

     $scope.createForm = function() {
       var path = '/subtoernooi/create/';
       $location.path(path.concat($routeParams.toernooiId));
     }

     $scope.relocate = function() {
       if (DatatableService.hasSelection()) {
         var selection = DatatableService.getSelection();
         var path = '/wedstrijd/read/' + selection.toernooi_id + '/' + selection.subtoernooi_id;
         $location.path(path);
       }
     }
      $scope.toernooiIndelen = function() {
        if (DatatableService.hasSelection()) {
          var selection = DatatableService.getSelection();
          var path = '/toernooi/overzicht/' + selection.toernooi_id + '/' + selection.subtoernooi_id;
          $location.path(path);
        }
      }
  }]);
});
