<?php

namespace Byte\User\Output;

use Byte\User\ObjectInterface as UserObjectInterface;

interface OutputInterface
{

    /**
     * Write a userobject to a CSV as row
     *
     * @param UserObjectInterface $user
     */
    public function __construct(UserObjectInterface $user);

    /**
     * Write to given csv destination
     *
     * @throws \InvalidArgumentException
     */
    public function write();
}