<?php

namespace Byte\User;

class Object
{
    private $firstname;
    private $lastname;
    private $email;
    private $phone;
    private $country;

    /**
     * Instantiate the User Object
     *
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $phone
     * @param string $country
     */
    public function __construct(string $firstname, string $lastname, string $email, string $phone, string $country)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}