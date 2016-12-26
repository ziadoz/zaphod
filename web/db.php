<?php
$config = [
    'database' => getenv('MYSQL_DATABASE'),
    'host'     => 'database',
    'username' => getenv('MYSQL_USER'),
    'password' => getenv('MYSQL_PASSWORD'),
];

$pdo = new PDO(
    'mysql:dbname=' . $config['database'] . ';host=' . $config['host'],
    $config['username'],
    $config['password']
);
