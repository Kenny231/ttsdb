define(['app'], function (app) {
	app.controller('CreateWedstrijdController', ['$scope', '$http', '$filter', '$location', 'WedstrijdService', function ($scope, $http, $filter, $location, wedstrijdService) {
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
				wedstrijd_id: 	$scope.formData.wedstrijd_id,
				subtoernooi_id: $scope.formData.subtoernooi_id,
				toernooi_id:    $scope.formData.toernooi_id,
				team1:       		$scope.formData.team1,
				team2:          $scope.formData.team2,
				scheidsrechter: $scope.formData.scheidsrechter,
				start_datum:    $filter('date')($scope.formData.start_datum, "yyyy-MM-dd"),
				poulecode:      $scope.formData.poulecode
			};
			wedstrijdService
			.create(data)
			.success(function(response) {
				if (!response.error)
				$location.path('/');

				console.log(response);
			});
		}
	}]);
});
