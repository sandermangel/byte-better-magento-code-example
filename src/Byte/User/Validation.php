<?php

namespace Byte\User;

class Validation
{
    private $user;

    /**
     * Validate data in a user object
     *
     * @param ObjectInterface $user
     */
    public function __construct(ObjectInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Validate all values in the user object
     *
     * @throws \InvalidArgumentException
     */
    public function validateAll()
    {
        if ($this->user->getFirstname() === '') {
            throw new \InvalidArgumentException('Firstname should be at least 1 character long');
        }
        if ($this->user->getLastname() === '') {
            throw new \InvalidArgumentException('Lastname should be at least 1 character long');
        }
        if (!filter_var($this->user->getEmail(), FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Email address does not appear to be valid');
        }
        if (!filter_var($this->user->getPhone(), FILTER_VALIDATE_INT)) {
            throw new \InvalidArgumentException('Phone number should be numeric');
        }
        if (strlen($this->user->getCountry())!==2) {
            throw new \InvalidArgumentException('Country should be a ISO2 code');
        }
    }
}