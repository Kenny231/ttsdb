define(['app'], function(app) {
	app.service('toernooiService', ['$http', function ($http) {
		return {
      create: function (data) {
        var url = 'app/api/toernooi/add';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
			list: function() {
				var url = 'app/api/toernooi/list';
				return $http({
					method: 'GET',
					url: url
				});
			},
			delete: function(id) {
				var url = 'app/api/toernooi/delete';
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
