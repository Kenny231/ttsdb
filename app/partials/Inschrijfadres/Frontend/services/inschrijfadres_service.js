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
			find: function(toernooi_id, subtoernooi_id) {
        var url = 'app/api/inschrijfadres/find';
        var data = {
          toernooi_id: toernooi_id,
					subtoernooi_id: subtoernooi_id
        };
        return $http({
          method: 'POST',
          url: url,
          data: data
        })
      },
			delete: function(toernooi_id, subtoernooi_id) {
				var url = 'app/api/inschrijfadres/delete';
				var data = {
					toernooi_id: toernooi_id,
					subtoernooi_id: subtoernooi_id					
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
