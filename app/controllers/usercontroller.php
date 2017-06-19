<?php

  class UserController extends BaseController{

    public static function index(){
   	  View::make('etusivu.html');
    }

    public static function handle_login(){
    $params = $_POST;
    $user = User::authenticate($params['tunnus'], $params['salasana']);

    if(!$user){
      View::make('etusivu.html', array('message' => 'Väärä käyttäjätunnus tai salasana!', 'tunnus' => $params['tunnus']));
    }else{

      $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Tervetuloa, ' . $user->tunnus . '!'));
    }
  }

    public static function logout(){
      $_SESSION['user'] = null;
      Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
    }
  }

  

}