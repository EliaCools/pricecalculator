<?php


class CustomerLoader
{

    public function singleCustomer(PDO $pdo, int $id)
    {
        $query = $pdo->prepare('SELECT id, concat_ws(" ", c.firstname, c.lastname) AS name , group_id , fixed_discount, variable_discount FROM customer c WHERE c.id =:id');
        $query->bindValue('id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function allCustomers(PDO $pdo)
    {
        $query = $pdo->prepare('SELECT id, concat_ws(" ", c.firstname, c.lastname) AS name , group_id , fixed_discount, variable_discount FROM customer c');
        $query->execute();
        return $query->fetchAll();
    }
}