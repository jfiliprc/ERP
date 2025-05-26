<?php

namespace App\Models;

use App\Helpers\BaseModel;

class PedidoModel extends BaseModel
{
    protected static $table = 'pedidos';

    public static function createPedido(array $data): int
    {
        $id = parent::create($data);
        return (int) $id;
    }

    public static function createItensPedido(int $pedidoId, array $itens): void
    {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("INSERT INTO pedido_itens (pedido_id, variacao_id, quantidade, preco_unitario) VALUES (:pedido_id, :variacao_id, :quantidade, :preco_unitario)");

        foreach ($itens as $item) {
            $stmt->execute([
                ':pedido_id' => $pedidoId,
                ':variacao_id' => $item['variacao_id'],
                ':quantidade' => $item['quantidade'],
                ':preco_unitario' => $item['valor'],
            ]);
        }
    }

    public static function getAllWithDetails()
    {
        $pdo = self::getConnection();

        $sql = "SELECT 
                p.id, p.status, p.total, p.frete, p.endereco, p.cep,
                ip.quantidade, ip.preco_unitario,
                pr.nome AS produto_nome,
                v.descricao AS variacao_nome
            FROM pedidos p
            JOIN pedido_itens ip ON ip.pedido_id = p.id
            JOIN variacoes v ON ip.variacao_id = v.id
            JOIN produtos pr ON v.produto_id = pr.id
            ORDER BY p.id DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }


    public static function updateStatus(int $id, string $status): bool
    {
        $pdo = self::getConnection();

        $sql = "UPDATE pedidos SET status = :status WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([':status' => $status, ':id' => $id]);
    }

}
