<?php
// @toDo felicia endprice mirror = 0     mousepad ->   (double checked) buddy endprice -> 40.49

class Calculator
{
    private int $price;
    private int $fixDiscount;
    private int $varDiscount;
    public const MAGIC_DIVIDER = 100;

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
   // @toDo functie klopt (ong)
    public function totalFixDiscount($pdo, $customer)
    {
        $fixDiscount = [];
        $customerLoader = new CustomerGroupLoader();
        foreach ($customerLoader->loadGroups($pdo, $customer->getGroupId()) as $group) {
            if(!is_null($group["fixed_discount"])) {
                $fixDiscount[] = $group["fixed_discount"];
            }
        }
        return array_sum($fixDiscount);
    }

   // public function maxFixDiscount($pdo, $customer)
   // {
   //     $fixDiscount = [];
   //     $customerLoader = new CustomerGroupLoader();
   //     foreach ($customerLoader->loadGroups($pdo, $customer->getGroupId()) as $group) {
   //         if(!is_null($group["fixed_discount"])) {
   //             $fixDiscount[] = $group["fixed_discount"];
   //         }
   //     }
   //     return max($fixDiscount);
   // }
    // @toDo basic array klopt
    public function maxGroupVarDis($pdo, $customer): int
    {
        $variableDiscount = [];
        $customerLoader = new CustomerGroupLoader();
        foreach ($customerLoader->loadGroups($pdo, $customer->getGroupId()) as $group) {
            if(!is_null($group["variable_discount"])){
             $variableDiscount[] = $group["variable_discount"];
            }

        }
        if(empty($variableDiscount)){
            return 0;
        }
        return max($variableDiscount);
    }


    public function percentIsHighestGroup($pdo, $product, $customer): bool
    {

        $productPrice = (float)$product->getPrice() / self::MAGIC_DIVIDER;

        $percentDiscount = $this->maxGroupVarDis($pdo, $customer);
        $fixedDiscount = $this->totalFixDiscount($pdo, $customer);

        $percentInDecimal = $percentDiscount / self::MAGIC_DIVIDER;


            $fixedFromPrice = $productPrice - $fixedDiscount;

            $percentFromPrice = $productPrice - ($productPrice * $percentInDecimal);



        var_dump($fixedFromPrice);
        var_dump($percentFromPrice);

        if ($percentFromPrice < $fixedFromPrice) {
            return true;
        } else {
            return false;
        }
    }

// @toDo felicia endprice mirror = 0     mousepad ->   (double checked) buddy endprice -> 40.49
    public function checkCustomerDiscount($pdo, Product $product, Customer $customer)
    {
        $fixedDiscount = (int)$customer->getFixDiscount();
        $cusVarDis = $customer->getVarDiscount();
        $productPrice = (float)$product->getPrice() / self::MAGIC_DIVIDER;


        if ($this->percentIsHighestGroup($pdo, $product, $customer) === true) {
            if ($cusVarDis > $this->maxGroupVarDis($pdo, $customer)) {
                $percentDiscount = $cusVarDis;
                $percentInDecimal = (float)$percentDiscount / self::MAGIC_DIVIDER;

                if (!is_null($fixedDiscount)) {
                    $priceMinFixed = $productPrice - $fixedDiscount;

                } else {
                    $priceMinFixed = $productPrice;
                }
                $totalPrice = $priceMinFixed - ($priceMinFixed * $percentInDecimal);

            } else {
                $percentDiscount = $this->maxGroupVarDis($pdo, $customer);
                $percentInDecimal = (float)$percentDiscount / self::MAGIC_DIVIDER;

                if (!is_null($fixedDiscount)) {
                    $priceMinFixed = $productPrice - $fixedDiscount;

                } else {
                    $priceMinFixed = $productPrice;
                }
                $totalPrice = $priceMinFixed - ((float)$percentInDecimal * $priceMinFixed);
            }
        }

        if ($this->percentIsHighestGroup($pdo, $product, $customer) === false) {
            if (!is_null($fixedDiscount)) {
                $totalPrice = $productPrice - ($fixedDiscount + $this->totalFixDiscount($pdo, $customer));

            } else {
                $percentDiscount = $cusVarDis;
                $percentInDecimal = (float)$percentDiscount / self::MAGIC_DIVIDER;
                $priceMinFixed = $productPrice - $this->totalFixDiscount($pdo, $customer);
                $totalPrice = $priceMinFixed - ((float)$percentInDecimal * $percentInDecimal);
                var_dump($fixedDiscount);
            }

        }
        if ($totalPrice < 0){
            $totalPrice = 0;
        }
        return $totalPrice;
    }

    public function comparePercentage($pdo, $id, $firstName, $lastName, $groupId, $fixDiscount, $varDiscount)
    {
        $customerDiscount = new Customer($id, $firstName, $lastName, $groupId, $fixDiscount, $varDiscount);
        $customervarDiscount = $customerDiscount->getVarDiscount();
        return max($customervarDiscount, $this->maxGroupVarDis($pdo, $groupId));
    }
}