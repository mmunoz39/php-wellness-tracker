<?php
declare(strict_types=1);

namespace App\Models;

final class Measurement
{
    public function __construct(
        public ?int $id,
        public int $userId,
        public string $type,     // e.g., 'weight'
        public float $value,
        public string $measuredAt // 'YYYY-MM-DD'
    ) {}
}
