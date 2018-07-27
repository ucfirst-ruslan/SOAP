<?php

namespace validators;

class vStrExp extends vStrLength implements iValidator
{
    private $exp;

    public function __construct()
    {
        parent::__construct();
        #$this->exp='/^[A-Za-z0-9_-\s]+/';
        $this->exp='/(.|\n)*/';
    }


    public function isValid(&$variable)
    {
        if (parent::isValid($variable) && false !== preg_match($this->getExp(), $variable))
        {
            return true;
        }
        else
        {
           throw new \exceptions\ValidationException(EXP_VALIDATOR_ERROR.' '.$variable); 
        }
    }

    public function getExp()
    {
        return $this->exp;
    }

    public function setExp($exp)
    {
        $this->exp = $exp;
    }
}
?>