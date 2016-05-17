define(['app'], function (app) {
	app.controller('ToernooiController', ['$scope', '$http', '$filter', '$location', 'toernooiService', function ($scope, $http, $filter, $location, toernooiService) {
    $scope.page = 1;
		// Form data
		$scope.formData = {};
		/*
		 * Methode die wordt aangeroepen als het formulier
		 * gesubmit wordt.
		 */
		$scope.submit = function() {
			var data = {
				naam: 				$scope.formData.toernooinaam,
				type: 				$scope.formData.toernooitype,
				geslacht: 		$scope.formData.geslacht.value,
				enkel: 				$scope.formData.enkel.value,
				start_datum: 	$filter('date')($scope.formData.start_datum, "yyyy-MM-dd"),
				eind_datum:   $filter('date')($scope.formData.eind_datum, "yyyy-MM-dd"),
				organisatie: 	$scope.formData.organisatie,
				tijd: 				$filter('date')($scope.formData.aanvangstijdstip, "HH:mm:ss")
			};
			toernooiService
			.create(data)
			.success(function(response) {
				if (!response.error)
					$location.path('/');
			});
		}
		/*
		 *Select data
		*/
		/* Geslacht */
		$scope.select_geslacht = [
			{name: 'Man',     value: 'm'},
			{name: 'Vrouw',   value: 'v'},
			{name: 'Gemengd', value: 'mv'}
		];
		$scope.formData.geslacht = $scope.select_geslacht[0];
		/* Toernooitype */
		$scope.select_toernooi = [
			'Familie',
			'Ladder',
			'Prestatie'
		];
		$scope.formData.toernooitype = $scope.select_toernooi[0];
		/* Enkel */
		$scope.select_enkel = [
			{name: 'Nee', value: '0'},
			{name: 'Ja',  value: '1'}
		];
		$scope.formData.enkel = $scope.select_enkel[0];
	}]);
});
