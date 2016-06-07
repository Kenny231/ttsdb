define(['app'], function(app) {
  app.factory('DatatableService', function ($localStorage) {
    var factory = {};
    var o_factory = factory;
    var factory = {};

    // Geselecteerde rij.
    factory.selected = [];
    // Data
    factory.data = null;
    // Huidige pagina in de datatable.
    factory.data_page = 1;
    // Standaard aantal rijen per pagina.
    factory.limit = 5;
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
