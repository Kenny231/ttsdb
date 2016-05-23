define(['app'], function (app) {
	app.controller('HeaderController', ['$scope', 'LoginSession', function ($scope, LoginSession) {
		$scope.voornaam = LoginSession.getVoornaam();
    $scope.achternaam = LoginSession.getAchternaam();
	}]);
});
