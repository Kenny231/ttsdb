define(['app'], function (app) {
	app.controller('ToernooiController', ['$scope', '$http', 'toernooiService', function ($scope, $http, toernooiService) {
    $scope.page = 1;

		$scope.create = function() {
			console.log('Creating');

			var data = {
				naam: 				$scope.toernooinaam,
				type: 				$scope.toernooitype,
				geslacht: 		$scope.geslacht,
				enkel: 				$scope.enkel,
				start_datum: 	$scope.start_datum,
				eind_datum: 	$scope.eind_datum,
				organisatie: 	$scope.organisatie,
				tijd: 				$scope.aanvangstijdstip
			};
			toernooiService
			.create(data)
			.success(function(response) {
				console.log(response);
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
			'Ja',
			'Nee'
		];
		$scope.enkel = $scope.select_enkel[0];
	}]);
});
