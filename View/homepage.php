<?php require 'includes/header.php' ?>
    <section class="d-flex justify-content-center p-1">
        <form method="post">
            <select name="productid">
                <option disabled selected value> -- select an option -- </option>
                <?php foreach ($products as $product):
                    var_dump($products); ?>
                    <option value="<?php echo $product['id']; ?>"><?php echo $product['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <select name="customerid">
                <option disabled selected value> -- select an option -- </option>
                <?php foreach ($customers as $customer): ?>

                    <option value="<?php echo $customer['id']; ?>"><?php echo $customer['name']  ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="submit">
        </form>
        <h3><?php echo $singleCustomer["name"] . $message . $calculatedPrice . $messagep2 . $singleProduct["name"];?></h3>
        <p><?php echo $error;?></p>
    </section>

<?php require 'includes/footer.php'; ?>