<?php

namespace Odan\Test;

class CamelCaseDto
{
    protected $firstName;
    protected $phone;
    protected $email;
    protected $streetNumberSuffix;

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setStreetNumberSuffix($streetNumberSuffix)
    {
        $this->streetNumberSuffix = $streetNumberSuffix;
    }

    public function getStreetNumberSuffix()
    {
        return $this->streetNumberSuffix;
    }
}
