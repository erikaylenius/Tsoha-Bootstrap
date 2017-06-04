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
    HelloWorldController::tuote_yp();
  });
    $routes->get('/uusituote', function() {
    HelloWorldController::uusituote();
  });   

    $routes->get(':id', function($id) {
    TuoteController::show($id);
  });