<?php
include_once "../Dashboard/partial/DB_CONNECTION.php";
$storeName = strtoupper($_GET['name']);
$query1 = "SELECT * from stores where name like '$storeName%'";
$result1 = mysqli_query($connection, $query1);
?>

<!DOCTYPE html>
<html lang="en">
<?php include_once "partial/head.php" ?>

<body>
    <?php
    include_once "partial/header.php";
    include_once "partial/nav.php";
    ?>

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">

                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Related Stores</h3>
                    </div>
                </div>
                <!-- product -->

                <?php
                if (mysqli_num_rows($result1) > 0) {
                    while ($store = mysqli_fetch_assoc($result1)) {
                        $store_id = $store['id'];


                        echo '<div class="col-md-3 col-xs-6">
					<div class="product">
						<div class="product-img">
							<img src="http://localhost/iug1/Final%20Project/Dashboard/uploads/images/' . $store["image"] . '" width="262.5px" height="262.5px" alt="">
							<div class="product-label">
								<span class="sale">NEW</span>
							</div>
						</div>
						<div class="product-body">
							<p class="product-category">' . $category . '</p>
							<h3 class="product-name"><a href="show_stores.php?category_id=' . $store["category_id"] . '">' . $store["name"] . '</a></h3>
							
							
							
						</div>
						<div class="add-to-cart">
						<a href="showStoreInfo.php?id=' . $store['id'] . '">
						<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Show Store Info </button></a>
						</div>
					</div>
				</div>';
                    }
                } else {
                    echo '
                    <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">No Store with this name: ' . $storeName . '</h3>
                    </div>
                </div>
                ';
                }

                ?>

                <!-- /product -->



                <div class="clearfix visible-sm visible-xs"></div>



            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /Section -->



    <?php
    include_once "partial/footer.php"
    ?>

</body>

</html>