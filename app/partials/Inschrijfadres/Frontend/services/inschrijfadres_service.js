define(['app'], function(app) {
	app.service('InschrijfadresService', ['$http', function ($http) {
		return {
      create: function (data) {
        var url = 'app/api/inschrijfadres/add';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      }

    };
  }]);
});
