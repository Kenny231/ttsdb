define(['app'], function (app) {
	app.controller('AanmeldenController', ['$scope', '$http', '$mdDialog', 'aanmeldenService', 'DatatableService', 'LoginSession', function ($scope, $http, $mdDialog, aanmeldenService, DatatableService, LoginSession) {
		$scope.showSubForm = false;
		$scope.subFormData = {};
		// Geen edit / delete buttons.
		$scope.show_toernooi_buttons = false;
    // Geen style.
    $scope.toernooi_form_style = "";
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
		// Data
		function findAvailable() {
			aanmeldenService
			.findAvailable(LoginSession.getPersoonId())
			.success(function(response) {
				DatatableService.data = response;
			});
		}
		findAvailable();

		$scope.showConfirm = function() {
			var confirm = $mdDialog.confirm()
				.title('Melding')
				.textContent('Weet u zeker dat u zich voor dit toernooi wilt inschrijven?')
				.ariaLabel('Aanmelden toernooi')
				.ok('Ja')
				.cancel('Nee');

			$mdDialog.show(confirm).then(function() {
				var row = DatatableService.getSelection();
				aanmeldenService
				.addSpelerToToernooi(LoginSession.getPersoonId(), row.toernooi_id)
				.success(function(response) {
					DatatableService.data.splice($scope.getIndexById(row.toernooi_id), 1);
				});
			});
		};

		$scope.submit = function() {
			var row = DatatableService.getSelection();
			aanmeldenService
			.find($scope.subFormData.partner)
			.success(function(response) {
				if (response.error)
					$scope.persoon_error = response.error;
				else if (LoginSession.getPersoonId() == $scope.subFormData.partner)
					$scope.persoon_error = 'U kan niet uwzelf opgeven als partner.';
				else {
					aanmeldenService
					.addSpelerToToernooi(LoginSession.getPersoonId(), row.toernooi_id,
						$scope.subFormData.team_naam, $scope.subFormData.partner)
					.success(function(response) {
						// Reset form
						resetSubForm();
						DatatableService.data.splice($scope.getIndexById(row.toernooi_id), 1);
					})
				}
			})
		}

		// Wanneer een record geselecteerd wordt.
		$scope.onSelect = function() {
			var row = DatatableService.getSelection();
			if (row.enkel == 0)
				$scope.showSubForm = true;
			else {
				if ($scope.showSubForm)
					$scope.showSubForm = false;

				$scope.showConfirm();
			}
		}
		$scope.onDeselect = function() {
			resetSubForm();
		}

		// Methode die het subform reset.
		function resetSubForm() {
			$scope.showSubForm = false;
			$scope.persoon_error = false;
			$scope.subFormData.team_naam = "";
			$scope.subFormData.partner = "";
		}
	}]);
});
