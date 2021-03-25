<?php require 'includes/header.php' ?>
    <section class="min-vh-100" >
        <div class="d-flex justify-content-center p-1">
        <form method="post" class="form-inline">
            <select class="custom-select mr-sm-1" name="productid">
                <option disabled selected value>    select a product  </option>
                <?php foreach ($products as $product):
                    var_dump($products); ?>
                    <option value="<?php echo $product['id']; ?>"><?php echo $product['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <select class="custom-select mr-sm-1" name="customerid">
                <option disabled selected value> select a person  </option>
                <?php foreach ($customers as $customer): ?>

                    <option value="<?php echo $customer['id']; ?>"><?php echo $customer['name']  ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="submit" class="btn btn-primary mb-2">
        </form>
        </div >
        <div class="d-flex justify-content-center p-1" >
        <h3><?php echo $singleCustomer["name"] . $message . $calculatedPrice . $messagep2 . $singleProduct["name"];?></h3>
        <p><?php echo $error;?></p>
        </div>
    </section>

<?php require 'includes/footer.php'; ?>