<?php
	require 'app/models/tuote.php';
	class TuoteController extends BaseController{
		public static function index(){
    		$tuotteet = Tuote::all();
    		View::make('tuotteet_yp/tuotteet_yp.html', array('tuotteet' => $tuotteet));
  		}

    public static function tuote_yp(){
      View::make('tuotteet_yp/tuote_yp.html');
    }

  		public static function show($id){
        $tuote = Tuote::find($id);
  			View::make('tuotteet_yp/tuote_yp.html', array('tuote' => $tuote));
  		}

//UUDEN TUOTTEEN TALLETUS

    public static function uusituote(){
      View::make('tuotteet_yp/uusituote.html');
    }

    public static function store(){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;
    // Alustetaan uusi Tuote-luokan olion käyttäjän syöttämillä arvoilla
    $uusituote = new Tuote(array(
      'nimike' => $params['nimike'],
      'hinta' => $params['hinta'],
      'kuvaus' => $params['kuvaus'],
      'varastosaldo' => $params['varastosaldo'],
      'halytyssaldo' => $params['halytyssaldo']
    ));

    // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
    $uusituote->save();

    // Ohjataan käyttäjä lisäyksen jälkeen tuotteen esittelysivulle
    Redirect::to('/tuotteet_yp', array('message' => 'Tuotteen lisääminen onnistui.'));
  }  


  //TUOTTEEN MUOKKAAMINEN

    public static function edit($id){
      $tuote = Tuote::find($id);
      View::make('tuotteet_yp/edit.html', array('tuote' => $tuote));
  }

  public static function paivita($id){
    $params = $_POST;

    $attribuutit = array(
      'id' => $id,
      'nimike' => $params['nimike'],
      'hinta' => $params['hinta'],
      'kuvaus' => $params['kuvaus'],
      'varastosaldo' => $params['varastosaldo'],
      'halytyssaldo' => $params['halytyssaldo']
    );

    // Alustetaan Tuote-olio käyttäjän syöttämillä tiedoilla
    $muokattutuote = new Tuote($attribuutit);
    // $errors = $tuote->errors();

    /*
    if(count($errors) > 0){
      View::make('tuotteet_yp/edit.html', array('errors' => $errors, 'attribuutit' => $attribuutit));
    }else{
      // Kutsutaan alustetun olion update-metodia, joka päivittää tuotteen tiedot tietokannassa */
      $muokattutuote->update();

      Redirect::to('/tuotteet_yp/' . $muokattutuote->id, array('message' => 'Tietojen muutokset tallennettu'));
    // }
  }

  //TUOTTEEN POISTAMINEN
   // Pelin poistaminen
  public static function destroy($id){
    // Alustetaan Tuote-olio annetulla id:llä
    $poistettava = new Tuote(array('id' => $id));
    // Kutsutaan Tuote-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $poistettava->destroy();

    // Ohjataan käyttäjä tuotteiden listaussivulle ilmoituksen kera
    Redirect::to('/tuotteet_yp', array('message' => 'Tuote poistettu'));
  }

	}