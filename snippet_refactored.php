<?php

require __DIR__ . '/vendor/autoload.php';

$pdo = new PDO('mysql:host=localhost;dbname=database', 'username', 'password');

$handle = fopen('data.csv', 'wb+');

$statement = $pdo->prepare('SELECT firstname, lastname, email, phone, country FROM new_users');
$statement->execute();

while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    if (
        !strlen($row['firstname']) ||
        !strlen($row['lastname']) ||
        !filter_var($row['email'], FILTER_VALIDATE_EMAIL) ||
        !filter_var($row['phone'], FILTER_VALIDATE_INT) ||
        strlen($row['country'])!==2
    ) {
        continue;
    }

    fputcsv($handle, [
        $row['firstname'] . ' ' . $row['lastname'],
        $row['country'],
        $row['email'],
        $row['phone'],
    ], ';', '""');

    $statement = $pdo->prepare('DELETE FROM new_users WHERE email = ?');
    $statement->execute([$row['email']]);
}

fclose($handle);