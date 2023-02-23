<?php
echo "<body style='background-color: #ba9be8'>";
require_once "ShoppingCart.php";
session_start();
// Dacă utilizatorul nu este conectat redirecționează la pagina de autentificare ...
if (!isset($_SESSION['loggedin'])) {
    header('Location: indexl.html');
    exit;
}
// pt membrii inregistrati
$client_id = $_SESSION['id'];
$shoppingCart = new ShoppingCart();
if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "add":
            if (!empty($_POST["quantity"])) {
                $productResult = $shoppingCart->getProductByCode($_GET["code"]);
                $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $client_id);
                if (!empty($cartResult)) {

                    // Modificare cantitate in cos
                    $newQuantity = $cartResult[0]["quantity"] + $_POST["quantity"];
                    $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
                } else {
                    // Adaugare in tabelul cos
                    $shoppingCart->addToCart($productResult[0]["id"], $_POST["quantity"], $client_id);
                }
            }
            break;
        case "remove":
            // Sterg o sg inregistrare
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            // Sterg cosul
            $shoppingCart->emptyCart($client_id);
            break;
    }
}
?>
<HTML>

<HEAD>
    <TITLE>Shopping Cart</TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
</HEAD>

<BODY>
<div id="shopping-cart">
    <div class="txt-heading">
        <div class="txt-heading-label">Shopping Cart</div> <a id="btnEmpty" href="Cos.php?action=empty"><img src="deleteButton.png" width="20" alt="empty-cart" title="Empty Cart" style="max-width: 50px" /></a>
    </div>
    <?php
    $cartItem = $shoppingCart->getMemberCartItem($client_id);
    if (!empty($cartItem)) {
        $item_total = 0;
    }
    ?>
    <table cellpadding="10" cellspacing="1">
        <tbody>
        <tr>
            <th style="text-align: left;"><strong>Name</strong></th>
            <th style="text-align: left;"><strong>Code</strong></th>
            <th style="text-align: right;"><strong>Quantity</strong></th>
            <th style="text-align: right;"><strong>Price</strong></th>
            <th style="text-align: center;"><strong>Delete</strong></th>
        </tr>
        <?php
        foreach ((array)$cartItem as $item) {
            ?>
            <tr>
                <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong>
                        <?php echo $item["name"]; ?>
                    </strong></td>
                <td style="text-align: left; border-bottom: #F0F0F0 1px solid;">
                    <?php echo $item["code"]; ?>
                </td>
                <td style="text-align: right; border-bottom: #F0F0F0 1px solid;">
                    <?php echo $item["quantity"]; ?>
                </td>
                <td style="text-align: right; border-bottom: #F0F0F0 1px solid;">
                    <?php echo  $item["price"]."Lei " ; ?>
                </td>
                <td style="text-align: center; border-bottom: #F0F0F0 1px solid;"><a href="Cos.php?action=remove&id=<?php echo $item["cart_id"]; ?>" class="btnRemoveAction"><img src="deleteButton.png" width="20" alt="icon-delete" title="Remove Item" style="max-width: 50px" /></a></td>
            </tr>
            <?php
            // $item_total = 0;
            $item_total += ($item["price"] * $item["quantity"]);
        }
        ?>
        <tr>
            <td colspan="3" text-align=right><strong>Total:</strong></td>
            <td text-align=right>
                <?php
                if(isset($item_total))
                    echo  $item_total." Lei "; ?>
            </td>
            <td></td>
        </tr>
        </tbody>
    </table>
    <?php
    ?>
</div>
<button>
    <div><a href="ComandaFinala.html">Complete the order</a></div>
</button>
<button>
    <div><a href="magazin.php">Choose another product</a></div>
</button>
<button>
    <div><a href="logout.php">Abandon the shopping session</a></div>
</button>
<?php
//required_once "products-list.php";
?>
</BODY>

</HTML>
