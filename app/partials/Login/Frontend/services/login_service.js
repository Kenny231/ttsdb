define(['app'], function(app) {
  app.service('loginService', ['$http', function ($http) {
    return {
      login: function(_username, _password) {
        var url = "app/api/login";
        var data = {
          username: _username,
          password: _password
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
