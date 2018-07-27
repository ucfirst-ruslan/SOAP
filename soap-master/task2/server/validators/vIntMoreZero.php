<?php

namespace validators;

class vIntMoreZero implements iValidator
{

    public function isValid(&$variable)
    {
        if (isset($variable) && is_int($variable) && 0<$variable)
        {
            return true;
        }
        else
        {
           throw new \exceptions\ValidationException(INT_VALIDATOR_VALUE_ERROR); 
        }
    }
}
?>