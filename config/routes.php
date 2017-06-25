<?php
  
  // Kirjautumissivu

  $routes->get('/', function() {
    UserController::index();
  });

  $routes->post('/', function() {
    AsiakasController::handle_login_asiakas();
  });

  // Ylläpidon kirjautuminen

  $routes->get('/yllapito', function() {
    UserController::yllapito();
  });

  $routes->post('/yllapito', function() {
    UserController::handle_login();
  });



  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
/*
  $routes->get('/etusivu', function() {
    UserController::index();
  });
*/


// ASIAKAS: Tuotteet ja tilaaminen

  $routes->get('/valikoima', function() {
    TilausController::valikoima();
  });

  $routes->get('/valikoima/:id', function($id) {
    TilausController::show($id);
  });

    $routes->post('/tilaus/:id/osta', function($id) {
    TilausController::lisaa($id);
  });

  $routes->post('/tilaus/laheta', function() {
    TilausController::store();
  });

    $routes->get('/tilaukset/omat', function() {
    TilausController::omat();
  });


// TILAUKSEN TUOTELISTA

  $routes->get('/tilaus/:id', function($id) {
    TilausController::tilatut($id);
  });
// KAIKKI TILAUKSET
    $routes->get('/tilaukset', function() {
    TilausController::index();
  });




    $routes->get('/tuotteet_yp', function() {
    TuoteController::index();
  });

    $routes->get('/tuote_yp', function() {
    TuoteController::tuote_yp();
  });

  // Tuotteen lisäyssivu  
  $routes->get('/tuotteet_yp/uusituote', function() {
    TuoteController::uusituote();
  });   

  // Tuotteen lisääminen tietokantaan
  $routes->post('/tuotteet_yp', function(){
    TuoteController::store();
  });

  // Tuotteen lisäyslomakkeen näyttäminen
  $routes->get('/tuotteet_yp/uusituote', function(){
    TuoteController::create();
    });

  $routes->get('/tuotteet_yp/:id', function($id) {
    // Tuotteen esittelysivu
    TuoteController::show($id);
  });

  $routes->get('/tuotteet_yp/:id/edit', function($id){
    // Tuotteen muokkauslomakkeen esittäminen
    TuoteController::edit($id);
  });

  $routes->post('/tuoteet_yp/:id/edit', function($id){
    // Tuotteen muokkaaminen
    TuoteController::paivita($id);
  });

  $routes->post('/tuotteet_yp/:id/destroy', function($id){
    // Tuotteen poisto
    TuoteController::destroy($id);
  });

    //Rekisteröityminen

  $routes->get('/rekisteroidy', function() {
    AsiakasController::rekisteroidy();
  });

  $routes->post('/omattiedot', function(){
    AsiakasController::store();
  });

    $routes->get('/tervetuloa', function(){
    AsiakasController::tervetuloa();
  });

// ASIAKKAAT

  // Asiakaslistaus 

  $routes->get('/asiakkaat', function() {
    AsiakasController::index();
  });

  // Yksittäisen asiakkaan tiedot

  $routes->get('/asiakkaat/:id', function($id) {
    AsiakasController::show($id);
  });

  // Asiakkaan poistaminen

  $routes->post('/asiakkaat/:id/destroy', function($id){
    AsiakasController::destroy($id);
  });

  // KIRJAUTUNUT ASIAKAS: Omat tiedot

  $routes->get('/omattiedot', function() {
    AsiakasController::omattiedot();
  });

  // KIRJAUTUNUT ASIAKAS: Omien tietojen muokkaaminen

  $routes->post('/asiakkaat/:id/edit', function($id){
    AsiakasController::paivita($id);
  });


// ULOSKIRJAUTUMINEN

  // Ylläpitäjä

  $routes->post('/logout', function(){
    UserController::logout();
  });

  // Asiakas

  $routes->post('/logout_asiakas', function(){
    AsiakasController::logout_asiakas();
  });