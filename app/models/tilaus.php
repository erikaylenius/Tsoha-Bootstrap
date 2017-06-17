<?php

	class Tilaus extends BaseModel{
		public $id, $asiakas_id, $loppusumma, $maksettu;

		public function __construct($attributes){
			parent::__construct($attributes);
		}


	}