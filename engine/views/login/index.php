<?php $this->view('header', $data); ?>

	<section class="container">
		<div class="row">
			<div class="columns four">
				<?php if(!empty($data['log_errors'])): ?>
				<span class="message error">Username/Password is incorrect</span>

				<?php elseif(!empty($data['log_success'])): ?>
				<span class="message success">Login successfully!</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="columns four">
			<form action="" method="post">
				<label>Username: </label>
				<input type="text" name="username" />
				<label>Password: </label>
				<input type="password" name="password" />
				<input type="submit" name="submit" value="Login" />
			</form>
		</div>
	</section>

<?php $this->view('footer'); ?>