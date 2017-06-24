<?php

	class Tilaus extends BaseModel{
		public $id, $asiakas_id, $loppusumma, $maksettu, $pvm;

		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public function save(){
      		$query = DB::connection()->prepare('INSERT INTO Tilaus (asiakas_id, loppusumma, maksettu, pvm) VALUES (:asiakas_id, :loppusumma, :maksettu, :pvm) RETURNING id');
      		$query->execute(array('asiakas_id' => $this->asiakas_id, 'loppusumma' => $this->loppusumma, 'maksettu' => $this->maksettu, 'pvm' => $this->pvm));
      		$row = $query->fetch();
      		$this->id = $row['id'];
    	}

    	public function update(){
      		$query = DB::connection()->prepare('UPDATE Tilaus SET asiakas_id = :asiakas_id, loppusumma = :loppusumma, maksettu = :maksettu, pvm = :pvm WHERE id = :id');
            $query->execute(array('id' => $this->id, 'asiakas_id' => $this->asiakas_id, 'loppusumma' => $this->loppusumma, 'maksettu' => $this->maksettu, 'pvm' => $this->pvm));
    }

    	public static function all(){
    
    		$query = DB::connection()->prepare('SELECT * FROM Tilaus');
    		$query->execute();
    		$rows = $query->fetchAll();
   			$tilaukset = array();

   			foreach($rows as $row){
      			$tilaukset[] = new Asiakas(array(
        		'id' => $row['id'],
            'asiakas_id' => $row['asiakas_id'],
        		'loppusumma' => $row['loppusumma'],
        		'maksettu' => $row['maksettu'],
        		'pvm' => $row['pvm'],
      			));
    		}

    		return $tilaukset;
   		}

	}