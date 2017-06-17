<?php

	class Tuote extends BaseModel{
		public $id, $nimike, $hinta, $kuvaus, $varastosaldo, $halytyssaldo;

		public function __construct($attributes){
			parent::__construct($attributes);
		}

		public function save(){
      $query = DB::connection()->prepare('INSERT INTO Tuote (nimike, hinta, kuvaus, varastosaldo, halytyssaldo) VALUES (:nimike, :hinta, :kuvaus, :varastosaldo, :halytyssaldo) RETURNING id');
      $query->execute(array('nimike' => $this->nimike, 'hinta' => $this->hinta, 'kuvaus' => $this->kuvaus, 'varastosaldo' => $this->varastosaldo, 'halytyssaldo' => $this->halytyssaldo));
      $row = $query->fetch();
      $this->id = $row['id'];


		}

    public function update(){
      /*
      $query = DB::connection()->prepare('UPDATE Tuote SET (nimike, hinta, kuvaus, varastosaldo, halytyssaldo) VALUES (:nimike, :hinta, :kuvaus, :varastosaldo, :halytyssaldo) RETURNING id');
      $query->execute(array('nimike' => $this->nimike, 'hinta' => $this->hinta, 'kuvaus' => $this->kuvaus, 'varastosaldo' => $this->varastosaldo, 'halytyssaldo' => $this->halytyssaldo));
      $row = $query->fetch();
      $this->id = $row['id'];
      */
      $query = DB::connection()->prepare('UPDATE Tuote SET nimike = :nimike, hinta = :hinta, kuvaus = :kuvaus, varastosaldo = :varastosaldo, halytyssaldo = :halytyssaldo WHERE id = :id');
            $query->execute(array('nimike' => $this->nimike, 'hinta' => $this->hinta, 'kuvaus' => $this->kuvaus, 'varastosaldo' => $this->varastosaldo, 'halytyssaldo' => $this->halytyssaldo));
                  $row = $query->fetch();
      $this->id = $row['id'];
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

      // Validointi

      public function validate_nimike(){
        $errors = array();
        if($this->nimike == '' || $this->nimike == null){
        $errors[] = 'Nimike-kenttä oli tyhjä.';
      }

      if(strlen($this->nimike) < 2){
        $errors[] = 'Nimike-kentän pituuden tulee olla yli 2 merkkiä.';
      }

      if(strlen($this->nimike) > 20){
        $errors[] = 'Nimike-kentän pituus saa olla korkeintaan 20 merkkiä.';
      }


      return $errors;
}

	}