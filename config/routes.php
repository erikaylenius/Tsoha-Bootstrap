<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/asiakkaat', function() {
    HelloWorldController::asiakkaat();
  });

  $routes->get('/asiakas', function() {
    HelloWorldController::asiakas();
  });

  $routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
  });

  $routes->get('/omattiedot', function() {
    HelloWorldController::omattiedot();
  }); 

  $routes->get('/rekisteroidy', function() {
    HelloWorldController::rekisteroidy();
  }); 

  $routes->get('/tilaukset', function() {
    HelloWorldController::tilaukset();
  });

  $routes->get('/uusitilaus', function() {
    HelloWorldController::uusitilaus();
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
  $routes->post('/tuotteet_yp/uusituote', function(){
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

  $routes->post('/tuotteet_yp/:id/edit', function($id){
    // Tuotteen muokkaaminen
    TuoteController::update($id);
  });

  $routes->post('/tuotteet_yp/:id/destroy', function($id){
    // Tuotteen poisto
    TuoteController::destroy($id);
  });