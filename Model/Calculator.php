<?php


class Calculator
{
    private int $price;
    private int $fixDiscount;
    private int $varDiscount;

    public function __construct()
    {
       // $this->price = $price;
       // $this->fixDiscount = $fixDiscount;
       // $this->varDiscount = $varDiscount;
    }



    public function getPrice(): int
    {
        return $this->price;
    }


    public function setPrice(int $price): void
    {
        $this->price = $price;
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

    public function calculatePrice($pdo, $id){
        $itemPrice =20;
        $itemPrice -= $this->totalFixDiscount($pdo, $id);
        $itemPrice -= $this->maxVarDiscount($pdo, $id);
        return $itemPrice;
    }

    public function totalFixDiscount($pdo, $id){
        $fixDiscount = [];
        $customerLoader = new CustomerGroupLoader();
        foreach ($customerLoader->loadGroups($pdo, $id) as $group){
            $fixDiscount[] = $group["fixed_discount"];
        }
       return array_sum($fixDiscount);
    }

    public function maxVarDiscount ($pdo, $id)
    {
        $variableDiscount = [];
        $customerLoader = new CustomerGroupLoader();
        foreach($customerLoader->loadGroups($pdo, $id) AS $group){
            $variableDiscount[] =   $group["variable_discount"];
        }

        return max($variableDiscount);
    }


}