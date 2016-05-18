define(['app'], function(app) {
	app.service('LoginSession', ['$localStorage', function ($localStorage) {
    return {
      login: function() {
        $localStorage.loggedIn = true;
      },
      logout: function() {
        $localStorage.loggedIn = false;
      },
      isLoggedIn: function() {
				if ($localStorage.loggedIn == 'undefined')
				  return false;
					
        return $localStorage.loggedIn;
      }
    };
  }]);
});
