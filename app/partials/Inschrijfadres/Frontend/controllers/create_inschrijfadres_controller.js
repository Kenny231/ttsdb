define(['app'], function (app) {
	app.controller('CreateInschrijfadresController', ['$scope', '$http', '$filter', '$location', 'InschrijfadresService', function ($scope, $http, $filter, $location, inschrijfadresService) {
		// Form data
		$scope.formData = {};
		// pagina
	//	$scope.formData.page = 1;
		/*
		 * Methode die wordt aangeroepen als het formulier
		 * gesubmit wordt.
		 */
		$scope.submit = function() {
			var data = {
				postcode: 	   	$scope.formData.postcode,
				huisnummer: 	  $scope.formData.huisnummer,
				plaatsnaam:     $scope.formData.plaatsnaam,
				straatnaam: 		$scope.formData.straatnaam,
				persoon_id: 		$scope.formData.persoon_id,
				telefoonnummer: $scope.formData.telefoonnummer,
				email:          $scope.formData.email
			};
			inschrijfadresService
			.create(data)
			.success(function(response) {
				if (!response.error)
					$location.path('/');

				console.log(response);
			});
		}
	}]);
});
