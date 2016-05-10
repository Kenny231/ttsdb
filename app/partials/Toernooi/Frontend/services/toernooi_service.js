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
      }
    };
  }]);
});
