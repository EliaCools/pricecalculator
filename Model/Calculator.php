<?php

class Calculator
{
    private int $price;
    private int $fixDiscount;
    private int $varDiscount;
    public const MAGIC_DIVIDER = 100;

//    public function __construct($price,$fixDiscount,$varDiscount)
//    {
//         $this->price = $price;
//         $this->fixDiscount = $fixDiscount;
//         $this->varDiscount = $varDiscount;
//    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getFixDiscount(): int
    {
        return $this->fixDiscount;
    }

    public function getVarDiscount(): int
    {
        return $this->varDiscount;
    }

    public function totalFixDiscount(PDO $pdo, Customer $customer): int
    {
        $fixDiscount = [];
        $customerLoader = new CustomerGroupLoader();
        foreach ($customerLoader->loadGroups($pdo, $customer->getGroupId()) as $group) {
            if (!is_null($group["fixed_discount"])) {
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
    public function maxGroupVarDis(PDO $pdo, Customer $customer): int
    {
        $variableDiscount = [];
        $customerLoader = new CustomerGroupLoader();
        foreach ($customerLoader->loadGroups($pdo, $customer->getGroupId()) as $group) {
            if (!is_null($group["variable_discount"])) {
                $variableDiscount[] = $group["variable_discount"];
            }
        }
        if (empty($variableDiscount)) {
            return 0;
        }
        return max($variableDiscount);
    }

    public function percentIsHighestGroup(PDO $pdo, Product $product, Customer $customer): bool
    {
        $productPrice = (float)$product->getPrice() / self::MAGIC_DIVIDER;

        $discountPercentage = $this->maxGroupVarDis($pdo, $customer);
        $percentInDecimal = $discountPercentage / self::MAGIC_DIVIDER;

        $totalFixedDiscount = $this->totalFixDiscount($pdo, $customer);

        $priceMinusFixed = $productPrice - $totalFixedDiscount;
        $priceMinusPercentage = $productPrice - ($productPrice * $percentInDecimal);

        if ($priceMinusPercentage < $priceMinusFixed) {
            return true;
        }
        return false;
    }

    public function checkCustomerDiscount(PDO $pdo, Product $product, Customer $customer): float
    {
        $customerFixedDiscount = $customer->getFixDiscount();
        $customerDiscountPercentage = $customer->getVarDiscount();
        $productPrice = (float)$product->getPrice() / self::MAGIC_DIVIDER;

        if ($this->percentIsHighestGroup($pdo, $product, $customer) === true) {
            if ($customerDiscountPercentage > $this->maxGroupVarDis($pdo, $customer)) {
                $percentInDecimal = (float)$customerDiscountPercentage / self::MAGIC_DIVIDER;

                if (!is_null($customerFixedDiscount)) {
                    $priceMinusFixed = $productPrice - $customerFixedDiscount;

                } else {
                    $priceMinusFixed = $productPrice;
                }
                $totalPrice = $priceMinusFixed - ($priceMinusFixed * $percentInDecimal);

            } else {
                $discountPercentage = $this->maxGroupVarDis($pdo, $customer);
                $percentInDecimal = (float)$discountPercentage / self::MAGIC_DIVIDER;

                if (!is_null($customerFixedDiscount)) {
                    $priceMinusFixed = $productPrice - $customerFixedDiscount;

                } else {
                    $priceMinusFixed = $productPrice;
                }
                $totalPrice = $priceMinusFixed - ((float)$percentInDecimal * $priceMinusFixed);
            }
        }

        if ($this->percentIsHighestGroup($pdo, $product, $customer) === false) {
            if (!is_null($customerFixedDiscount)) {
                $percentInDecimal = (float)$customerDiscountPercentage / self::MAGIC_DIVIDER;

                $priceMinusFixed = $productPrice - ($customerFixedDiscount + $this->totalFixDiscount($pdo, $customer));
                $totalPrice = $priceMinusFixed - ((float)$percentInDecimal * $priceMinusFixed);

            } else {
                $percentInDecimal = (float)$customerDiscountPercentage / self::MAGIC_DIVIDER;

                $priceMinusFixed = $productPrice - $this->totalFixDiscount($pdo, $customer);
                $totalPrice = $priceMinusFixed - ((float)$percentInDecimal * $priceMinusFixed);
            }
        }
        if ($totalPrice < 0) {
            $totalPrice = 0;
        }
        return round($totalPrice, 2);
    }
}