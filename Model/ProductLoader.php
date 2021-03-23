<?php


class ProductLoader
{
    public static function getProduct(PDO $pdo, int $id):? array
    {
        $query = $pdo->prepare('SELECT * FROM product WHERE product.id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        return $query->fetch();
    }

    public static function getProducts(PDO $pdo): array
    {
        $query = $pdo->query('SELECT * FROM product');
        return $query->fetchAll();
    }
}