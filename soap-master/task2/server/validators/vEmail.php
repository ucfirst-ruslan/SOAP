<?php

namespace validators;

class vEmail extends vStrExp implements iValidator
{
    public function __construct()
    {
        parent::__construct();
        $this->setMin(7);
        $this->setMax(50);
        $this->setExp('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/');
    }

    public function isValid(&$variable)
    {
        try
        {
            parent::isValid($variable);
        }
        catch(\exceptions\ValidationException $e)
        {
            throw new \exceptions\ValidationException(EMAIL_VALIDATOR_ERROR.' '.$variable);
        }

        return true;       
    }
}
?>