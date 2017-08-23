<?php

namespace Byte\User;

interface ObjectInterface
{
    /**
     * User first name
     * @return string
     */
    public function getFirstname(): string;

    /**
     * User lastname
     * @return string
     */
    public function getLastname(): string;

    /**
     * User email address
     * @return string
     */
    public function getEmail(): string;

    /**
     * User phone number
     * @return string
     */
    public function getPhone(): string;

    /**
     * User country code
     * @return string
     */
    public function getCountry(): string;
}