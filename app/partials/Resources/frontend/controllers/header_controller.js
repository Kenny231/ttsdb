define(['app'], function (app) {
  app.controller('HeaderController', ['$scope', 'LoginSession', function ($scope, LoginSession) {
    $scope.LoginSession = LoginSession;
    $scope.voornaam = LoginSession.getVoornaam();
    $scope.achternaam = LoginSession.getAchternaam();

    $scope.status = {
      isopen: false
    };
  }]);
});
