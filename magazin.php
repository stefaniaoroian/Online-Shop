<?php
require_once "ShoppingCart.php";?>
<html>
<head>
    <title>Products</title>
    <style>
        .div_titlu{
            font-size: 30px;
        }
    </style>
</head>
<body>
<div id="product-grid">
    <div class="txt-heading">
        <div class="txt-heading label">
            <div class = "div_titlu">

                <a href="Home.php"><i class="fas fa-home fa-fw"></i>Home</a>
                <a href="Profil.php"><i class="fas fa-user-circle"></i>Profile</a>
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a> <br>

                Products from the shop: <br>
            </div>
        </div>
    </div>
<?php
    echo "<body style='background-color:#ba9be8'>";
    $shoppingCart = new ShoppingCart();
    $query = "SELECT * FROM produse";
    $product_array = $shoppingCart->getAllProduct($query);
    if (! empty($product_array)) {
        foreach ($product_array as $key => $value) {
            ?>
            <div class="product-item">
                <form method="post" action="Cos.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">

                    <div class = "images">
                        <img src="<?php echo $product_array[$key]["image"]; ?> " width="100">
                    </div>

                    <div>
                        <strong><?php echo $product_array[$key]["name"]; ?></strong> </div>
                    <div class="product-price"><?php echo $product_array[$key]["price"]. " Lei "; ?></div>
                    <div>
                        <input type="text" name="cantitate" value="1" size="2" />
                        <input type="submit" value="Add to cart" class="btnAddAction" /> </div>
                </form>
            </div>

        <?php }
    }
    ?>
</div>

</body>
</html>
