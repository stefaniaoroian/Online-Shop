<?php
    require_once "DBController.php";
    class ShoppingCart extends DBController
    {

        function getAllProduct()
        {
            $query = "SELECT * FROM produse";
            $productResult = $this->getDBResult($query);
            return $productResult;
        }

        function getMemberCartItem($client_id)
        {
            $query = "SELECT produse.*, cos.id as cos_id,cos.quantity FROM produse, cos WHERE produse.id = cos.product_id AND cos.client_id = ?";
            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $client_id
                )
            );
            $cartResult = $this->getDBResult($query, $params);
            return $cartResult;
        }

        function getProductByCode($product_code)
        {
            $query = "SELECT * FROM produse WHERE code=?";
            $params = array(
                array(
                    "param_type" => "s",
                    "param_value" => $product_code
                )
            );
            $productResult = $this->getDBResult($query, $params);
            return $productResult;
        }

        function getCartItemByProduct($product_id, $client_id)
        {
            $query = "SELECT * FROM cos WHERE product_id = ? AND client_id = ?";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $product_id
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $client_id
                )
            );
            $cartResult = $this->getDBResult($query, $params);
            return $cartResult;
        }

        function addToCart($product_id, $quantity, $client_id)
        {
            $query = "INSERT INTO cos (product_id,quantity,client_id) VALUES (?, ?, ?)";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $product_id
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $quantity
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $client_id
                )
            );
            $this->updateDB($query, $params);
        }

        function updateCartQuantity($quantity, $cart_id)
        {
            $query = "UPDATE cos SET quantity = ? WHERE id= ?";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $quantity
                ),
                array(
                    "param_type" => "i",
                    "param_value" => $cart_id
                )
            );
            $this->updateDB($query, $params);
        }

        function deleteCartItem($cart_id)
        {
            $query = "DELETE FROM cos WHERE id = ?";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $cart_id
                )
            );

            $this->updateDB($query, $params);
        }

        function emptyCart($client_id)
        {
            $query = "DELETE FROM cos WHERE client_id = ?";

            $params = array(
                array(
                    "param_type" => "i",
                    "param_value" => $client_id
                )
            );

            $this->updateDB($query, $params);
        }
    }