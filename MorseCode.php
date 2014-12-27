<?php

class MorseCode {
  static private $table =[
    "a"=>".-",
    "b"=>"-...",
    "c"=>"-.-.",
    "d"=>"-..",
    "e"=>".",
    "f"=>"..-.",
    "g"=>"--.",
    "h"=>"....",
    "i"=>"..",
    "j"=>".---",
    "k"=>"-.-",
    "l"=>".-..",
    "m"=>"--",
    "n"=>"-.",
    "o"=>"---",
    "p"=>".--.",
    "q"=>"--.-",
    "r"=>".-.",
    "s"=>"...",
    "t"=>"-",
    "u"=>"..-",
    "v"=>"...-",
    "w"=>".--",
    "x"=>"-..-",
    "y"=>"-.--",
    "z"=>"--..",
    " "=>"-."
  ];
  
  static function convert($string){
    $out="";
    foreach(str_split($string) as $char) {
      if(isset(self::$table[$char]))
        $out.=self::$table[$char];
    }
    return $out;
  }
}
