<?php
	require 'app/models/tuote.php';
	class AsiakasController extends BaseController{
		public static function index(){
        self::check_logged_in();
    		$asiakkaat = Asiakas::all();
    		View::make('asiakkaat/asiakkaat.html', array('asiakkaat' => $asiakkaat));
  		}

    public static function asiakas(){
      self::check_logged_in();
      View::make('asiakkaat/asiakas.html');
    }

  		public static function show($id){
        self::check_logged_in();
        $asiakas = Asiakas::find($id);
  			View::make('asiakkaat/asiakas.html', array('asiakas' => $asiakas));
  		}

	}