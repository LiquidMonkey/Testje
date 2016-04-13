<?php include 'includes/header.php'; ?>

<div class="debug">
    <label><input type="checkbox"> Debug</label>
</div>

<div class="parallax">

	<div class="parallax__group group1">
		<div class="parallax__layer parallax__layer--base">
			<div class="title">
				<h1>Goedendag</h1>
			</div>
		</div>
	</div>
	<div class="parallax__group group2">
		<div class="parallax__layer parallax__layer--base">		</div>
		<div class="parallax__layer parallax__layer--back">		</div>
	</div>
	<div class="parallax__group group3">
		<div class="parallax__layer parallax__layer--base">
			<div class="title">3</div>
		</div>
	</div>

</div>

  <script>
    var debugInput = document.querySelector("input");
    function updateDebugState() {
        document.body.classList.toggle('debug-on', debugInput.checked);
    }
    debugInput.addEventListener("click", updateDebugState);
    updateDebugState();
  </script>

<?php include 'includes/footer.php'; ?>