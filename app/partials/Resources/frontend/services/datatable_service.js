define(['app'], function(app) {
	app.factory('DatatableService', function ($localStorage) {
    var factory = {};

    // Geselecteerde rij.
    factory.selected = [];
    /*
     * Methode om het huidig geselecteerde toernooi te verkrijgen.
     */
    factory.getSelection = function() {
      return factory.selected[0];
    }
    /*
     * Methode om te kijken of er een toernooi is geselecteerd.
     */
    factory.hasSelection = function() {
      return factory.getSelection() != null;
    }
    /*
     * Methode of de huidige selectie leeg te maken.
     */
    factory.eraseSelection = function() {
      factory.selected[0] = null;
    }
    return factory;
  });
});
