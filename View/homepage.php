<?php require 'includes/header.php' ?>
    <section>
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

                    <option value="<?php echo $customer['id']; ?>"><?php echo $customer['firstname'] ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="submit">
        </form>
        <h3><?php echo $calculatedPrice;?></h3>
    </section>

<?php require 'includes/footer.php'; ?>