define(['app'], function(app) {
	app.service('toernooiService', ['$http', function ($http) {
		return {
      create: function (data) {
        var url = 'api/toernooi/add';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      }
    };
  }]);
});
