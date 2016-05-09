define(['app'], function (app) {
	app.controller('ToernooiController', ['$scope', '$http', function ($scope, $http, $localStorage, accountService) {
    $scope.page = 1;
	}]);
});
