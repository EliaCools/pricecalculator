<?php
declare(strict_types=1);

class Customer
{
    private int $id;
    private string $name;
    private int $groupId;
    private int $fixDiscount;
    private int $varDiscount;


    public function __construct(int $id, string $name, int $groupId, int $fixDiscount, int $varDiscount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->groupId = $groupId;
        $this->fixDiscount = $fixDiscount;
        $this->varDiscount = $varDiscount;
    }




    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getGroupId(): int
    {
        return $this->groupId;
    }

    public function setGroupId(int $groupId): void
    {
        $this->groupId = $groupId;
    }

    public function getFixDiscount(): int
    {
        return $this->fixDiscount;
    }

    public function setFixDiscount(int $fixDiscount): void
    {
        $this->fixDiscount = $fixDiscount;
    }

    public function getVarDiscount(): int
    {
        return $this->varDiscount;
    }

    public function setVarDiscount(int $varDiscount): void
    {
        $this->varDiscount = $varDiscount;
    }




}