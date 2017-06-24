<?php
	require 'app/models/tilaus.php';
  require 'app/models/tilattava.php';

	class TilausController extends BaseController{
		public static function index(){
    		$tilaukset = Tilaus::all();
    		View::make('tilaus/tilaukset.html', array('tilaukset' => $tilaukset));
  		}

      public static function omat(){
        $tilaukset = Tilaus::omat(self::get_asiakas_logged_in_id());
        View::make('tilaus/omattilaukset.html', array('tilaukset' => $tilaukset));
      }

      public static function asiakkaan_tilaukset($id){
        $tilaukset = Tilaus::omat($id);
        View::make('tilaus/omattilaukset.html', array('tilaukset' => $tilaukset));
      }

      public static function tilatut($id){
        $tilatut = Tilattava::tilatut($id);
        View::make('tilaus/tilaus.html', array('tilatut' => $tilatut));
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

      if (!empty($_SESSION['tilattavat'])) {
  if (isset($_SESSION['kirjautunut'])) {

    $asiakas = self::get_asiakas_logged_in();
    // Alustetaan uusi Tilaus-luokan olio
    $uusitilaus = new Tilaus(array(
      'asiakas_id' => self::get_asiakas_logged_in_id(),
      'loppusumma' => 0,
      'pvm' => date('d-m-Y H:i:s')
    ));

      $uusitilaus->save();

      $_SESSION['tilattavat'] = null;
      $tilattavat = array();
      $_SESSION['tilattavat'] = $tilattavat;

    

      Redirect::to('/valikoima', array('message' => 'Tilaaminen onnistui'));

    } else {
      Redirect::to('/valikoima', array('message' => 'Virhe!'));
    }

  } else {
    Redirect::to('/valikoima', array('message' => 'Et ole valinnut yhtäkään tuotetta.'));
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


      $errors = $tilattava->errors();

      if(count($errors) == 0){
        $tilattava->save();


    

      Redirect::to('/valikoima', array('message' => 'Tuote lisätty.'));
    } else {
      Redirect::to('/valikoima', array('errors' => $errors));
    }

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