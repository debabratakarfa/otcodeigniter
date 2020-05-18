<div class="alert alert-danger" role="alert">
	<ul>
		<?php
		$errors = esc($errors);
		foreach ($errors as $error) : ?>
			<li><?= esc($error) ?></li>
		<?php endforeach ?>
	</ul>
</div>
