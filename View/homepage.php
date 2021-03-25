<?php require 'includes/header.php' ?>
    <section class="d-flex justify-content-center p-1">
        <form method="post">
            <select name="productId">
                <option disabled selected value> -- select an option --</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['id']; ?>"><?php echo $product['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <select name="customerId">
                <option disabled selected value> -- select an option --</option>
                <?php foreach ($customers as $customer): ?>
                    <option value="<?php echo $customer['id']; ?>"><?php echo $customer['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" name="submit">
        </form>
        <?php if (isset($customerMessage)): ?>
            <h3><?php echo $singleCustomer["name"] . " has to pay &euro; " . $calculatedPrice . " for a(n) " . $singleProduct['name']; ?></h3>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <p><?php echo $error; ?></p>
        <?php endif; ?>
    </section>

<?php require 'includes/footer.php'; ?>