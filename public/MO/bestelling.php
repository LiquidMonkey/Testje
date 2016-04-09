<?php include 'includes/header.php'; ?>
<?php include 'database.php'; ?>

<?php 
try{

} catch (PDOException $ex){
	if( $database_config['debug'] ){
		$error = $ex->getMessage();
		echo $error;
	}
}

?>

<div class="container">
	<div class="row">
		
	</div>
</div>

<?php include 'includes/footer.php'; ?>