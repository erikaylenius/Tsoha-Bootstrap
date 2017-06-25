<?php

  class HelloWorldController extends BaseController{

    public static function index(){
   	  View::make('etusivu.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      // echo 'Hello World!';
      //View::make('helloworld.html');
      $tuote = Tuote::find(1);
      $tuotteet = Tuote::all();
      // Kint-luokan dump-metodi tulostaa muuttujan arvon
      Kint::dump($tuotteet);
      Kint::dump($tuote);
    }

  }
