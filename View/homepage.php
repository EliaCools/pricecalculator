<?php require 'includes/header.php'?>
<!-- this is the view, try to put only simple if's and loops here.
Anything complex should be calculated in the model -->

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </nav>

<section>

    <form method="post">
        <select name="productid" >
<?php foreach($products as $product):
    var_dump($products);?>
            <option value="<?php $product['id'];?>"><?php echo $product['name']?></option>
<?php endforeach;?>
        </select>

        <select name="customerid" >
            <?php foreach($customers as $customer):?>
                <option value="<?php $customer['id'];?>"><?php echo $customer['firstname']?></option>
            <?php endforeach;?>
        </select>
    </form>

    <h3>

    </h3>

</section>
<?php require 'includes/footer.php'?>