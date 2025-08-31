<?php
declare(strict_types=1);

namespace App\Controllers;

use PDO;
use Twig\Environment;
use App\Repositories\MeasurementRepository;

final class HealthController
{
    public function __construct(private PDO $db, private Environment $view) {}

    // GET /api/measurements
    public function listMeasurements(): string
    {
        $repo = new MeasurementRepository($this->db);
        $data = $repo->allForUser(1);
        $json = array_map(fn($m) => [
            'id' => $m->id,
            'type' => $m->type,
            'value' => $m->value,
            'measuredAt' => $m->measuredAt,
        ], $data);

        header('Content-Type: application/json; charset=utf-8');
        return json_encode($json, JSON_UNESCAPED_UNICODE);
    }

    // GET /dashboard
    public function dashboard(): string
    {
        return $this->view->render('dashboard.twig');
    }
}
