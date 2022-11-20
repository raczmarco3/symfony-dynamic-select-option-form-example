<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

Class Type
{
    #[Assert\NotBlank]
    protected $typeOfNumber;

    #[Assert\NotBlank]
    protected $number;    
    
    /**
     * Get the value of number
     */ 
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set the value of number
     *
     * @return  self
     */ 
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get the value of typeOfNumber
     */ 
    public function getTypeOfNumber()
    {
        return $this->typeOfNumber;
    }

    /**
     * Set the value of typeOfNumber
     *
     * @return  self
     */ 
    public function setTypeOfNumber($typeOfNumber)
    {
        $this->typeOfNumber = $typeOfNumber;

        return $this;
    }
}