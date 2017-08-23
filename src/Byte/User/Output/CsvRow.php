<?php

namespace Byte\User\Output;

use Byte\User\Output\OutputInterface as UserOutputInterface;
use Byte\User\ObjectInterface as UserObjectInterface;

class CsvRow implements UserOutputInterface
{
    private $user;

    /**
     * Write a userobject to a CSV as row
     *
     * @param UserObjectInterface $user
     */
    public function __construct(UserObjectInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Write to given csv destination
     *
     * @throws \InvalidArgumentException
     */
    public function write()
    {
        $handle = fopen('data.csv', 'wb+');

        // write to output
        fputcsv($handle, [
            $this->user->getFirstname() . ' ' . $this->user->getLastname(),
            $this->user->getCountry(),
            $this->user->getEmail(),
            $this->user->getPhone(),
        ], ';', '""');

        fclose($handle);
    }
}