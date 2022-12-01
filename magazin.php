<?php require_once "ShoppingCart.php";?>
<HTML>
<HEAD>
    <TITLE>Creare cos cumparaturi </TITLE>
    <link href="style.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</HEAD>
<BODY> 
<center>
    <div class="container mt-5">
        <form action="categorie.php" method="post" class="mb-3">
            <?php
                Include("Conectare.php");
                $result = $mysqli->query("SELECT DISTINCT categorie FROM tbl_product");
                echo "<select name='select_category'>";
                echo "<option>SELECT CATEGORY</option>";
                while ($row = $result->fetch_array())
                {
                    echo "<option>$row[categorie]</option> ";
                }
                echo "</select>";
            ?> 
            <br> </br>
            <input type="submit" name="submit_cat" vlaue="Choose options">
        </form>
    </div>

    <div id="product-grid">
    <p style="text-align: right"><a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a> </p>
        <div class="txt-heading"><div class="txt-heading-label">Products</div></div>
            <?php
                $shoppingCart = new ShoppingCart();
                $query = "SELECT * FROM tbl_product";
                $product_array = $shoppingCart->getAllProduct($query);
                if (! empty($product_array)) {
                foreach ($product_array as $key => $value) {
            ?>
            <div class="all">
            <div class="product-item">
                <form method="post" action="Cos.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>">
                <div class="product-image">
                    <img src="<?php echo $product_array[$key]["image"]; ?>" width="250" style="allign: center">
                </div>
                <div id='produs_name'>
                    <strong><?php echo $product_array[$key]["name"]; ?></strong>
                </div>
                <div class="product-price">
                    <?php echo $product_array[$key]["price"] . " RON"; ?>
                </div>
            
                <input type="text" name="quantity" value="1" size="2" />
                <input type="submit" value="Add to cart" class="btnAddAction" />
            </div>
            </div>
        </div>
            </form>
    <div>
        <?php
        }
        }
        ?>
    </div>
    <div>
    </center>
</BODY>

</HTML>