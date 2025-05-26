<?php

namespace App\Models;

use App\Helpers\BaseModel;
use PDO;

class VariacaoModel extends BaseModeL
{
    protected static $table = 'variacoes';
    public static function findByProductId($id)
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM " . static::$table .
            "
            INNER JOIN produtos ON produtos.id = variacoes.produto_id
            WHERE variacoes.produto_id = ?
            ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findWithProductById(int $id): ?array
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("
        SELECT variacoes.*, produtos.nome AS produto_nome
        FROM variacoes
        INNER JOIN produtos ON produtos.id = variacoes.produto_id
        WHERE variacoes.id = :id
    ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }



    public static function findById(int $id): ?array
    {
        $pdo = self::getConnection();
        $sql = "
        SELECT v.*, COALESCE(e.quantidade, 0) as estoque
        FROM variacoes v
        LEFT JOIN estoque e ON e.variacao_id = v.id
        WHERE v.id = :id
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }

    public static function getVariationsWithProducts()
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT variacoes.*, produtos.nome FROM " . static::$table .
            "
            INNER JOIN produtos ON produtos.id = variacoes.produto_id
            ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function existsByProdutoAndDescricao(int $produtoId, string $descricao, ?int $excludeId = null): bool
    {
        $pdo = self::getConnection();
        $sql = "SELECT COUNT(*) FROM " . static::$table . " WHERE produto_id = :produto_id AND descricao = :descricao";

        if ($excludeId) {
            $sql .= " AND id != :excludeId";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'produto_id' => $produtoId,
                'descricao' => $descricao,
                'excludeId' => $excludeId,
            ]);
        } else {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                'produto_id' => $produtoId,
                'descricao' => $descricao,
            ]);
        }

        return $stmt->fetchColumn() > 0;
    }

}
