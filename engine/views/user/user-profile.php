<?php $this->view('header', $data); ?>

<?php if(!empty($data['user'])): ?>
<ul>
<li>id: <?=$data['user']->id?></li>
<li>username: <?=$data['user']->username?></li>
<li>real name: <?=$data['user']->name?></li>
<li>date joined: <?=$data['user']->joined?></li>
<li>user group: <?=$data['user']->group?></li>
</ul>
<?php endif; ?>

<?php $this->view('footer'); ?>