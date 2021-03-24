<?php


class ProductLoader
{
    public function getProduct(PDO $pdo, int $id):? array
    {
        $query = $pdo->prepare('SELECT * FROM product WHERE product.id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        return $query->fetch();
    }

    public  function getProducts(PDO $pdo): array
    {
        $query = $pdo->query('SELECT * FROM product');
        return $query->fetchAll();
    }
}

