<?php

namespace App\Models;

use App\Helpers\BaseModel;
use PDO;

class CupomModel extends BaseModel
{
    protected static $table = 'cupons';

    public static function getCupomValido(string $codigo, float $subtotal): ?array
    {
        $pdo = self::getConnection();
        $sql = "SELECT * FROM cupons WHERE codigo = :codigo AND validade >= CURDATE() AND valor_minimo <= :subtotal LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'codigo' => $codigo,
            'subtotal' => $subtotal,
        ]);

        $cupom = $stmt->fetch(PDO::FETCH_ASSOC);

        return $cupom ?: null;
    }

    public static function existsByCode(string $codigo, ?int $excludeId = null): bool
    {
        $pdo = self::getConnection();
        $sql = "SELECT COUNT(*) FROM " . static::$table . " WHERE codigo = :codigo";

        if ($excludeId) {
            $sql .= " AND id != :excludeId";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['codigo' => $codigo, 'excludeId' => $excludeId]);
        } else {
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['codigo' => $codigo]);
        }

        return $stmt->fetchColumn() > 0;
    }
}
