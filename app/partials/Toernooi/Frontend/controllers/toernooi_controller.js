define(['app'], function (app) {
	app.controller('ToernooiController', ['$scope', '$http', function ($scope, $http, $localStorage, accountService) {
    $scope.page = 1;
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
