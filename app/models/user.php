<?php

	class User extends BaseModel{
		public $tunnus, $salasana;

		public function __construct($attributes){
			parent::__construct($attributes);
		}


    public static function handle_login() {
      $query = DB::connection()->prepare('SELECT * FROM User WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');  
      $query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
      $row = $query->fetch();

      if($row){
      // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
        $user = new User(array(
          'tunnus' => $row['tunnus'],
          'salasana' => $row['salasana'],
        ));

        return $tuote;

      }else{
      // Käyttäjää ei löytynyt, palautetaan null
        return null;
      }

    }

	}