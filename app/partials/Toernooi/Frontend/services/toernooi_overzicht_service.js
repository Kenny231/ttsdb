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
     getAllPoules: function(toernooi_id, subtoernooi_id) {
        var url = 'app/api/toernooioverzicht/getallpoules';
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
