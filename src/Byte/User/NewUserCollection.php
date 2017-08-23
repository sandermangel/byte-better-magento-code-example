<?php

namespace Byte\User;

use Byte\DiContainer;
use Byte\User\Object as UserObject;

class NewUserCollection
{
    private $di;
    private $rowCallback;

    /**
     * NewUserCollection constructor.
     * @param DiContainer $di
     * @param callable $rowCallback
     */
    public function __construct(DiContainer $di, callable $rowCallback)
    {
        $this->di = $di;
        $this->rowCallback = $rowCallback;
    }

    public function processNewUsers()
    {
        $statement = $this->di->getDbl()->prepare('SELECT firstname, lastname, email, phone, country FROM new_users');
        $statement->execute();

        // get all rows as a user object instance
        $results = $statement->fetchAll(\PDO::FETCH_CLASS, UserObject::class);
        // walk results and perform callback method
        array_walk($results, $this->rowCallback, $this->di);
    }
}