define(['app'], function (app) {
	app.controller('AanmeldenController', ['$scope', '$http', '$mdDialog', 'aanmeldenService', 'DatatableService', 'LoginSession', function ($scope, $http, $mdDialog, aanmeldenService, DatatableService, LoginSession) {
		$scope.showSubForm = false;
		$scope.subFormData = {};
		// Geen edit / delete buttons.
		$scope.show_toernooi_buttons = false;
    // Geen style.
    $scope.toernooi_form_style = "";
		// Data
		function findAvailable() {
			console.log(LoginSession.getPersoonId());
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
				// Do stuff
			});
		};
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
			$scope.showSubForm = false;
		}
	}]);
});
