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
      },
      update: function(data) {
        var url = 'app/api/toernooi/update';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
      list: function() {
        var url = 'app/api/toernooi/list';
        return $http({
          method: 'GET',
          url: url
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
      },
      delete: function(id) {
        var url = 'app/api/toernooi/delete';
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
