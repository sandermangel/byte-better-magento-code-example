<?php

require __DIR__ . '/vendor/autoload.php';

use Byte\User\Object as UserObject;

$pdo = new PDO('mysql:host=localhost;dbname=database', 'username', 'password');

$handle = fopen('data.csv', 'wb+');

$statement = $pdo->prepare('SELECT firstname, lastname, email, phone, country FROM new_users');
$statement->execute();

/** @var UserObject $user */
while ($user = $statement->fetchObject(UserObject::class)) {
    if (
        !strlen($user->getFirstname()) ||
        !strlen($user->getLastname()) ||
        !filter_var($user->getEmail(), FILTER_VALIDATE_EMAIL) ||
        !filter_var($user->getPhone(), FILTER_VALIDATE_INT) ||
        strlen($user->getCountry())!==2
    ) {
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