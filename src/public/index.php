<?php
declare(strict_types=1);

require __DIR__ . '/../../vendor/autoload.php';

use App\Bootstrap;
use App\Controllers\HealthController;

$boot = new Bootstrap();
$ctrl = new HealthController($boot->db, $boot->view);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';

switch ($path) {
    case '/':
    case '/hello':
        echo $boot->view->render('hello.twig', ['message' => 'Wellness Tracker is alive! (Twig)']);
        break;

    case '/api/measurements':
        echo $ctrl->listMeasurements();
        break;

    case '/dashboard':
        echo $ctrl->dashboard();
        break;

	case '/measurements/new':            // NEW: show form
        echo $ctrl->newMeasurement();
        break;

    case '/measurements':                // NEW: handle POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo $ctrl->createMeasurement();
            break;
        }
        http_response_code(405);
        header('Allow: POST');
        echo 'Method Not Allowed';
        break;

    default:
        http_response_code(404);
        header('Content-Type: text/plain; charset=utf-8');
        echo "Not Found";
}


