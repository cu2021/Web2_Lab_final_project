<!DOCTYPE html>
<html lang="en">
<?php include_once "partial/head.php" ?>

<body>
	<?php
	// header section
	include_once "partial/header.php";
	// navbar
	include_once "partial/nav.php";
	?>

	<!-- SECTION -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- category -->
				<?php
				//database connection
				include_once "../Dashboard/partial/DB_CONNECTION.php";
				//retrieving all categories
				$query = "SELECT * from categories";
				$result = mysqli_query($connection, $query);
				//showing the names of categories
				while ($row = mysqli_fetch_assoc($result)) {
					
					echo '<div class="col-md-4 col-xs-6">
							<div class="shop">
								<div class="shop-img">
									<img src="./img/images.png" alt="">
								</div>
								<div class="shop-body">
									<h3>' . $row['name'] . '<br>Category</h3>
									<a href="show_stores.php?category_id=' . $row["id"] . '" class="cta-btn">Show now <i class="fa fa-arrow-circle-right"></i></a>
								</div>
							</div>
						</div>';
				}

				?>

				<!-- /category -->



			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /SECTION -->




	<!-- /NEWSLETTER -->
	<?php include_once "partial/footer.php" ?>

</body>

</html>