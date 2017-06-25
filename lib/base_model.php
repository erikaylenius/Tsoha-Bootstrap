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

    public function validate_string_length($kentta, $string, $min, $max){
      $errors = array();
      if($string == '' || $string == null){
        $errors[] = $kentta . '-kentän merkkijono ei saa olla tyhjä.';
      }
      if(strlen($string) < $min){
        $errors[] = $kentta . '-kentän merkkijonon pituuden on oltava yli ' . $min . ' merkkiä.';
      }

      if(strlen($string) > $max){
        $errors[] = $kentta . '-kentän merkkijono oli liian pitkä.';
      }

      return $errors;
    }

    public function validate_kirjaimet($kentta, $string) {
        $errors = array();
        if (preg_match("/[^A-Za-z\å\ä\ö\Å\Ä\Ö\' '\-]/", $string)) {
            $errors[] = $kentta . "-kenttä sisälsi vääränlaisia merkkejä.";
        }
        return $errors;
    }



  }
