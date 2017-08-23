<?php

require __DIR__ . '/vendor/autoload.php';

use Byte\User\Object as UserObject;
use Byte\User\ObjectInterface as UserObjectInterface;
use Byte\User\Validation as UserValidation;
use Byte\User\Output\CsvRow as UserOutputCsv;
use Byte\User\Output\OutputInterface as UserOutputInterface;
use Byte\DiContainer;

$di = new DiContainer(
    new PDO('mysql:host=localhost;dbname=database', 'username', 'password')
    , UserOutputCsv::class
);

$statement = $di->getDbl()->prepare('SELECT firstname, lastname, email, phone, country FROM new_users');
$statement->execute();

$outputClass = $di->getOutputClass();
/** @var UserObjectInterface $user */
while ($user = $statement->fetchObject(UserObject::class)) {
    // validate the User object data
    try {
        $validation = new UserValidation($user);
        $validation->validateAll();
    } catch(InvalidArgumentException $error) {
        echo $error->getMessage() . PHP_EOL;
        continue;
    }

    /** @var UserOutputInterface $output */
    $output = new $outputClass($user);
    $output->write();

    $statement = $di->getDbl()->prepare('DELETE FROM new_users WHERE email = ?');
    $statement->execute([$row['email']]);
}