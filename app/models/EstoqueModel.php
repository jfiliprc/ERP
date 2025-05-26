<?php

namespace App\Models;

use App\Helpers\BaseModel;
use PDO;

class EstoqueModel extends BaseModel
{
    protected static $table = 'estoque';

    public static function getEstoqueWithVariacao()
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT estoque.*, variacoes.descricao AS variacao_descricao, produtos.nome AS produto_nome
                               FROM " . static::$table . "
                               INNER JOIN variacoes ON variacoes.id = estoque.variacao_id
                               INNER JOIN produtos ON produtos.id = variacoes.produto_id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public static function existsByVariacao(int $variacaoId, ?int $excludeId = null): bool
    {
        $pdo = self::getConnection();
        $sql = "SELECT COUNT(*) FROM " . static::$table . " WHERE variacao_id = :variacao_id";

        if ($excludeId) {
            $sql .= " AND id != :excludeId";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['variacao_id' => $variacaoId, 'excludeId' => $excludeId]);
        } else {
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['variacao_id' => $variacaoId]);
        }

        return $stmt->fetchColumn() > 0;
    }

    public static function subtrairEstoque(int $variacaoId, int $quantidade): bool
    {
        $pdo = self::getConnection();
        $sql = "UPDATE " . static::$table . "
            SET quantidade = quantidade - :quantidade
            WHERE variacao_id = :variacao_id AND quantidade >= :quantidade";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'quantidade' => $quantidade,
            'variacao_id' => $variacaoId
        ]);

        return $stmt->rowCount() > 0;
    }




}
