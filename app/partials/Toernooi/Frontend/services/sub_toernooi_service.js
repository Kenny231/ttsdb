define(['app'], function(app) {
  app.service('subToernooiService', ['$http', function ($http) {
    return {
      list: function(id) {
        var url = 'app/api/subtoernooi/list';
        var data = {
          id: id
        };
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
      find: function(id) {
        var url = 'app/api/subtoernooi/find';
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
        var url = 'app/api/subtoernooi/delete';
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
