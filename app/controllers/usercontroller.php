<?php

  class UserController extends BaseController{

    public static function index(){
   	  View::make('etusivu.html');
    }

    public static function handle_login(){
    $params = $_POST;

    $user = User::authenticate($params['tunnus'], $params['salasana']);

    if(!$user){
      View::make('etusivu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'tunnus' => $params['tunnus']));
    }else{
      $_SESSION['user'] = $user->id;

      Redirect::to('/', array('message' => 'Tervetuloa, ' . $user->name . '!'));
    }
  }

}