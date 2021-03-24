<?php


class CustomerLoader
{

    public function singleCustomer(PDO $pdo, int $id){
        $query = $pdo->prepare('select * from customer c where c.id =:id');
        $query->bindValue('id',$id);
        $query->execute();
        return $query->fetch();
    }

    public function allCustomers(PDO $pdo){
        $query = $pdo->prepare('select * from customer c');
        $query->execute();
        return $query->fetchAll();
    }




}