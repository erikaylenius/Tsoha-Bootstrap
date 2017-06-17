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

    public static function etusivu(){
      View::make('suunnitelmat/etusivu.html');
    }

    // ylläpidon näkymät

    public static function asiakkaat(){
      View::make('suunnitelmat/asiakkaat.html');
    }

    public static function asiakas(){
      View::make('suunnitelmat/asiakas.html');
    }

    public static function tilaukset(){
      View::make('suunnitelmat/tilaukset.html');
    }    

    // asiakkaan näkymät

    public static function rekisteroidy(){
      View::make('suunnitelmat/rekisteroidy.html');
    }

    public static function omattiedot(){
      View::make('suunnitelmat/omattiedot.html');
    }

    public static function uusitilaus(){
      View::make('suunnitelmat/uusitilaus.html');
    }
/*
     public static function tuotteet_yp(){
      View::make('suunnitelmat/tuotteet_yp.html');
    }

    public static function tuote_yp(){
      View::make('suunnitelmat/tuote_yp.html');
    }
*/
    public static function uusituote(){
      View::make('tuotteet_yp/uusituote.html');
    }

  }
