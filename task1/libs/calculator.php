<?php

class Calculator
{
    protected $a;
    protected $b;
    protected $mem;
    protected $error;

    /**
     * Set.
     * @param int $a
     * @param int $b
     * @param int $mem
     */
    public function setDate($a = 0, $b = 0, $mem = 0)
    {
        if (is_int($a) && is_int($b) && is_int($mem))
        {
            $this->a = $a;
            $this->b = $b;
            $this->mem = $mem;
        } else
        {
            $this->error = SET_NUM_ERROR;
        }
    }

    /**
     * Get Error
     * @return bool|string
     */
    public function getError()
    {
        if (!empty($this->error))
            return $this->error;
        else
            return false;
    }

    /**
     * Sum
     * @return int
     */
    public function summ()
    {
        return $this->a + $this->b;
    }

    /**
     * Subtraction
     * @return int
     */
    public function sub()
    {
        return ($this->a - $this->b);
    }

    /**
     * Division
     * @return float|int|string
     */
    public function div()
    {
        if (0 < $this->a)
        {
            return $this->a / $this->b;
        } else
        {
            return DIVISION_ERROR;
        }
    }

    /**
     * Multiplication
     * @return int
     */
    public function multi()
    {
        return $this->a * $this->b;
    }

    /**
     * Square
     * @return float
     */
    public function square()
    {
        return sqrt($this->a);
    }

    /**
     * Division One
     * @return float|int|string
     */
    public function divOne()
    {
        if (0 < $this->a)
        {
            return 1 / $this->a;
        } else
        {
            return DIVISION_ONE_ERROR;
        }
    }

    /**
     * Percent
     * @return float|int
     */
    public function percent()
    {
        return $this->a / 100 * $this->b;
    }

    /**
     * Memory Add
     *
     * @param int $mem
     * @return int
     */
    public function memAdd($mem = 0)
    {
        return $this->mem += $mem;
    }

    /**
     * Memory Subtraction
     *
     * @param int $mem
     * @return int
     */
    public function memSub($mem = 0)
    {
        return $this->mem -= $mem;
    }

    /**
     * Memory Show
     * @return int
     */
    public function memShow()
    {
        return $this->mem;
    }

    /**
     * Memory set to zero
     * @return int
     */
    public function memClean()
    {
        return $this->mem = 0;
    }
}
