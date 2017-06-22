<?php

	class Asiakas extends BaseModel{
		public $id, $tunnus, $salasana, $nimi, $email, $osoite, $puh;

		public function __construct($attributes){
			parent::__construct($attributes);
		}

    public function save(){
      $query = DB::connection()->prepare('INSERT INTO Asiakas (tunnus, salasana, nimi, email, osoite, puh) VALUES (:tunnus, :salasana, :nimi, :email, :osoite, :puh) RETURNING id');
      $query->execute(array('tunnus' => $this->tunnus, 'salasana' => $this->salasana, 'nimi' => $this->nimi, 'email' => $this->email, 'osoite' => $this->osoite, 'puh' => $this->puh));
      $row = $query->fetch();
      $this->id = $row['id'];
    }

    public function update(){
      $query = DB::connection()->prepare('UPDATE Asiakas SET tunnus = :tunnus, salasana = :salasana, nimi = :nimi, email = :email, osoite = :osoite, puh = :puh WHERE id = :id');
            $query->execute(array('id' => $this->id, 'tunnus' => $this->tunnus, 'salasana' => $this->salasana, 'nimi' => $this->nimi, 'email' => $this->email, 'osoite' => $this->osoite, 'puh' => $this->puh));
    }


    public function destroy(){
      $query = DB::connection()->prepare('DELETE FROM Asiakas WHERE id = :id');
      $query->execute(array('id' => $this->id));
    }

		public static function all(){
    
    		$query = DB::connection()->prepare('SELECT * FROM Asiakas');
    		$query->execute();
    		$rows = $query->fetchAll();
   			$asiakkaat = array();

   			foreach($rows as $row){
      			$asiakkaat[] = new Asiakas(array(
        		'id' => $row['id'],
            'tunnus' => $row['tunnus'],
        		'salasana' => $row['salasana'],
        		'nimi' => $row['nimi'],
        		'email' => $row['email'],
        		'osoite' => $row['osoite'],
        		'puh' => $row['puh']
      			));
    		}
    		return $asiakkaat;
   		}

   		public static function find($id){
    		$query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE id = :id LIMIT 1');
    		$query->execute(array('id' => $id));
    		$row = $query->fetch();

    		if($row){
      			$asiakas = new Asiakas(array(
        			'id' => $row['id'],
              'tunnus' => $row['tunnus'],
              'salasana' => $row['salasana'],
              'nimi' => $row['nimi'],
              'email' => $row['email'],
              'osoite' => $row['osoite'],
              'puh' => $row['puh']
            ));

      		return $asiakas;
    		}

    	return null;
  		}

      //KIRJAUTUMINEN

      public static function authenticate($tunnus, $salasana) {

      $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE tunnus = :tunnus AND salasana = :salasana LIMIT 1');  
      $query->execute(array('tunnus' => $tunnus, 'salasana' => $salasana));
      $row = $query->fetch();

      if($row){
      // Käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
        $kirjautunut = new Asiakas(array(
          'id' => $row['id'],
          'tunnus' => $row['tunnus'],
          'salasana' => $row['salasana'],
          'nimi' => $row['nimi'],
          'email' => $row['email'],
          'osoite' => $row['osoite'],
          'puh' => $row['puh']
        ));

        return $kirjautunut;

      }else{
      // Käyttäjää ei löytynyt, palautetaan null
        return null;
      }

    }


	}