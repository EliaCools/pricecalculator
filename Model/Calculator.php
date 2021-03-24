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

    }

    public function totalFixDiscount($pdo, $customer){
        $fixDiscount = [];
        $customerLoader = new CustomerGroupLoader();
        foreach ($customerLoader->loadGroups($pdo, $customer->getGroupId()) as $group){
            $fixDiscount[] = $group["fixed_discount"];
        }
       return array_sum($fixDiscount);
    }

       public function maxFixDiscount($pdo, $customer){
        $fixDiscount = [];
        $customerLoader = new CustomerGroupLoader();
        foreach ($customerLoader->loadGroups($pdo, $customer->getGroupId()) as $group){
            $fixDiscount[] = $group["fixed_discount"];
        }
       return max($fixDiscount);
    }



    public function maxVarDiscount ($pdo, $customer) : int
    {
        $variableDiscount = [];
        $customerLoader = new CustomerGroupLoader();
        foreach($customerLoader->loadGroups($pdo, $customer->getGroupId()) AS $group){
            $variableDiscount[] =   $group["variable_discount"];
        }
        return max($variableDiscount);
    }





    public function percentIsHighestGroup($pdo, $product, $customer)
    {
        $productLoader = new ProductLoader();
        //$product = new Product($id,$name, $price);
        $product = $productLoader->getProduct($pdo, $product->getId());
        $productPrice = (int)$product["price"]/100;

        $percentDiscount = $this->maxVarDiscount($pdo,$customer);
        $fixedDiscount= $this->totalFixDiscount($pdo,$customer);
        $percentInDecimal = $percentDiscount/100;

        $percentFromPrice = $productPrice * $percentInDecimal;
        $fixedFromPrice = $productPrice-$fixedDiscount;

        if($percentFromPrice>$fixedFromPrice){
            return true;
        }else{
            return false;
        }

    }

    public function checkCustomerDiscount($pdo, $product, $customer){
        $fixedDiscount = (int)$customer->getFixDiscount();
        $varDiscount = $customer->getVarDiscount();
        $productPrice = $product->getPrice()/100;


     if($this->percentIsHighestGroup($pdo,$product,$customer) ===true){


             if($varDiscount>$this->maxVarDiscount($pdo,$customer)){
                 $percentDiscount = $varDiscount;
                 $percentInDecimal = $percentDiscount/100;

                 if(!is_null($fixedDiscount)){
                     $priceMinFixed = $productPrice - $fixedDiscount ;
                 }else{
                     $priceMinFixed= $productPrice;
                 }
                  $totalPrice = $priceMinFixed * $percentInDecimal;

                  var_dump($totalPrice);

             }else{

                 $percentDiscount = $this->maxVarDiscount($pdo,$customer);
                 $percentInDecimal = $percentDiscount/100;
                 $priceMinFixed = $productPrice;
                 $totalPrice =    $priceMinFixed * $percentInDecimal;
                 var_dump($totalPrice);
             }

         }

     if($this->percentIsHighestGroup($pdo,$product,$customer) ===false){
         //$fixedDiscount + $this->maxFixDiscount($pdo, $customer);
         var_dump($productPrice);

     }
    }






    public function comparePercentage($pdo,$id,$firstName,$lastName,$groupId,$fixDiscount,$varDiscount){
        $customerDiscount = new Customer($id,$firstName,$lastName,$groupId,$fixDiscount,$varDiscount);

        $customervarDiscount= $customerDiscount->getVarDiscount();

        return max($customervarDiscount,$this->maxVarDiscount($pdo,$groupId));
    }

}