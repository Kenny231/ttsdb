define(['app'], function (app) {
  app.controller('ReadToernooiController', ['$scope', '$http', '$filter', '$mdDialog', 'toernooiService', 'DatatableService', function ($scope, $http, $filter, $mdDialog, toernooiService, DatatableService) {
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
    $scope.order = 'toernooi_naam';
    /*
     * Methode om alle toernooien op te halen.
     * Deze worden vervolgens ingeladen in de datatable.
     */
    function list() {
      toernooiService
      .list()
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
        var item = DatatableService.getSelection().toernooi_id;
        toernooiService
        .delete(item)
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
        if (DatatableService.data[i].toernooi_id == id)
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
    // Update (detail) pagina page
    $scope.formData.page = 1;
    /*
     *Select data
    */
    $scope.select_toernooi = [
      'Ladder',
      'Familie',
      'Prestatie'
    ];
    $scope.formData.toernooitype = $scope.select_toernooi[0];
    /*
     * Update pagina
     */
    $scope.togglePage = function() {
      $scope.formData.page = 1;
    }

    $scope.main_page = 1;
    /*
     * Methode om het update formulier met de juiste
     * waardes te vullen.
     */
    $scope.populateFields = function() {
      var item = DatatableService.getSelection();
      // Select id's
      var toernooitype_id = item.toernooitype == 'Ladder' ? 0 : item.toernooitype == 'Familie' ? 1 : 2;
      // Waardes invullen
      $scope.formData.toernooinaam = item.toernooi_naam;
      $scope.formData.toernooitype = $scope.select_toernooi[toernooitype_id];
      $scope.formData.postcode = item.postcode;
      $scope.formData.plaatsnaam = item.plaatsnaam;
      $scope.formData.straatnaam = item.straatnaam;
      $scope.formData.huisnummer = item.huisnummer;
      $scope.formData.start_datum = $scope.convertDate(item.start_datum.date);
      $scope.formData.eind_datum = $scope.convertDate(item.eind_datum.date);
      $scope.formData.aanvangstijdstip = $scope.convertDate(item.start_datum.date);
      $scope.formData.organisatie = item.organisatie;
    }
    /*
     * Wordt aangeroepen, als er op de edit knop gedrukt wordt.
     */
    $scope.onEdit = function() {
      if (DatatableService.hasSelection()) {
        $scope.page = 1;
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
        id:						DatatableService.getSelection().toernooi_id,
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
      .update(data)
      .success(function(response) {
        var id = DatatableService.getSelection().toernooi_id;
        var index = $scope.getIndexById(id);
        // Reload row.
        toernooiService
        .find(id)
        .success(function(resp) {
          DatatableService.data[index] = resp;
          DatatableService.eraseSelection();
        });
      });
     }
  }]);
});
