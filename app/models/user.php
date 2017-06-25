<?php

	class User extends BaseModel{
		public $id, $tunnus, $salasana;

		public function __construct($attributes){
			parent::__construct($attributes);
		}

    // Ylläpitäjän kirjautuminen
    public static function authenticate($tunnus, $salasana) {

      $query = DB::connection()->prepare('SELECT * FROM Yllapito WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');  
      $query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
      $row = $query->fetch();

      if($row){
      // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
        $user = new User(array(
          'id' => $row['id'],
          'tunnus' => $row['tunnus'],
          'salasana' => $row['salasana']
        ));

        return $user;

      }else{
      // Käyttäjää ei löytynyt, palautetaan null
        return null;
      }

    }

    public static function find($id){
      $query = DB::connection()->prepare('SELECT * FROM Yllapito WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();

      if($row){
          $user = new User(array(
            'id' => $row['id'],
            'tunnus' => $row['tunnus'],
            'salasana' => $row['salasana']
          ));

        return $user;

      } else {
        return null;
      }
    }    

	}