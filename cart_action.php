<?php
//need session to work

echo '<script>
            function addProduct() {
                alert("Dodano produkt do koszyka");
            }
          </script>';

echo '<script>
            function removeProduct() {
                alert("Produkt został usunięty");
            }
          </script>';

echo '<script>
            function removeComment() {
                alert("Komentarz został usunięty");
            }
          </script>';

if(isset($_POST["add_to_cart"]))
{
    if(isset($_SESSION["shopping_cart"]))
    {
        $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
        if(!in_array($_GET["id"], $item_array_id))
        {
            $count = count($_SESSION["shopping_cart"]);
            $item_array = array(
                'item_id'             =>     $_GET["id"],
                'item_name'           =>     $_POST["name"],
                'item_price'          =>     $_POST["price"],
                'item_quantity'       =>     $_POST["quantity"]
            );
            $_SESSION["shopping_cart"][$count] = $item_array;
        }
        else
        {
            foreach($_SESSION["shopping_cart"] as $keys => $values)
            {
                if($values["item_id"] == $_GET["id"])
                {
                    $_SESSION["shopping_cart"][$keys]["item_quantity"]+=$_POST["quantity"];
                }
            }
        }
    }
    else
    {
        $item_array = array(
            'item_id'             =>     $_GET["id"],
            'item_name'           =>     $_POST["name"],
            'item_price'          =>     $_POST["price"],
            'item_quantity'       =>     $_POST["quantity"]
        );
        $_SESSION["shopping_cart"][0] = $item_array;
    }
}
if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
            }
        }
    }
}



