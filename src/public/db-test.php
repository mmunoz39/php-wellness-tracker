<?php
declare(strict_types=1);

$host = 'db';
$db   = 'wellness';
$user = 'app';
$pass = 'app';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ]);
    $count = (int)$pdo->query('SELECT COUNT(*) FROM measurements')->fetchColumn();
    header('Content-Type: text/plain; charset=utf-8');
    echo "DB connection OK. measurements count = {$count}\n";
} catch (Throwable $e) {
    http_response_code(500);
    header('Content-Type: text/plain; charset=utf-8');
    echo "DB connection ERROR: " . $e->getMessage();
}
