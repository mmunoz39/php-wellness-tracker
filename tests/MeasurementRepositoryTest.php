<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Repositories\MeasurementRepository;
use App\Models\Measurement;

final class MeasurementRepositoryTest extends TestCase
{
    private PDO $db;

    protected function setUp(): void
    {
        // SQLite in-memory DB for fast tests
        $this->db = new PDO('sqlite::memory:');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->db->exec(<<<SQL
            CREATE TABLE measurements (
              id INTEGER PRIMARY KEY AUTOINCREMENT,
              user_id INT NOT NULL,
              type TEXT NOT NULL,
              value REAL NOT NULL,
              measured_at TEXT NOT NULL
            );
        SQL);
    }

    public function testCreateAndList(): void
    {
        $repo = new MeasurementRepository($this->db);

        $id = $repo->create(new Measurement(
            id: null,
            userId: 1,
            type: 'weight',
            value: 80.5,
            measuredAt: '2025-08-30'
        ));

        $this->assertGreaterThan(0, $id);
        $rows = $repo->allForUser(1);
        $this->assertCount(1, $rows);
        $this->assertSame('weight', $rows[0]->type);
        $this->assertSame(80.5, $rows[0]->value);
        $this->assertSame('2025-08-30', $rows[0]->measuredAt);
    }
}
