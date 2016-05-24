define(['app'], function (app) {
	app.controller('CreateToernooiController', ['$scope', '$http', '$filter', '$location', 'toernooiService', function ($scope, $http, $filter, $location, toernooiService) {
		// Form data
		$scope.formData = {};
		// pagina
		$scope.formData.page = 1;
		/*
		 * Methode die wordt aangeroepen als het formulier
		 * gesubmit wordt.
		 */
		$scope.submit = function() {
			var data = {
				naam: 				$scope.formData.toernooinaam,
				type: 				$scope.formData.toernooitype.type,
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
		$scope.select_data = [
			{
				"type" : "Ladder",
				"geslacht" : [
					{"name" : "Gemengd", "value" : "mv"}
				],
				"enkel" : [
					{"name" : "Ja", "value" : "1"}
				]
			}, {
				"type" : "Familie",
				"geslacht" : [
					{"name" : "Man", "value" : "m"},
					{"name" : "Vrouw", "value" : "v"},
					{"name" : "Gemengd", "value" : "mv"}
				],
				"enkel" : [
					{"name" : "Nee", "value" : "0"},
					{"name" : "Ja", "value" : "1"}
				]
			}, {
				"type" : "Prestatie",
				"geslacht" : [
					{"name" : "Man", "value" : "m"},
					{"name" : "Vrouw", "value" : "v"},
					{"name" : "Gemengd", "value" : "mv"}
				],
				"enkel" : [
					{"name" : "Nee", "value" : "0"},
					{"name" : "Ja", "value" : "1"}
				]
			}
		]

		$scope.formData.toernooitype = $scope.select_data[0];
		$scope.formData.geslacht = $scope.select_data[0].geslacht[0];
		$scope.formData.enkel = $scope.select_data[0].enkel[0];
		/*
		 * Methode die de index van de select data teruggeeft,
		 * op basis van het toernooi type.
		 */
		function getIndexByType(type) {
			for (var i=0; i<$scope.select_data.length; i++) {
				if ($scope.select_data[i].type == type)
					return i;
			}
			return 0;
		}
		/*
		 * Methode die wordt aangeroepen zodra het toernooitype
		 * input veld veranderd.
		 */
		$scope.onChange = function() {
			var index = getIndexByType($scope.formData.toernooitype.type);
			$scope.formData.geslacht = $scope.select_data[index].geslacht[0];
			$scope.formData.enkel = $scope.select_data[index].enkel[0];
		}
	}]);
});
