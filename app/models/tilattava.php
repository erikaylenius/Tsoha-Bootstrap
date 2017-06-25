<?php

	class Tilattava extends BaseModel{
		public $id, $tilaus_id, $tuote_id, $lkm;

		public function __construct($attributes){
			parent::__construct($attributes);

      $this->validators = array('validate_lkm');
		}

		public function save(){
      $query = DB::connection()->prepare('INSERT INTO Tilattava (tilaus_id, tuote_id, lkm) VALUES (:tilaus_id, :tuote_id, :lkm) RETURNING id');
      $query->execute(array('tilaus_id' => $this->tilaus_id, 'tuote_id' => $this->tuote_id, 'lkm' => $this->lkm));
      $row = $query->fetch();
      $this->id = $row['id'];

      $_SESSION['tilattavat'][] = $this->id;

		}


    // Kun luodaan uusi tilaus, päivitetään samalla Tilattava-olion tilaus_id ja yhdistetään Tilattava kyseiseen tilaukseen.
    public function liita_tilaukseen($id){

      $query = DB::connection()->prepare('UPDATE Tilattava SET tilaus_id = :tilaus_id WHERE id = :id');
            $query->execute(array('id' => $this->id, 'tilaus_id' => $id));
    }

    public static function find($id){
      $query = DB::connection()->prepare('SELECT * FROM Tilattava WHERE id = :id LIMIT 1');
      $query->execute(array('id' => $id));
      $row = $query->fetch();

      if($row){
          $tilattava = new Tilattava(array(
            'id' => $row['id'],
            'tilaus_id' => $row['tilaus_id'],
            'tuote_id' => $row['tuote_id'],
            'lkm' => $row['lkm'],
          ));

          return $tilattava;
        }

      return null;
      }


    // Lukumäärän validointi

      public function validate_lkm() {
      $errors = array();
      if(!is_numeric($this->lkm)) {
        $errors[] = 'Et syöttänyt lukua.';
      }

      if($this->lkm < 1) {
        $errors[] = 'Sinun on tilattava vähintään 1 kpl.';
      }
      return $errors;
    }

    // Tiettyyn tilaukseen liittyvien tuotteiden listaaminen
    public static function tilatut($tilaus_id){
    
      $query = DB::connection()->prepare('SELECT Tilattava.id, Tilattava.tilaus_id, Tilattava.tuote_id, Tilattava.lkm, Tuote.nimike as tuote_nimike FROM Tilattava LEFT JOIN Tuote ON Tilattava.tuote_id = Tuote.id WHERE tilaus_id = :tilaus_id');
        $query->execute(array('tilaus_id' => $tilaus_id));
        $rows = $query->fetchAll();
        $tilatut = array();

      foreach($rows as $row){
        $tilatut[] = array(
          'id' => $row['id'],
          'tilaus_id' => $row['tilaus_id'],
          'tuote_id' => $row['tuote_id'],
          'lkm' => $row['lkm'],
          'tuote_nimike' => $row['tuote_nimike']
        );
      }

      return $tilatut;
    }

	}