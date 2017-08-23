<?php

require __DIR__ . '/vendor/autoload.php';

use Byte\User\Object as UserObject;
use Byte\User\ObjectInterface as UserObjectInterface;
use Byte\User\Validation as UserValidation;

$pdo = new PDO('mysql:host=localhost;dbname=database', 'username', 'password');

$handle = fopen('data.csv', 'wb+');

$statement = $pdo->prepare('SELECT firstname, lastname, email, phone, country FROM new_users');
$statement->execute();

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

    fputcsv($handle, [
        $user->getFirstname() . ' ' . $user->getLastname(),
        $user->getCountry(),
        $user->getEmail(),
        $user->getPhone(),
    ], ';', '""');

    $statement = $pdo->prepare('DELETE FROM new_users WHERE email = ?');
    $statement->execute([$row['email']]);
}

fclose($handle);