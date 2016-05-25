define(['app'], function(app) {
	app.service('LoginSession', ['$localStorage', function ($localStorage) {
    return {
      login: function(voornaam, achternaam, persoon_id) {
        $localStorage.loggedIn = true;
				$localStorage.voornaam = voornaam;
				$localStorage.achternaam = achternaam;
				$localStorage.persoon_id = persoon_id;
      },
      logout: function() {
        $localStorage.loggedIn = false;
      },
      isLoggedIn: function() {
				if ($localStorage.loggedIn == 'undefined')
				  return false;
        return $localStorage.loggedIn;
      },
			getVoornaam: function() {
				return $localStorage.voornaam;
			},
			getAchternaam: function() {
				return $localStorage.achternaam;
			},
			getPersoonId: function() {
				return $localStorage.persoon_id;
			}
    };
  }]);
});
