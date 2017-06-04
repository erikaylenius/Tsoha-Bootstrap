<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  // View::make('home.html');
      echo 'Tämä on etusivu';
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      // echo 'Hello World!';
      View::make('helloworld.html');
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

     public static function tuotteet_yp(){
      View::make('suunnitelmat/tuotteet_yp.html');
    }

  }
