define(['app'], function (app) {
	app.controller('ReadInschrijfadresController', ['$scope', '$http', '$filter', '$mdDialog', 'InschrijfadresService','DatatableService', function ($scope, $http, $filter, $mdDialog, inschrijfadresService, DatatableService) {

  $scope.DatatableService = DatatableService;

	  /* SETUP */
		function construct() {
			// Zitten we op een subform?
			if ($scope.subFormData == null) {
				list(); // Set datatable data.
				$scope.show_toernooi_buttons = true;
				$scope.toernooi_form_style = "thumbnail form-style";
			}
		}

		// roep de constructor aan.
		construct();

		// Form data
		$scope.formData = {};
		// pagina
		$scope.formData.page = 1;

		// Sorteer volgorde
		$scope.order = 'postcode';
		/*
     * Update pagina
     */
    $scope.togglePage = function() {
      $scope.formData.page = 1;
    }

    $scope.main_page = 1;


		/* READ */
		/*
     * Methode om alle toernooien op te halen.
     * Deze worden vervolgens ingeladen in de datatable.
     */
    function list() {
      inschrijfadresService
      .list()
      .success(function(response) {
				console.log(response);
        DatatableService.data = response;
      });
    }



		/* DELETE */
		/*
		 * Delete callback, deze methode wordt aangeroepen
		 * zodra er op de verwijder knop gedrukt wordt.
		 * Deze methode zal een record zowel uit de database
		 * als de datatable verwijderen.
		 */
		$scope.onDelete = function() {
			if (DatatableService.hasSelection()) {
				var item = DatatableService.getSelection().inschrijfadres_id;
				inschrijfadresService
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
     * Methode die een dialog scherm weergeeft, zodra iemand
     * een record probeerd te verwijderen.
     */
    $scope.showConfirm = function() {
      if (DatatableService.hasSelection()) {
        var confirm = $mdDialog.confirm()
          .title('Warning')
          .textContent('Weet u zeker dat u dit inschrijfadres wilt verwijderen?')
          .ariaLabel('Verwijder inschrijfadres')
          .ok('Ja')
          .cancel('Nee');

        $mdDialog.show(confirm).then(function() {
          $scope.onDelete();
        });
      }
    };

		/* UPDATE */
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
		 * Methode om het update formulier met de juiste
		 * waardes te vullen.
		 */
		$scope.populateFields = function() {
			var item = DatatableService.getSelection();

			// Waardes invullen
			$scope.formData.toernooi_id = item.toernooi_id;
			$scope.formData.subtoernooi_id = item.subtoernooi_id;
			$scope.formData.postcode = item.postcode;
			$scope.formData.huisnummer = item.huisnummer;
			$scope.formData.plaatsnaam = item.plaatsnaam;
			$scope.formData.straatnaam = item.straatnaam;
			$scope.formData.categorie_naam = item.categorie_naam;
			$scope.formData.persoon_id = item.persoon_id;
			$scope.formData.telefoonnummer = item.telefoonnummer;
			$scope.formData.email = item.email;
		}


		/*
		 * Methode die wordt aangeroepen als het formulier
		 * gesubmit wordt.
		 */
		$scope.submit = function() {
			$scope.main_page = 1;
			var data = {
				toernooi_id:    $scope.formData.toernooi_id,
				subtoernooi_id: $scope.formData.subtoernooi_id,
				postcode: 	   	$scope.formData.postcode,
				huisnummer: 	  $scope.formData.huisnummer,
				plaatsnaam:			$scope.formData.plaatsnaam,
				straatnaam:			$scope.formData.straatnaam,
				categorie_naam: $scope.formData.categorie_naam,
				persoon_id: 		$scope.formData.persoon_id,
				telefoonnummer: $scope.formData.telefoonnummer,
				email:          $scope.formData.email
			};
			inschrijfadresService
			.update(data)
			.success(function(response) {
				var index = $scope.getIndexById($scope.formData.toernooi_id, $scope.formData.subtoernooi_id);

				inschrijfadresService
				.find($scope.formData.toernooi_id, $scope.formData.subtoernooi_id)
				.success(function(response) {
					DatatableService.data[index] = response;
					DatatableService.eraseSelection();
				});
			});
		}

		/* OVERIGE*/

		/*
		 * Methode om de index van een inschrijfasdres op te halen.
		 * inschrijfasdres id en de index zijn niet gelijk aan elkaar.
		 *
		 * @param id Het inschrijfasdres id.
		 *
		 * @return De bijbehornde index in de datatable.
		 */
		$scope.getIndexById = function(toernooi_id, subtoernooi_id) {
			for(var i = 0; i < DatatableService.data.length; i++) {
				if (DatatableService.data[i].toernooi_id == toernooi_id
					&& DatatableService.data[i].subtoernooi_id == subtoernooi_id)
					return i;
			}
		}
	}]);
});
