define(['app'], function(app) {
	app.service('ScoreService', ['$http', function ($http) {
		return {
      create: function(data) {
        var url = 'app/api/score/add';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
      scores: function(data) {
        var url = 'app/api/score/scores';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      }
    };
  }]);
});
