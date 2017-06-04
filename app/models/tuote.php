<?php

	class Tuote extends BaseModel{
		public $id, $hinta, $kuvaus, $varastosaldo, $halytyssaldo;

		public function __construct($attributes){
			parent::__construct($attributes);
		}
	}