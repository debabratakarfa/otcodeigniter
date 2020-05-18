<?php
/**
 * Footer Template.
 */

?>
	</main><!-- /.container -->
	<footer class="footer">
		<div class="container">
			<div class="d-flex justify-content-between">
				<span class="text-muted">&copy; <?php echo env('PROJECT_TITLE'); ?> - <?php echo date('Y'); ?></span>
				<span class="text-muted">Powered by CodeIgniter - <?php echo \CodeIgniter\CodeIgniter::CI_VERSION; ?></span>
			</div>

		</div>
	</footer>
</body>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/dist/js/bootstrap.bundle.js')?>></script>
</html>
