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