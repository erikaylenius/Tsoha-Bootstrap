<?php

	class Asiakas extends BaseModel{
		public $id, $tunnus, $salasana, $nimi, $email, $osoite, $puh;

		public function __construct($attributes){
			parent::__construct($attributes);
      $this->validators = array('validate_tunnus', 'validate_salasana', 'validate_nimi', 'validate_email', 'validate_osoite', 'validate_puh');
		}

    // Asiakkaan rekisteröityminen
    public function save(){
      $query = DB::connection()->prepare('INSERT INTO Asiakas (tunnus, salasana, nimi, email, osoite, puh) VALUES (:tunnus, :salasana, :nimi, :email, :osoite, :puh) RETURNING id');
      $query->execute(array('tunnus' => $this->tunnus, 'salasana' => $this->salasana, 'nimi' => $this->nimi, 'email' => $this->email, 'osoite' => $this->osoite, 'puh' => $this->puh));
      $row = $query->fetch();
      $this->id = $row['id'];
    }

    // Omien tietojen päivittäminen
    public function update(){
      $query = DB::connection()->prepare('UPDATE Asiakas SET tunnus = :tunnus, salasana = :salasana, nimi = :nimi, email = :email, osoite = :osoite, puh = :puh WHERE id = :id');
        $query->execute(array('id' => $this->id, 'tunnus' => $this->tunnus, 'salasana' => $this->salasana, 'nimi' => $this->nimi, 'email' => $this->email, 'osoite' => $this->osoite, 'puh' => $this->puh));
    }

    // Asiakastunnuksen poistaminen
    public function destroy(){
      $query = DB::connection()->prepare('DELETE FROM Asiakas WHERE id = :id');
      $query->execute(array('id' => $this->id));
    }

    // Asiakkaiden listaaminen
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

      public function onko_tunnusta($tunnus){
        $query = DB::connection()->prepare('SELECT * FROM Asiakas WHERE tunnus = :tunnus LIMIT 1');
        $query->execute(array('tunnus' => $tunnus));
        $row = $query->fetch();

        if($row){

          return true;
        }

        return false;
      }

      // ASIAKKAAN KIRJAUTUMINEN

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

      // VALIDOINTI

      public function validate_tunnus(){
        $errors = array();
        $errors = array_merge($errors, parent::validate_string_length('Käyttäjätunnus', $this->tunnus, 3, 20));

        if (BaseController::get_asiakas_logged_in()) {
          $kirjautunut = BaseController::get_asiakas_logged_in();
          if ($this->onko_tunnusta($this->tunnus)) {
            if ($kirjautunut->tunnus == $this->tunnus) {
              return $errors;
            } else {
              $errors[] = 'Tunnus on jo olemassa';
            }            
          }
          return $errors;
        } else {
          if ($this->onko_tunnusta($this->tunnus)) {
            $errors[] = 'Tunnus on jo olemassa';
          }

          return $errors;
        }
      }

      public function validate_salasana(){
        $errors = array();
        $errors = array_merge($errors, parent::validate_string_length('Salasana', $this->salasana, 3, 20));

      return $errors;
    }

      public function validate_nimi(){
        $errors = array();
        $errors = array_merge($errors, parent::validate_string_length('Nimi', $this->nimi, 2, 50));
        $errors = array_merge($errors, parent::validate_kirjaimet('Nimi', $this->nimi));

        return $errors;
      }

      public function validate_email(){
        $errors = array();
        $errors = array_merge($errors, parent::validate_string_length('E-mail', $this->email, 6, 50));

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
          $errors[] = 'Kirjoita e-mail oikeassa muodossa';
        }

        return $errors;
      }
      
      public function validate_osoite(){
        $errors = array();
        $errors = array_merge($errors, parent::validate_string_length('Toimitusosoite', $this->osoite, 15, 50));

        return $errors;
      }

      public function validate_puh(){
        $errors = array();
        $errors = array_merge($errors, parent::validate_string_length('Puh', $this->puh, 7, 20));

        if (preg_match("/[^0-9\+\-]/", $this->puh)) {
            $errors[] = 'Puhelinnumero sisälsi vääränlaisia merkkejä';
        }

        return $errors;
      }
	}