<?php


class ProductLoader
{
    public function getProduct(PDO $pdo, int $id): Product
    {
        $query = $pdo->prepare('SELECT * FROM product WHERE product.id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        $raw = $query->fetch();
        return new Product($raw['id'],$raw['name'],$raw["price"]);
    }

    public function getProducts(PDO $pdo): array
    {
        $query = $pdo->query('SELECT * FROM product');
        return $query->fetchAll();
    }
}

