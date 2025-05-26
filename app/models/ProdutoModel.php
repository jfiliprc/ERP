<?php

namespace App\Models;

use App\Helpers\BaseModel;

class ProdutoModel extends BaseModeL
{
    protected static $table = 'produtos';

    public static function existsByName(string $nome, ?int $excludeId = null): bool
    {
        $pdo = self::getConnection();
        $sql = "SELECT COUNT(*) FROM " . static::$table . " WHERE nome = :nome";

        // Se for para update, excluir o próprio registro atual da contagem
        if ($excludeId) {
            $sql .= " AND id != :excludeId";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['nome' => $nome, 'excludeId' => $excludeId]);
        } else {
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['nome' => $nome]);
        }

        return $stmt->fetchColumn() > 0;
    }

    public static function findById(int $id): ?array
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM " . static::$table . " WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
    }


    public static function getProductsWithVariations(): array
    {
        $pdo = self::getConnection();

        $sql = "
        SELECT 
            p.id AS produto_id, p.nome AS produto_nome, p.valor AS produto_valor,
            v.id AS variacao_id, v.descricao AS variacao_descricao,
            COALESCE(e.quantidade, 0) AS variacao_estoque
        FROM " . static::$table . " p
        LEFT JOIN variacoes v ON v.produto_id = p.id
        LEFT JOIN estoque e ON e.variacao_id = v.id
        ORDER BY p.id, v.id
    ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $produtos = [];

        foreach ($rows as $row) {
            $produtoId = $row['produto_id'];

            if (!isset($produtos[$produtoId])) {
                $produtos[$produtoId] = [
                    'id' => $produtoId,
                    'nome' => $row['produto_nome'],
                    'valor' => $row['produto_valor'],
                    'variacoes' => []
                ];
            }

            if ($row['variacao_id'] !== null) {
                $produtos[$produtoId]['variacoes'][] = [
                    'id' => $row['variacao_id'],
                    'descricao' => $row['variacao_descricao'],
                    'estoque' => (int) $row['variacao_estoque']
                ];
            }
        }

        return array_values($produtos);
    }



}


