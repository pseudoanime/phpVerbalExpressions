<?php

class Expression
{
    protected $regex = '';

    public static function make()
    {
        return new static;
    }

    public function __toString()
    {
        return $this->getRegex();
    }

    public function getRegex()
    {
        return '/' . $this->regex . '/';
    }

    public function find($value)
     {
         return $this->add($this->sanitize($value));
     }

     public function then($value)
     {
         return $this->find($value);
     }

     public function anything()
     {
         return $this->add(".*");
     }

    public function maybe($value)
    {
        return $this->add("(?:" . $this->sanitize($value) . ")?");
    }

    public function test($value)
    {
        return (bool)preg_match($this->getRegex(), $value);
    }

    protected function add($value)
    {
        $this->regex .= $value;

        return $this;
    }

    protected function sanitize($value)
    {
       return preg_quote($value, "/");
    }

    public function anythingBut($value)
    {
       return $this->add("(?!" .$this->sanitize($value). ").*?");
    }
}