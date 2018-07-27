<?php

namespace validators;

class vAssoc implements iValidator
{

    public function isValid(&$var)
    {
        if (isset($var) && is_array($var) && array_diff_key($var,array_keys(array_keys($var))))
        {
            return true;
        }
        else
        {
           throw new \exceptions\ValidationException(VAR_NOT_ASSOC_VALIDATOR_ERROR); 
        }
    }
}
?>