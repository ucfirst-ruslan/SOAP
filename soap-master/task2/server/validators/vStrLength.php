<?php

namespace validators;


class vStrLength implements iValidator
{
    private $min;
    private $max;
    private $intValidator;

    public function __construct()
    {
        $this->intValidator = new vIntMoreZero();
        $this->setMin(1);
        $this->setMax(5000);
    }

    public function isValid(&$variable)
    {  
        if (isset($variable) && is_string($variable) 
            && $this->getMin() <= strlen($variable) && $this->getMax() >= strlen($variable) )
        {
            return true;
        }
        else
        {
           throw new \exceptions\ValidationException(STR_LEN_VALIDATOR_ERROR.' '.$variable); 
        }   
    }

    public function getMin()
    {
        if (isset($this->min))
        {
            return $this->min;
        }
        else
        {
           throw new \exceptions\ValidationException(STR_VALIDATOR_MIN_VOID_ERROR); 
        }        
    }

    public function setMin($min)
    {
        try
        {
            $this->intValidator->isValid($min);
            $this->min = $min;
        }
        catch(\exceptions\ValidationException $e)
        {
           throw new \exceptions\ValidationException(STR_VALIDATOR_MIN_ERROR.$min.' '.$e->getMessage()); 
		}

		return $this;
    }
 
    public function getMax()
    {
        if (isset($this->max))
        {
            return $this->max;
        }
        else
        {
           throw new \exceptions\ValidationException(STR_VALIDATOR_MAX_VOID_ERROR); 
        }   
    }

    public function setMax($max)
    {
        try
        {
            $this->intValidator->isValid($max);
            $this->max = $max;
        }
        catch(\exceptions\ValidationException $e)
        {
           throw new \exceptions\ValidationException(STR_VALIDATOR_MAX_ERROR.$max.' '.$e->getMessage()); 
		}

		return $this;
    }
}
?>
