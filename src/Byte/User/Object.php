<?php

namespace Byte\User;

use Byte\User\ObjectInterface as UserObjectInterface;

class Object implements UserObjectInterface
{
    private $varFirstname;
    private $varLastname;
    private $varEmail;
    private $varPhone;
    private $varCountry;

    /**
     * Setter to hydrate an object
     *
     * Normally I would prefer using the constructor to make the object immutable
     * but PDO won't work with that.
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value)
    {
        $name = 'var' . ucfirst($name);
        $this->$name = $value;
    }

    /**
     * User first name
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->varFirstname;
    }

    /**
     * User lastname
     * @return string
     */
    public function getLastname(): string
    {
        return $this->varLastname;
    }

    /**
     * User email address
     * @return string
     */
    public function getEmail(): string
    {
        return $this->varEmail;
    }

    /**
     * User phone number
     * @return string
     */
    public function getPhone(): string
    {
        return $this->varPhone;
    }

    /**
     * User country code
     * @return string
     */
    public function getCountry(): string
    {
        return $this->varCountry;
    }
}