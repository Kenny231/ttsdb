define(['app'], function (app) {
	app.controller('ReadToernooiController', ['$scope', '$http', '$mdDialog', 'toernooiService', function ($scope, $http, $mdDialog, toernooiService) {
		// Datatable variables
		$scope.selected = [];
		$scope.page = 1;
		$scope.limit = 5;
		$scope.order = 'toernooi_naam';

		$scope.list = function() {
			toernooiService
			.list()
			.success(function(response) {
				$scope.data = response;
			});
		}

		$scope.data = $scope.list();

		$scope.onDelete = function() {
			var item = $scope.selected[0].toernooi_id;
			if (item !== 'undefined') {
				toernooiService
				.delete(item)
				.success(function(response) {
					if (!response.error) {
						$scope.data.splice($scope.getIndexById(item), 1);
						$scope.row_count = $scope.row_count - 1;
					}
				});
			}
		}

		$scope.getIndexById = function(id) {
			for(var i = 0; i < $scope.data.length; i++) {
				if ($scope.data[i].toernooi_id == id)
					return i;
			}
		}

		$scope.convertDate = function(date) {
			return new Date(date);
		}

		$scope.showConfirm = function() {
			// Appending dialog to document.body to cover sidenav in docs app
			var confirm = $mdDialog.confirm()
				.title('Warning')
				.textContent('Weet u zeker dat u dit toernooi wilt verwijderen?')
				.ariaLabel('Verwijder Toernooi')
				.ok('Ja')
				.cancel('Nee');

			$mdDialog.show(confirm).then(function() {
				$scope.onDelete();
			});
		};
	}]);
});
