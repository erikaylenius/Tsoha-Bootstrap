<?php

	class Tilattava extends BaseModel{
		public $id, $tilaus_id, $tuote_id, $lkm;

		public function __construct($attributes){
			parent::__construct($attributes);

		}

		public function save(){
      $query = DB::connection()->prepare('INSERT INTO Tilattava (tilaus_id, tuote_id, lkm) VALUES (:tilaus_id, :tuote_id, :lkm) RETURNING id');
      $query->execute(array('tilaus_id' => $this->tilaus_id, 'tuote_id' => $this->tuote_id, 'lkm' => $this->lkm));
      $row = $query->fetch();
      $this->id = $row['id'];

      $_SESSION['tilattavat'][] = $this->id;


		}

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

      /*
      public static function tilatut($tilaus_id){
    
        $query = DB::connection()->prepare('SELECT * FROM Tilattava WHERE tilaus_id = :tilaus_id');
        $query->execute(array('tilaus_id' => $tilaus_id));
        $rows = $query->fetchAll();
        $tilatut = array();

        foreach($rows as $row){
            $tilatut[] = new Tilattava(array(
            'id' => $row['id'],
            'tilaus_id' => $row['tilaus_id'],
            'tuote_id' => $row['tuote_id'],
            'lkm' => $row['lkm'],
            ));
        }

        return $tilatut;
      } */

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

      /*
                public static function all(){
    
        $query = DB::connection()->prepare('SELECT Tilaus.id, Tilaus.asiakas_id, Tilaus.loppusumma, Tilaus.pvm, Asiakas.nimi AS asiakas_nimi FROM Tilaus INNER JOIN Asiakas ON Tilaus.asiakas_id = Asiakas.id');
        $query->execute();
        $rows = $query->fetchAll();
        $tilaukset = array();

        foreach($rows as $row){
            $tilaukset[] = array(
    
                  'id' => $row['id'],
                    'asiakas_id' => $row['asiakas_id'],
                  'loppusumma' => $row['loppusumma'],
                  'pvm' => $row['pvm'],
                  'asiakas_nimi' => $row['asiakas_nimi']
                
              );
        }

        return $tilaukset;
      }
      */



	}