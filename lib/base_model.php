<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
      // Käydään assosiaatiolistan avaimet läpi
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
        $validator_errors = $this->{$validator}();
        $errors = array_merge($errors, $validator_errors);
      }

      return $errors;
    }

    public function validate_int($field, $int) {
      $errors = array();
      if(!is_int($int)) {
        $errors[] = 'Et syöttänyt kokonaislukua.';
      }
      if($int < 1) {
        $errors[] = 'Pienin sallittu lukumäärä on 1.';
      }
      return $errors;
    }

    public function validate_string_length($string, $length){
      $errors = array();
      if($string == '' || $string == null){
        $errors[] = 'Merkkijono ei saa olla tyhjä.';
      }
      if(strlen($string) < 2){
        $errors[] = 'Merkkijonon pituuden on oltava yli 2 merkkiä.';
      }

      if(strlen($string) < $length){
        $errors[] = 'Merkkijono oli liian pitkä.';
      }

      return $errors;
    }



  }
