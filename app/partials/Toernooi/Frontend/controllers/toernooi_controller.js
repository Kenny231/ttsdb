define(['app'], function (app) {
	app.controller('ToernooiController', ['$scope', '$http', '$filter', '$location', 'toernooiService', function ($scope, $http, $filter, $location, toernooiService) {
    $scope.page = 1;

		$scope.create = function() {
			var data = {
				naam: 				$scope.toernooinaam,
				type: 				$scope.toernooitype,
				geslacht: 		$scope.geslacht.value,
				enkel: 				$scope.enkel.value,
				start_datum: 	$filter('date')($scope.start_datum, "yyyy-MM-dd"),
				eind_datum:   $filter('date')($scope.eind_datum, "yyyy-MM-dd"),
				organisatie: 	$scope.organisatie,
				tijd: 				$filter('date')($scope.aanvangstijdstip, "HH:mm:ss")
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
		$scope.geslacht = $scope.select_geslacht[0];
		/* Toernooitype */
		$scope.select_toernooi = [
			'Familie',
			'Ladder',
			'Prestatie'
		];
		$scope.toernooitype = $scope.select_toernooi[0];
		/* Enkel */
		$scope.select_enkel = [
			{name: 'Nee', value: '0'},
			{name: 'Ja',  value: '1'}
		];
		$scope.enkel = $scope.select_enkel[0];
	}]);
});
