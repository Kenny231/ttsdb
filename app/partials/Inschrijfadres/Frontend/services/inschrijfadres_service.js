define(['app'], function(app) {
	app.service('InschrijfadresService', ['$http', function ($http) {
		return {
      create: function(data) {
        var url = 'app/api/inschrijfadres/add';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
			update: function(data) {
				var url = 'app/api/inschrijfadres/update';
				return $http({
					method: 'POST',
					url: url,
					data: data
				});
			},
			list: function() {
				var url = 'app/api/inschrijfadres/list';
				return $http({
					method: 'GET',
					url: url
				});
			},
			find: function(id) {
        var url = 'app/api/inschrijfadres/find';
        var data = {
          id: id
        };
        return $http({
          method: 'POST',
          url: url,
          data: data
        })
      },
			delete: function(id) {
				var url = 'app/api/inschrijfadres/delete';
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
