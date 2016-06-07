define([
  'app',
  './config/toernooi_route',
  './services/toernooi_service',
  './services/sub_toernooi_service',
  './services/toernooi_overzicht_service',
  './controllers/read_toernooi_controller',
  './controllers/create_toernooi_controller',
  './controllers/read_sub_toernooi_controller',
  './controllers/create_sub_toernooi_controller',
  './controllers/toernooi_overzicht_controller',
], function (app) {
    console.log('Toernooi module loaded.');
});
