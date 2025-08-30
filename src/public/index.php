<?php
declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use App\Bootstrap;

$boot = new Bootstrap();

// Simple router
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';

if ($path === '/' || $path === '/hello') {
    echo $boot->view->render('hello.twig', ['message' => 'Wellness Tracker is alive! (Twig)']);
    exit;
}

http_response_code(404);
header('Content-Type: text/plain; charset=utf-8');
echo "Not Found";

