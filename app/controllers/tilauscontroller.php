<?php
	require 'app/models/tuote.php';
	class TilausController extends BaseController{
		public static function index(){
    		$tuotteet = Tilaus::all();
    		View::make('tilaus/tilaukset.html', array('tilaukset' => $tilaukset));
  		}

    public static function tilaus(){
      View::make('tilaus/tilaus.html');
    }

  		public static function show($id){
        $tuote = Tuote::find($id);
  			View::make('tilaus/tilaus.html', array('tilaus' => $tilaus));
  		}

	}