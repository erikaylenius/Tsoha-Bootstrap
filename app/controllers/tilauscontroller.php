<?php
	require 'app/models/tilaus.php';
  require 'app/models/tilattava.php';

	class TilausController extends BaseController{
		public static function index(){
    		$tuotteet = Tilaus::all();
    		View::make('tilaus/tilaukset.html', array('tilaukset' => $tilaukset));
  		}

    public static function tilaus(){
      View::make('tilaus/tilaus.html');
    }

    public static function valikoima(){
      $tuotteet = Tuote::all();
      View::make('tilaus/valikoima.html', array('tuotteet' => $tuotteet));
    }

  		public static function show($id){
        $tuote = Tuote::find($id);
  			View::make('tilaus/tuote.html', array('tuote' => $tuote));
  		}

    public static function store(){

      $params = $_POST;
  if (isset($_SESSION['kirjautunut'])) {

    $asiakas = self::get_asiakas_logged_in();
    // Alustetaan uusi Tilaus-luokan olio
    $uusitilaus = new Tilaus(array(
      'asiakas_id' => self::get_asiakas_logged_in_id(),
      'loppusumma' => 0,
      'maksettu' => false,
      'pvm' => null
    ));

      $uusitilaus->save();

      /* foreach($params as $row){
        // $tuote_id = {{tuote_id}},
      $tilattava = new Tilattava(array(
      'tilaus_id' => $uusitilaus->id
      'tuote_id' => $tuote_id,
      'lkm' => $params['{{tuote.id}}']
    ));


      $tilattava->save();

      } */

      Redirect::to('/', array('message' => 'Tilaaminen onnistui'));

    }
  }

  public static function lisaa($id){

      $params = $_POST;

    if (isset($_SESSION['tilattavat'])) {

    
    $tilattava = new Tilattava(array(
      'tilaus_id' => null,
      'tuote_id' => $id,
      'lkm' => $params['lkm']

    ));

      $tilattava->save();

      $_SESSION['tilattavat'][] = $tilattava;

    

      Redirect::to('/valikoima', array('message' => 'Tuote lisätty.'));
    } else {
      Redirect::to('/valikoima', array('message' => 'Et ole kirjautunut sisään.'));
    }

    }
/*
    if (isset($_SESSION['tilattavat'])) {
      foreach($_SESSION['tilattavat'] as $tilattava) {
        $tilattava->asetatilaus($uusitilaus->id);
      }

    }


      // Ohjataan käyttäjä lisäyksen jälkeen tuotteen esittelysivulle
      // Redirect::to('/tervetuloa', array('message' => 'Tunnuksen luominen onnistui.'));
    
    // }else{
      // Tuoteessa vika
      // View::make('rekisteroidy.html', array('errors' => $errors, 'attributes' => $params));
    // }
    } */

	}