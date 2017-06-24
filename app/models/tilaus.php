<?php

	class Tilaus extends BaseModel{
		public $id, $asiakas_id, $loppusumma, $pvm;

		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public function save(){
      		$query = DB::connection()->prepare('INSERT INTO Tilaus (asiakas_id, loppusumma, pvm) VALUES (:asiakas_id, :loppusumma, :pvm) RETURNING id');
      		$query->execute(array('asiakas_id' => $this->asiakas_id, 'loppusumma' => $this->loppusumma, 'pvm' => $this->pvm));
      		$row = $query->fetch();
      		$this->id = $row['id'];

      		foreach($_SESSION['tilattavat'] as $tilattava){
        		$lisattava = Tilattava::find($tilattava);

        		$lisattava->liita_tilaukseen($this->id);
    		
    	}

    }

    	public function update(){
      		$query = DB::connection()->prepare('UPDATE Tilaus SET asiakas_id = :asiakas_id, loppusumma = :loppusumma, maksettu = :maksettu, pvm = :pvm WHERE id = :id');
            $query->execute(array('id' => $this->id, 'asiakas_id' => $this->asiakas_id, 'loppusumma' => $this->loppusumma, 'maksettu' => $this->maksettu, 'pvm' => $this->pvm));
    }

        public function lisaa_loppusummaan($id){

      		$query = DB::connection()->prepare('UPDATE Tilaus SET loppusumma = :loppusumma WHERE id = :id');
            $query->execute(array('id' => $this->id, 'loppusumma' => $id));
    }

    	/*
    	public static function all(){
    
    		$query = DB::connection()->prepare('SELECT * FROM Tilaus');
    		$query->execute();
    		$rows = $query->fetchAll();
   			$tilaukset = array();

   			foreach($rows as $row){
      			$tilaukset[] = new Tilaus(array(
        		'id' => $row['id'],
            'asiakas_id' => $row['asiakas_id'],
        		'loppusumma' => $row['loppusumma'],
        		'pvm' => $row['pvm'],
      			));
    		}

    		return $tilaukset;
   		}
   		*/

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



   		public static function omat($asiakas_id){
    
    		$query = DB::connection()->prepare('SELECT * FROM Tilaus WHERE asiakas_id = :asiakas_id');
    		$query->execute(array('asiakas_id' => $asiakas_id));
    		$rows = $query->fetchAll();
   			$tilaukset = array();

   			foreach($rows as $row){
      			$tilaukset[] = new Tilaus(array(
        		'id' => $row['id'],
            'asiakas_id' => $row['asiakas_id'],
        		'loppusumma' => $row['loppusumma'],
        		'pvm' => $row['pvm'],
      			));
    		}

    		return $tilaukset;
   		}

	}