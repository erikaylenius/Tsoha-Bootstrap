<?php

	class Tuote extends BaseModel{
		public $id, $nimike, $hinta, $kuvaus, $varastosaldo, $halytyssaldo;

		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public function save(){
			$query = DB::connection()->prepare('INSERT INTO Tuote VALUES ($this->id, $this->nimike, $this->hinta, $this->kuvaus, $this->varastosaldo, $this->halytyssaldo)');
			$query->execute;
		}

    public function update(){
      $query = DB::connection()->prepare('UPDATE Tuote VALUES ($this->id, $this->nimike, $this->hinta, $this->kuvaus, $this->varastosaldo, $this->halytyssaldo)');
      $query->execute;
    }

    public function destroy(){
      $query = DB::connection()->prepare('DESTROY Tuote VALUES ($this->id, $this->nimike, $this->hinta, $this->kuvaus, $this->varastosaldo, $this->halytyssaldo)');
      $query->execute;
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



	}