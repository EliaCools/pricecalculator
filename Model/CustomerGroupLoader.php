<?php


class CustomerGroupLoader
{
    public function loadGroup(PDO $pdo, $id){
        $query = $pdo->prepare('select * FROM calculator.customer_group where id = :id');
        $query->bindValue('id',$id);
        $query->execute();
        return $query->fetch();
    }

    public static function loadGroups(PDO $pdo, $id){
        $loader = new self();
        $groups = [];
        $groups = $loader->loadGroup( $pdo, $id );

        while(!is_null(end($groups)["parent_id"])){
            $groups =  $loader ->loadGroup($pdo,end($groups)["parent_id"]);
        }
        return $groups;
    }

}