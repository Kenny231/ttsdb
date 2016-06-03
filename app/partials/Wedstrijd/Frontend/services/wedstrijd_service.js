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
			list: function(toernooi_id, subtoernooi_id) {
				var url = 'app/api/wedstrijd/list';
				var data = {
					toernooi_id: toernooi_id,
					subtoernooi_id: subtoernooi_id
				};
				return $http({
					method: 'POST',
					url: url,
					data: data
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
