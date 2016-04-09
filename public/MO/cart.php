<?php include_once 'includes/header.php';?>
<?php include 'database.php'; ?>

<div class="container">
	<div class="row">
		<h2>Producten in winkelwagen</h2>
		<?php
		session_start();
		if ( isset($_GET['pid']) ){
			if( isset($_SESSION['cart_content']) ){
				$_SESSION['cart_content'] = $_GET['pid'];
			} else {
				$_SESSION['cart_content'] .= ',';
				$_SESSION['cart_content'] .= $_GET['pid'];
			}
		}

		if( isset($_GET['empty']) ){
			session_destroy();
			header('location: cart.php');
		}

		if ( isset($_GET['remove']) ){
			echo 'Triggered';
			$_SESSION['cart_content'] = preg_replace('/'.$_GET['pid'].'/', '', $_SESSION['cart_content'], 1);
			$_SESSION['cart_content'] = preg_replace('/,,/', ',', $_SESSION['cart_content'], 1);
			$_SESSION['cart_content'] = trim( $_SESSION['cart_content'], "," );
			header('location: cart.php');
		}

		if(){
			
		}

		/*
		if( $database_config['debug'] ){
			echo "<pre>";
			print_r( $_SESSION );
			echo "</pre>";
		}
		*/
		?>
		<?php
		if ( isset($_SESSION['cart_content']) ) {
			$cart_array = explode( ',', $_SESSION['cart_content'] );
			
			/*
			if( $database_config['debug'] ){
				echo "<pre>";
				print_r( $cart_array );
				echo "</pre>";
			}
			*/

			foreach ($cart_array as $item) {
				$query = "SELECT * FROM cart_producten WHERE `Id`='".$item."' ";
				//try to execute the SQL query
				$query_result = $conn->query( $query );
				// Return the result of the query
				$product = $query_result->fetch(PDO::FETCH_ASSOC);
				?>

				<div class="col-md-12 col-xs-12 productlisting">
					<p class="col-md-4"><?php echo $product['Naam']; ?></p>
					<p class="col-md-4">&euro; <?php echo $product['Prijs']; ?></p>
					<a class="col-md-4" href="./cart.php?remove=true&pid=<?php echo $product['Id']; ?>">Remove</a>
				</div>

				<?php
			}
		}
		?>
	</div>
</div>

<?php 
	include_once 'includes/footer.php';
?>