define(['app'], function (app) {
	app.controller('ToernooiSelectieController', [
		'$scope',
		'$http',
		'$location',
		'aanmeldenService',
		'DatatableService',
		'LoginSession',
	function ($scope, $http, $location, aanmeldenService, DatatableService, LoginSession) {
		$scope.subFormData = [];
		// Geen edit / delete buttons.
		$scope.show_toernooi_buttons = false;
    // Geen style.
    $scope.toernooi_form_style = "";

		// Data
		function findAvailable() {
			aanmeldenService
			.findAvailable(LoginSession.getPersoonId())
			.success(function(response) {
				DatatableService.data = response;
			});
		}
		findAvailable();

		// Wanneer een record geselecteerd wordt.
		$scope.onSelect = function() {
			var row = DatatableService.getSelection();
			$location.path('aanmelden/' + row.toernooi_id);
		}
	}]);
});
