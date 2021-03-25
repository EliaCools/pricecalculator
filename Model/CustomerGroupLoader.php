<?php


class CustomerGroupLoader
{

    public function loadGroup(PDO $pdo, int $id): array
    {
        $query = $pdo->prepare('SELECT * FROM customer_group WHERE id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function loadGroups(PDO $pdo, int $id): array
    {
        $groups = [];
        $groups[] = $this->loadGroup($pdo, $id);

        while (!is_null(end($groups)["parent_id"])) {
            $groups[] = $this->loadGroup($pdo, end($groups)["parent_id"]);
        }
        return $groups;
    }
}