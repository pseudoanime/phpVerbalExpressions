<?php

class Expression
{
     protected $regex='';

     public static function make()
     {
         return new static;
     }

     public function __toString()
     {
         return "/" . $this->regex . "/";
     }

     public function find($value)
     {
         $this->regex .= $value;

         return $this;
     }

     public function then($value)
     {
         return $this->find($value);
     }

     public function anything()
     {
         $this->regex .= ".*";

         return $this;
     }

    public function maybe($value)
    {
        $value = preg_quote($value,"/");

        $this->regex .= "(" . $value . ")?";

        return $this;
    }

    public function test($value)
    {
        return (bool)preg_match($this->__toString(), $value);
    }
}