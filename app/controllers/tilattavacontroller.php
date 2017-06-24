<?php
	require 'app/models/tilattava.php';
	class TilattavaController extends BaseController{


//UUDEN TUOTTEEN TALLETUS

    public static function store($tilaus_id, $tuote_id, $lkm){

    $tilattava = new Tilattava(array(
      'tilaus_id' => $tilaus_id,
      'tuote_id' => $tuote_id,
      'lkm' => $lkm
    ));


      $tilattava->save();

  }


  

/*
  //TUOTTEEN MUOKKAAMINEN

    public static function edit($id){
      self::check_logged_in();
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
    $errors = $muokattutuote->errors();

    if(count($errors) == 0){

      $muokattutuote->update();
      Redirect::to('/tuotteet_yp/' . $muokattutuote->id, array('message' => 'Tietojen muutokset tallennettu'));
    } else {
      View::make('tuotteet_yp/edit.html', array('errors' => $errors, 'tuote' => $params));
      
    }
  }

  //TUOTTEEN POISTAMINEN
   // Tuotteen poistaminen
  public static function destroy($id){
    // Alustetaan Tuote-olio annetulla id:llä
    $poistettava = new Tuote(array('id' => $id));
    // Kutsutaan Tuote-malliluokan metodia destroy, joka poistaa pelin sen id:llä
    $poistettava->destroy();

    // Ohjataan käyttäjä tuotteiden listaussivulle ilmoituksen kera
    Redirect::to('/tuotteet_yp', array('message' => 'Tuote poistettu'));
  } */

	}