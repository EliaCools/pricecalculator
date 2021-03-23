<?php


class CustomerLoader
{

    public static function personaldiscount(PDO $pdo, int $id){
        $query = $pdo->prepare('select * from calculator.customer c where c.id =:id');
        $query->bindValue('id',$id);
        $query->execute();
        return $query->fetch();

    }




}