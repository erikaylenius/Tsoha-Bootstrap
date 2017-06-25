<?php

	class Tuote extends BaseModel{
		public $id, $nimike, $hinta, $kuvaus;

		public function __construct($attributes){
			parent::__construct($attributes);

      $this->validators = array('validate_nimike', 'validate_hinta', 'validate_kuvaus');
		}

		public function save(){
      $query = DB::connection()->prepare('INSERT INTO Tuote (nimike, hinta, kuvaus) VALUES (:nimike, :hinta, :kuvaus) RETURNING id');
      $query->execute(array('nimike' => $this->nimike, 'hinta' => $this->hinta, 'kuvaus' => $this->kuvaus));
      $row = $query->fetch();
      $this->id = $row['id'];
		}

    public function update(){

      $query = DB::connection()->prepare('UPDATE Tuote SET nimike = :nimike, hinta = :hinta, kuvaus = :kuvaus WHERE id = :id');
      $query->execute(array('id' => $this->id, 'nimike' => $this->nimike, 'hinta' => $this->hinta, 'kuvaus' => $this->kuvaus));
    }

    public function destroy(){
      $query = DB::connection()->prepare('DELETE FROM Tuote WHERE id = :id');
      $query->execute(array('id' => $this->id));
    }

		public static function all(){
    
    		$query = DB::connection()->prepare('SELECT * FROM Tuote');
    		$query->execute();
    		$rows = $query->fetchAll();
   			$tuotteet = array();

   			foreach($rows as $row){
      			$tuotteet[] = new Tuote(array(
        		'id' => $row['id'],
        		'nimike' => $row['nimike'],
        		'hinta' => $row['hinta'],
        		'kuvaus' => $row['kuvaus']
      			));
    		}
    		return $tuotteet;
   		}

   		public static function find($id){
    		$query = DB::connection()->prepare('SELECT * FROM Tuote WHERE id = :id LIMIT 1');
    		$query->execute(array('id' => $id));
    		$row = $query->fetch();

    		if($row){
      			$tuote = new Tuote(array(
        			'id' => $row['id'],
        			'nimike' => $row['nimike'],
        			'hinta' => $row['hinta'],
        			'kuvaus' => $row['kuvaus']
      			));

      		return $tuote;
    		}

    	return null;
  		}

      // Validointi

      public function validate_nimike(){
        $errors = array();
        $errors = array_merge($errors, parent::validate_string_length('Nimike', $this->nimike, 2, 50));

      return $errors;
    }

    public function validate_hinta(){
      $errors = array();
      if(!is_numeric($this->hinta)){
        $errors[] = 'Ilmoita hinta numerona, käytä desimaalierottimena pistettä.';
      }  
        return $errors;    
    }

    public function validate_kuvaus(){
      $errors = array();
      $errors = array_merge($errors, parent::validate_string_length('Kuvaus', $this->kuvaus, 2, 200));

      return $errors;
    }

	}