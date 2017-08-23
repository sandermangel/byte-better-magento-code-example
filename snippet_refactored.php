<?php

require __DIR__ . '/vendor/autoload.php';

use Byte\User\ObjectInterface as UserObjectInterface;
use Byte\User\Validation as UserValidation;
use Byte\User\Output\CsvRow as UserOutputCsv;
use Byte\User\Output\OutputInterface as UserOutputInterface;
use Byte\User\Delete as DeleteUser;
use Byte\DiContainer;
use Byte\User\NewUserCollection;

$di = new DiContainer(
    new PDO('mysql:host=localhost;dbname=database', 'username', 'password')
    , UserOutputCsv::class
);

// We could also move the anonymous function to it's own class or method
// but just for demo purposes I'll leave it in here
$collection = new NewUserCollection($di, function(UserObjectInterface $user, $index, DiContainer $di) {
    // validate the row
    try {
        (new UserValidation($user))();
    } catch(InvalidArgumentException $error) {
        echo $error->getMessage() . PHP_EOL;
        return;
    }

    // write output
    /** @var UserOutputInterface $output */
    $outputClass = $di->getOutputClass();
    $output = new $outputClass($user);
    $output->write();

    (new DeleteUser($user, $di))();
});

$collection->processNewUsers();