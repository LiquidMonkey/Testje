<?php include 'includes/header.php'; ?>
<?php include 'includes/database.php'; ?>

<?php 

////////////////////////////////////
///////  MAKE NEW CUSTOMER  ////////
////////////////////////////////////

try{

	$stmt = $conn->prepare("INSERT INTO `cart_klanten` (Naam, Email) VALUES (?, ?)");
	$stmt->bindParam(1, $Naam);
	$stmt->bindParam(2, $Email);

// insert one row
	$Naam = $_POST['Naam'];
	$Email = $_POST['Email'];
	$stmt->execute();
	$lastId = $conn->lastInsertId();


} catch (PDOException $ex){
	if( $database_config['debug'] ){
		$error = $ex->getMessage();
		echo $error;
	}
}

////////////////////////////////////
/////  CALCULATE TOTAL PRICE  //////
////////////////////////////////////

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

////////////////////////////////////
////////   MAKE NEW ORDER   ////////
////////////////////////////////////

try{

	$stmt = $conn->prepare("INSERT INTO `cart_bestellingen` (Klant_id, Totaalprijs) VALUES (?, ?)");
	$stmt->bindParam(1, $klant_id);
	$stmt->bindParam(2, $totaal_prijs);

// insert one row
	$klant_id = $lastId;
	$totaal_prijs = $total_order;
	$stmt->execute();
	$lastId = $conn->lastInsertId();

}	catch (PDOException $ex){
	if( $database_config['debug'] ){
		$error = $ex->getMessage();
		echo $error;
	}
}

////////////////////////////////////
/////  MAKE A NEW ORDER LINES  /////
////////////////////////////////////

if( isset( $_SESSION['cart_content'] ) ){
	$cart_array = explode( ',', $_SESSION['cart_content']);

	foreach( $cart_array as $item ){
		$query = "SELECT * FROM `cart_producten` WHERE `Id` = '". $item ."' ";
					// Try to execute the SQL query
		$query_result = $conn->query( $query );
					// Return the result of the query
		$product = $query_result->fetch(PDO::FETCH_ASSOC);


		try{

			$stmt = $conn->prepare("INSERT INTO `cart_bestellingregels` (Product_id, Bestelling_id, Aantal) VALUES (?, ?, ?)");
			$stmt->bindParam(1, $product_id);
			$stmt->bindParam(2, $bestelling_id);
			$stmt->bindParam(3, $aantal);

			$product_id = $item;
			$bestelling_id = $lastId;
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

<div class="container">
	<div class="row">
		<p>Thank you for your order <?php echo $_POST['Naam'];?>.</p>
		<p>Your order has been recorded as order number <?php echo $lastId;?></p>
	</div>
</div>

<?php include 'includes/footer.php'; ?>