<?php include_once 'includes/header.php';?>
<?php include 'database.php'; ?>

<div class="container">
	<div class="row">
		<?php 
		$query = "SELECT * FROM cart_producten";
		// Try to execute the SQL query
		$query_result = $conn->query( $query );
		// Return the result of the query
		$results_array = $query_result->fetchAll(PDO::FETCH_ASSOC);

		/*
		if ( $database_config['debug'] ){
			echo "<pre>";
			print_r( $results_array );
			echo "</pre>";
		}
		*/
		foreach ( $results_array as $product ){
		?>
		<div class="col-md-4 col-xs-12 productlisting">
			<h2><?php echo $product['Naam'];?></h2>
			<p><?php echo $product['Prijs'];?></p>
			<a href="./cart.php?pid=<?php echo $product['Id'];?>">Add to cart</a>
		</div>
		<?php
		}
		?>
	</div>
</div>

<?php include_once 'includes/footer.php';?>