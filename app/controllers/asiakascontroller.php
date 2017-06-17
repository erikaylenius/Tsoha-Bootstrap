<?php
	require 'app/models/tuote.php';
	class AsiakasController extends BaseController{
		public static function index(){
    		$asiakkaat = Asiakas::all();
    		View::make('asiakkaat/asiakkaat.html', array('asiakkaat' => $asiakkaat));
  		}

    public static function asiakas(){
      View::make('asiakkaat/asiakas.html');
    }

  		public static function show($id){
        $asiakas = Asiakas::find($id);
  			View::make('asiakkaat/asiakas.html', array('asiakas' => $asiakas));
  		}

	}