<?php

require __DIR__ . '/vendor/autoload.php';

use Byte\User\ObjectInterface as UserObjectInterface;
use Byte\User\Validation as UserValidation;
use Byte\User\Output\CsvRow as UserOutputCsv;
use Byte\User\Output\OutputInterface as UserOutputInterface;
use Byte\DiContainer;
use Byte\User\NewUserCollection;

$di = new DiContainer(
    new PDO('mysql:host=localhost;dbname=database', 'username', 'password')
    , UserOutputCsv::class
);

$collection = new NewUserCollection($di, function(UserObjectInterface $user, $index, DiContainer $di) {
    // validate the row
    try {
        $validation = new UserValidation($user);
        $validation->validateAll();
    } catch(InvalidArgumentException $error) {
        echo $error->getMessage() . PHP_EOL;
        return;
    }

    // write output
    /** @var UserOutputInterface $output */
    $outputClass = $di->getOutputClass();
    $output = new $outputClass($user);
    $output->write();

    $statement = $di->getDbl()->prepare('DELETE FROM new_users WHERE email = ?');
    $statement->execute([$row['email']]);
});

$collection->processNewUsers();