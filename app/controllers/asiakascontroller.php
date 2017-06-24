<?php
	require 'app/models/asiakas.php';
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

      // Omat tiedot
    public static function omattiedot(){
      self::check_logged_in_asiakas();
      View::make('asiakkaat/omattiedot.html');
    }

    public static function paivita($id){
    $params = $_POST;

    $attribuutit = array(
      'id' => $id,
      'tunnus' => $params['tunnus'],
      'salasana' => $params['salasana'],
      'nimi' => $params['nimi'],
      'email' => $params['email'],
      'osoite' => $params['osoite'],
      'puh' => $params['puh']
    );

    // Alustetaan Tuote-olio käyttäjän syöttämillä tiedoilla
    $muokattuasiakas = new Asiakas($attribuutit);
    // $errors = $muokattutuote->errors();

    // if(count($errors) == 0){

      $muokattuasiakas->update();
      Redirect::to('/omattiedot', array('message' => 'Tietojen muutokset tallennettu'));
    //} else {
      // View::make('tuotteet_yp/edit.html', array('errors' => $errors, 'tuote' => $params));
      
    //}
  }

    //REKISTERÖITYMINEN

    public static function tervetuloa(){
      View::make('etusivu.html');
    }  

    public static function rekisteroidy(){
      // TÄHÄN: EI SAA OLLA KIRJAUTUNUT
      View::make('asiakkaat/rekisteroidy.html');
    }

    public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Asiakas-luokan olion käyttäjän syöttämillä arvoilla
    $uusiasiakas = new Asiakas(array(
      'tunnus' => $params['tunnus'],
      'salasana' => $params['salasana'],
      'nimi' => $params['nimi'],
      'email' => $params['email'],
      'osoite' => $params['osoite'],
      'puh' => $params['puh']
    ));

    // $errors = $uusiasiakas->errors();

    // if(count($errors) == 0){

      // Kutsutaan alustamamme olion save-metodia, joka tallentaa olion tietokantaan
      $uusiasiakas->save();

      // Ohjataan käyttäjä lisäyksen jälkeen tuotteen esittelysivulle
      Redirect::to('/tervetuloa', array('message' => 'Tunnuksen luominen onnistui.'));
    
    // }else{
      // Tuoteessa vika
      // View::make('rekisteroidy.html', array('errors' => $errors, 'attributes' => $params));
    // }
    }

  //TUNNUSTEN POISTAMINEN
  public static function destroy($id){
    // Alustetaan Tuote-olio annetulla id:llä
    $poistettava = new Asiakas(array('id' => $id));
    // Kutsutaan Tuote-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $poistettava->destroy();

    // Ohjataan käyttäjä tuotteiden listaussivulle ilmoituksen kera
    Redirect::to('/', array('message' => 'Tunnus poistettu'));
  }

  // KIRJAUTUMINEN

  public static function handle_login_asiakas(){
    $params = $_POST;
    $kirjautunut = Asiakas::authenticate($params['tunnus'], $params['salasana']);

    if(!$kirjautunut){
      View::make('etusivu.html', array('message' => 'Väärä käyttäjätunnus tai salasana!', 'tunnus' => $params['tunnus']));
    }else{

      $_SESSION['kirjautunut'] = $kirjautunut->id;

// !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!KOKEILU
      $tilattavat = array();
      $_SESSION['tilattavat'] = $tilattavat;

      Redirect::to('/', array('message' => 'Tervetuloa, ' . $kirjautunut->tunnus . '!'));
    }
  }

    public static function logout_asiakas(){
      $_SESSION['kirjautunut'] = null;
      Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }  

	}