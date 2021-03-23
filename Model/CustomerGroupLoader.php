<?php


class CustomerGroupLoader
{


    public function loadGroup(PDO $pdo, $id){
        $query = $pdo->prepare('select * FROM calculator.customer_group where id = :id');
        $query->bindValue('id',$id);
        $query->execute();
        return $query->fetch();
    }



      public  function loadGroups(PDO $pdo, $id){
          $groups = [];
          $groups[]  = $this->loadGroup( $pdo, $id );

          while(!is_null(end($groups)["parent_id"])){
            $groups[] =  $this ->loadGroup($pdo,end($groups)["parent_id"]);
          }
          return $groups;
      }


}