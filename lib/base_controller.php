<?php

  class BaseController{

    // YLLÄPITO

    public static function get_user_logged_in(){
       // Katsotaan onko user-avain sessiossa
      if(isset($_SESSION['user'])){
        $user_id = $_SESSION['user'];
        // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
        $user = User::find($user_id);

      return $user;
    }

      return null;
    }

    public static function check_logged_in(){
      if(!isset($_SESSION['user'])){
      Redirect::to('/', array('message' => 'Kirjaudu ensin sisään.'));
    }

  }

  // ASIAKAS

    public static function get_asiakas_logged_in(){
       // Katsotaan onko asiakas-avain sessiossa
      if(isset($_SESSION['kirjautunut'])){
        $kirjautunut_id = $_SESSION['kirjautunut'];
        // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
        $kirjautunut = Asiakas::find($kirjautunut_id);

      return $kirjautunut;
    }

      return null;
    }

    public static function get_asiakas_logged_in_id(){
       // Katsotaan onko asiakas-avain sessiossa
      if(isset($_SESSION['kirjautunut'])){
        $kirjautunut_id = $_SESSION['kirjautunut'];
        // Pyydetään User-mallilta käyttäjä session mukaisella id:llä
        $kirjautunut = Asiakas::find($kirjautunut_id);

      return $kirjautunut->id;
    }

      return null;
    }

    public static function check_logged_in_asiakas(){
      if(!isset($_SESSION['kirjautunut'])){
      Redirect::to('/', array('message' => 'Kirjaudu ensin sisään.'));
    }

  }

  
}
