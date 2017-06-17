<?php

	class Asiakas extends BaseModel{
		public $id, $tunnus, $salasana, $nimi, $email, $osoite, $puh, $tilauskielto;

		public function __construct($attributes){
			parent::__construct($attributes);
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
        		'puh' => $row['puh'],
            'tilauskielto' => $row['tilauskielto']
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
              'puh' => $row['puh'],
              'tilauskielto' => $row['tilauskielto']
            ));

      		return $asiakas;
    		}

    	return null;
  		}


	}