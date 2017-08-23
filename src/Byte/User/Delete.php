<?php

namespace Byte\User;

use Byte\DiContainer;
use Byte\User\ObjectInterface as UserObjectInterface;

class Delete
{
    private $user;
    private $di;

    /**
     * set the userobject to delete in the database
     *
     * @param UserObjectInterface $user
     * @param DiContainer $di
     */
    public function __construct(UserObjectInterface $user, DiContainer $di)
    {
        $this->user = $user;
        $this->di = $di;
    }

    /**
     * Execute the delete query
     */
    public function __invoke()
    {
        $statement = $this->di->getDbl()->prepare('DELETE FROM new_users WHERE email = ?');
        $statement->execute([$this->user->getEmail()]);
    }
}