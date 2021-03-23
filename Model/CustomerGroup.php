<?php


class CustomerGroup
{

    private int $id;
    private string $name;
    private int $parentId;
    private int $fixDiscount;
    private int $varDiscount;

    public function __construct(int $id, string $name, int $parentId, int $fixDiscount, int $varDiscount)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getParentId(): int
    {
        return $this->parentId;
    }

    public function setParentId(int $parentId): void
    {
        $this->parentId = $parentId;
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