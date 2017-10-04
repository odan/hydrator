<?php

namespace Odan\Test;

class SnakeCaseDto
{
    protected $firstName;
    protected $phone;
    protected $email;
    protected $streetNumberSuffix;

    public function get_first_name()
    {
        return $this->firstName;
    }

    public function set_first_name($firstName)
    {
        $this->firstName = $firstName;
    }

    public function get_phone()
    {
        return $this->phone;
    }

    public function set_phone($phone)
    {
        $this->phone = $phone;
    }

    public function set_email($email)
    {
        $this->email = $email;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function set_street_number_suffix($streetNumberSuffix)
    {
        $this->streetNumberSuffix = $streetNumberSuffix;
    }

    public function get_street_number_suffix()
    {
        return $this->streetNumberSuffix;
    }
}
