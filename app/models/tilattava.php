<?php

	class Tilattava extends BaseModel{
		public $id, $tilaus_id, $tuote_id, $lkm;

		public function __construct($attributes){
			parent::__construct($attributes);

		}

		public function save(){
      $query = DB::connection()->prepare('INSERT INTO Tilatut (tilaus_id, tuote_id, lkm) VALUES (:tilaus_id, :tuote_id, :lkm)');
      $query->execute(array('tilaus_id' => $this->tilaus_id, 'tuote_id' => $this->tuote_id, 'lkm' => $this->lkm));
      //$row = $query->fetch();
      //$this->id = $row['id'];
		}

/*
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
        		'kuvaus' => $row['kuvaus'],
        		'varastosaldo' => $row['varastosaldo'],
        		'halytyssaldo' => $row['halytyssaldo'],
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
        			'kuvaus' => $row['kuvaus'],
        			'varastosaldo' => $row['varastosaldo'],
        			'halytyssaldo' => $row['halytyssaldo'],
      			));

      		return $tuote;
    		}

    	return null;
  		}
*/


	}