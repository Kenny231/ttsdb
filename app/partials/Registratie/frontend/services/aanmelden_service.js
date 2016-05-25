define(['app'], function(app) {
	app.service('aanmeldenService', ['$http', function ($http) {
		return {
			findAvailable: function(id) {
				var url = 'app/api/toernooi/available';
				var data = {
					id: id
				};
				return $http({
					method: 'POST',
					url: url,
					data: data
				});
			}
    };
  }]);
});
