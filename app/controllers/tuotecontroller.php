<?php
	require 'app/models/tuote.php';
	class TuoteController extends BaseController{
		public static function index(){
    		$tuotteet = Tuote::all();
    		View::make('suunnitelmat/tuotteet_yp.html', array('tuotteet' => $tuotteet));
  		}

	}