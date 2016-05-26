define(['app'], function(app) {
  app.service('aanmeldenService', ['$http', function ($http) {
    return {
      findAvailable: function(id) {
        var url = 'app/api/toernooi/available';
        var data = {
          id: id
        };
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
      addSpelerToToernooi: function(persoon_id, toernooi_id, team_naam, partner_id) {
        var url = 'app/api/registratie/aanmelden';
        var data = {
          persoon_id: persoon_id,
          toernooi_id: toernooi_id,
          team_naam: team_naam,
          partner_id: partner_id
        };
        return $http({
          method: 'POST',
          url: url,
          data: data
        });
      },
      find: function(persoon_id) {
        var url = 'app/api/findUserById';
        var data = {
          id: persoon_id
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
