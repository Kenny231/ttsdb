define(['app'], function (app) {
	app.controller('ReadWedstrijdController', [
		'$scope',
		'$http',
		'$filter',
		'$mdDialog',
		'$routeParams',
		'$location',
		'WedstrijdService',
		'DatatableService',
	function ($scope, $http, $filter, $mdDialog, $routeParams, $location, wedstrijdService, DatatableService) {
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

		// Sorteer volgorde
		$scope.order = 'wedstrijd_id';

		$scope.main_page = 1;

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
		/* READ */
		/*
		* Methode om alle toernooien op te halen.
		* Deze worden vervolgens ingeladen in de datatable.
		*/
		function list() {
			wedstrijdService
			.list($routeParams.toernooiId, $routeParams.subToernooiId)
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
				var data = {
					wedstrijd_id: DatatableService.getSelection().wedstrijd_id,
					subtoernooi_id: $routeParams.subToernooiId,
					toernooi_id: $routeParams.toernooiId
				}
				wedstrijdService
				.delete(data)
				.success(function(response) {
					if (!response.error) {
						DatatableService.data.splice($scope.getIndexById(data), 1);
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
				.textContent('Weet u zeker dat u deze wedstrijd wilt verwijderen?')
				.ariaLabel('Verwijder wedstrijd')
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
			$scope.formData.wedstrijd_id= item.wedstrijd_id;
			$scope.formData.team1 = item.team1;
			$scope.formData.team2 = item.team2;
			$scope.formData.scheidsrechter = item.scheidsrechter;
			$scope.formData.start_datum = $scope.convertDate(item.start_datum.date);
			$scope.formData.poulecode = item.poulecode;
		}


		/*
		* Methode die wordt aangeroepen als het formulier
		* gesubmit wordt.
		*/
		$scope.submit = function() {
			var data = {
				wedstrijd_id: 	DatatableService.getSelection().wedstrijd_id,
				subtoernooi_id: $routeParams.subToernooiId,
				toernooi_id:    $routeParams.toernooiId,
				team1:       		$scope.formData.team1,
				team2:          $scope.formData.team2,
				scheidsrechter: $scope.formData.scheidsrechter,
				start_datum:    $filter('date')($scope.formData.start_datum, "yyyy-MM-dd"),
				poulecode:      $scope.formData.poulecode
			};
			wedstrijdService
			.update(data)
			.success(function(response) {
				if (response.error)
					$scope.error = response.error;
				else {
					var ids = {
						wedstrijd_id: DatatableService.getSelection().wedstrijd_id,
						subtoernooi_id: $routeParams.toernooiId,
						toernooi_id: $routeParams.subToernooiId
					}
					var index = $scope.getIndexById(ids);

					wedstrijdService
					.find(data)
					.success(function(response) {
						DatatableService.data[index] = response;
						DatatableService.eraseSelection();
					});
					$scope.main_page = 1;
				}
			});
		}

		/* OVERIGE*/

		/*
		* Methode om de index van een wedstrijd op te halen.
		* wedstrijd id en de index zijn niet gelijk aan elkaar.
		*
		* @param id Het wedstrijd id.
		*
		* @return De bijbehornde index in de datatable.
		*/
		$scope.getIndexById = function(data) {
			for(var i = 0; i < DatatableService.data.length; i++) {
				if (DatatableService.data[i].wedstrijd_id == data['wedstrijd_id'] &&
				DatatableService.data[i].subtoernooi_id == data['subtoernooi_id'] &&
				DatatableService.data[i].toernooi_id == data['toernooi_id'])
				return i;
			}
		}

		$scope.createForm = function() {
			var path = '/wedstrijd/create/' + $routeParams.toernooiId + '/' + $routeParams.subToernooiId;
			$location.path(path);
		}
	}]);
});
