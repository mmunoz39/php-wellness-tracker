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
	
	// GET /measurements/new
    public function newMeasurement(): string
    {
        return $this->view->render('add_measurement.twig');
    }

    // POST /measurements
    public function createMeasurement(): string
    {
        // Minimal validation (no auth for demo)
        $type = $_POST['type'] ?? '';
        $value = $_POST['value'] ?? '';
        $date = $_POST['measuredAt'] ?? '';

        if ($type === '' || $value === '' || $date === '') {
            http_response_code(400);
            return $this->view->render('add_measurement.twig', [
                'error' => 'All fields are required.'
            ]);
        }

        if (!preg_match('/^(weight|steps|sleep_hours)$/', $type)) {
            http_response_code(400);
            return $this->view->render('add_measurement.twig', [
                'error' => 'Invalid type.'
            ]);
        }

        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            http_response_code(400);
            return $this->view->render('add_measurement.twig', [
                'error' => 'Invalid date format (YYYY-MM-DD).'
            ]);
        }

        $val = (float)$value;
        if (!is_finite($val)) {
            http_response_code(400);
            return $this->view->render('add_measurement.twig', [
                'error' => 'Invalid numeric value.'
            ]);
        }

        // Save
        $repo = new \App\Repositories\MeasurementRepository($this->db);
        $repo->create(new \App\Models\Measurement(
            id: null,
            userId: 1,
            type: $type,
            value: $val,
            measuredAt: $date
        ));

        // Simple success message (could redirect)
        return $this->view->render('add_measurement.twig', [
            'success' => 'Measurement saved successfully!'
        ]);
    }
}
