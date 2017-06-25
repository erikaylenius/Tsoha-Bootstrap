<?php
	require 'app/models/tilaus.php';
  require 'app/models/tilattava.php';

	class TilausController extends BaseController{

    // Tilausluettelo
		public static function index(){
        self::check_logged_in();
    		$tilaukset = Tilaus::all();
    		View::make('tilaus/tilaukset.html', array('tilaukset' => $tilaukset));
  		}

    // KIRJAUTUNUT ASIAKAS: omat tilaukset      
    public static function omat(){
      self::check_logged_in_asiakas();
      $tilaukset = Tilaus::omat(self::get_asiakas_logged_in_id());
      View::make('tilaus/omattilaukset.html', array('tilaukset' => $tilaukset));
    }

    // Yksittäisen asiakkaan tilaukset
    public static function asiakkaan_tilaukset($id){
      self::check_logged_in();
      $tilaukset = Tilaus::omat($id);
      View::make('tilaus/omattilaukset.html', array('tilaukset' => $tilaukset));
    }

    // Tilaukseen liittyvä tuoteluettelo
    public static function tilatut($id){
      $tilatut = Tilattava::tilatut($id);
      View::make('tilaus/tilaus.html', array('tilatut' => $tilatut));
    }

    public static function tilaus(){
      View::make('tilaus/tilaus.html');
    }

    // KIRJAUTUNUT ASIAKAS: tuotevalikoima
    public static function valikoima(){
      self::check_logged_in_asiakas();
      $tuotteet = Tuote::all();
      View::make('tilaus/valikoima.html', array('tuotteet' => $tuotteet));
    }

    // KIRJAUTUNUT ASIAKAS: tuotteen tarkastelu
  	public static function show($id){
      self::check_logged_in_asiakas();
      $tuote = Tuote::find($id);
  		View::make('tilaus/tuote.html', array('tuote' => $tuote));
  	}


    // UUSI TILAUS
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

          // "Ostoslistan" tyhjennys
          $_SESSION['tilattavat'] = null;
          $tilattavat = array();
          $_SESSION['tilattavat'] = $tilattavat;

    

          Redirect::to('/tilaukset/omat', array('message' => 'Tilaaminen onnistui'));

        } else {
          Redirect::to('/valikoima', array('message' => 'Virhe!'));
        }

      } else {
        Redirect::to('/valikoima', array('message' => 'Et ole valinnut yhtäkään tuotetta.'));
      }
    }


    // Tuotteen lisääminen ostettavien joukkoon
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

	}