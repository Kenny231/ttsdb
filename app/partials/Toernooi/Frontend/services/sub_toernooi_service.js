define(['app'], function(app) {
  app.service('subToernooiService', ['$http', function ($http) {
    return {
      create: function (data) {
        var url = 'app/api/subtoernooi/add';
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
      update: function(data) {
        var url = 'app/api/subtoernooi/update';
        return $http({
          method: 'POST',
          url: url,
          data: data
        })
      },
      list: function(id) {
        var url = 'app/api/subtoernooi/list';
        var data = {
          toernooi_id: id
        };
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
      find: function(toernooi_id, subtoernooi_id) {
        var url = 'app/api/subtoernooi/find';
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
        var url = 'app/api/subtoernooi/delete';
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
