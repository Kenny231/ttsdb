define(['app'], function (app) {
	app.controller('AanmeldenController', ['$scope', '$http', '$mdDialog', 'DatatableService', function ($scope, $http, $mdDialog, DatatableService) {
		$scope.showSubForm = false;
		$scope.subFormData = {};
		// Geen edit / delete buttons.
		$scope.show_toernooi_buttons = false;
    // Geen style.
    $scope.toernooi_form_style = "";
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
