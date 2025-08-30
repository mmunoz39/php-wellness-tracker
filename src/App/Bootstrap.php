<?php
declare(strict_types=1);

namespace App;

use PDO;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class Bootstrap
{
    public PDO $db;
    public Environment $view;

    public function __construct()
    {
        // DB (MySQL in Docker)
        $dsn = 'mysql:host=db;dbname=wellness;charset=utf8mb4';
        $this->db = new PDO($dsn, 'app', 'app', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        ]);

        // Twig views
        $loader = new FilesystemLoader(__DIR__ . '/../public/views');
        $this->view = new Environment($loader);
    }
}
