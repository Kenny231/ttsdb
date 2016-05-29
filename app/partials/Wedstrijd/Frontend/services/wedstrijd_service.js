define(['app'], function(app) {
	app.service('WedstrijdService', ['$http', function ($http) {
		return {
      create: function(data) {
        var url = 'app/api/wedstrijd/add';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
			update: function(data) {
				var url = 'app/api/wedstrijd/update';
				return $http({
					method: 'POST',
					url: url,
					data: data
				});
			},
			list: function() {
				var url = 'app/api/wedstrijd/list';
				return $http({
					method: 'GET',
					url: url
				});
			},
			find: function(data) {
        var url = 'app/api/wedstrijd/find';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
			delete: function(data) {
				var url = 'app/api/wedstrijd/delete';
				return $http({
					method: 'POST',
					url: url,
					data: data
				});
			}
    };
  }]);
});
