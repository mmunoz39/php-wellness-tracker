<?php
declare(strict_types=1);

namespace App\Repositories;

use PDO;
use App\Models\Measurement;

final class MeasurementRepository
{
    public function __construct(private PDO $db) {}

    /** @return Measurement[] */
    public function allForUser(int $userId): array
    {
        $stmt = $this->db->prepare(
            "SELECT id, user_id, type, value, measured_at
             FROM measurements
             WHERE user_id = :uid
             ORDER BY measured_at DESC, id DESC"
        );
        $stmt->execute(['uid' => $userId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

        return array_map(fn(array $r) => new Measurement(
            id: isset($r['id']) ? (int)$r['id'] : null,
            userId: (int)$r['user_id'],
            type: (string)$r['type'],
            value: (float)$r['value'],
            measuredAt: (string)$r['measured_at'],
        ), $rows);
    }
	
	    public function create(Measurement $m): int
    {
        $sql = "INSERT INTO measurements (user_id, type, value, measured_at)
                VALUES (:user_id, :type, :value, :measured_at)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'user_id'    => $m->userId,
            'type'       => $m->type,
            'value'      => $m->value,
            'measured_at'=> $m->measuredAt,
        ]);
        return (int)$this->db->lastInsertId();
    }

}
