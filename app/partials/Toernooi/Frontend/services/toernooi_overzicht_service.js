define(['app'], function(app) {
  app.service('toernooiOverzichtService', ['$http', function ($http) {
    return {
      createPoules: function(data) {
        var url = 'app/api/toernooioverzicht/createpoules';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },

      find: function(id) {
        var url = 'app/api/toernooi/find';
        var data = {
          id: id
        };
        return $http({
          method: 'POST',
          url: url,
          data: data
        })
      }
    };
  }]);
});
