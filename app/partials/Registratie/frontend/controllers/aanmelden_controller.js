define(['app'], function (app) {
	app.controller('AanmeldenController', ['$scope', '$http', 'DatatableService', function ($scope, $http, DatatableService) {
    // Geen edit / delete buttons.
		$scope.show_toernooi_buttons = false;
    // Geen style.
    $scope.toernooi_form_style = "";

    $scope.current_selection = function() {
      return DatatableService.getSelection();
    }
	}]);
});
