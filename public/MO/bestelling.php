<?php include 'includes/header.php'; ?>
<?php include 'database.php'; ?>

<?php 
try{
	$stmt = $conn->prepare("INSERT INTO `cart_klant` (Naam, Email) VALUES (?, ?)");
	$stmt->bindParam(1, $Naam);
	$stmt->bindParam(1, $Email);

	$Naam = $_POST['Naam'];
	$Email = $_POST['Email'];
	$stmt-execute();
	$lastId = $conn->lastInsertId();

} catch (PDOException $ex){
	if( $database_config['debug'] ){
		$error = $ex->getMessage();
		echo $error;
	}
}

?>

<div class="container">
	<div class="row">
		<?php
			session_start();
			$total_order = 0;
			if( isset($_SESSION['cart_content']) ){
				$cart_array = explode(',', $_SESSION['cart_content']);

				foreach ($cart_array as $item) {
					$query = "SELECT * FROM `cart_producten` WHERE `Id`='". $item ."' ";
					// Try to execute the SQL query
					$query_result = $conn->query( $query );
					// Return the result of the query
					$product = $query_result->fetch(PDO::FETCH_ASSOC);
					$total_order += $product['Prijs'];

				}
			}

			try{
				$stmt = $conn->prepare("INSERT INTO `cart_bestellingen` (totaal_prijs, klant_id) VALUES (?, ?)");
				$stmt->bindParam(1, $totaal_prijs);
				$stmt->bindParam(1, $klant_id);

				//insert one row
				$totaal_prijs = $total_order;
				$klant_id = $lastId;
				$stmt-execute();
				$lastOrderId = $conn->lastInsertId();

			}	catch (PDOException $ex){
				if( $database_config['debug'] ){
					$error = $ex->getMessage();
					echo $error;
				}
			}

			////////////////////////////////////
			//////  MAKE NEW ORDER LINES  //////
			////////////////////////////////////

			if( isset( $_SESSION['cart_content'] ) ){
				$cart_array = explode( ',', $_SESSION['cart_content']);

				foreach( $cart_array as $item ){
					$query = "SELECT * FROM `cart_producten` WHERE `Id`'". $item ."' ";
					// Try to execute the SQL query
					$query_result = $conn->query( $query );
					// Return the result of the query
					$product = $query_result->fetch(PDO::FETCH_ASSOC);

					try{
						$stmt = $conn->prepare("INSERT INTO `cart_bestelling_line` (product_id, bestelling_id, aantal) VALUES (?, ?, ?)");
						$stmt->bindParam(1, $product_id);
						$stmt->bindParam(2, $bestelling_id);
						$stmt->bindParam(3, $aantal);

						$product_id = $item;
						$bestelling_id = $lastOrderId;
						$aantal = 1;

						$stmt->execute();

					} catch ( PDOException $ex ) {
						if( $database_config['debug'] ){
							$error = $ex->getMessage();
							echo $error;
						}
					}
				}
			}
		?>

	</div>
</div>

<?php include 'includes/footer.php'; ?>