<?php

namespace Odan\Test;

class ExampleDto
{
	protected $firstName;
	protected $phone;
	protected $email;
	protected $address;

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

	public function getAddress()
	{
		return $this->address;
	}

	public function setFirstName($firstName)
	{
		$this->firstName = $firstName;
	}

	public function setPhone($phone)
	{
		$this->phone = $phone;
	}

	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function setAddress($address)
	{
		$this->address = $address;
	}
}
