<?php $this->view('header', $data); ?>

	<section class="container">
		<div class="row">
			<div class="columns four">
				<?php if(!empty($data['reg_errors'])): ?>
				<?php foreach ($data['reg_errors'] as $error): ?>
				<span class="message error"><?=$error?></span>
				<?php endforeach; ?>

				<?php elseif(!empty($data['reg_success'])): ?>
				<span class="message success">Registration successfully! Check your email for confirmation email</span>
				<?php endif; ?>
			</div>
		</div>
		<div class="row">
			<div class="columns four">
			<form action="" method="post">
				<label>Username: </label>
				<input type="text" name="username" /><br />
				<label>Password: </label>
				<input type="password" name="password" /><br />
				<label>Password (again): </label>
				<input type="password" name="password_again" /><br />
				<label>Name: </label>
				<input type="text" name="name" /><br />
				<input type="submit" name="submit" value="Register" />
			</form>
		</div>
	</section>

<?php $this->view('footer'); ?>