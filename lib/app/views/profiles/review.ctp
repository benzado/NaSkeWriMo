<h2 id="summary">
	<?= $gravatar->imgTag(array(
		'email' => $this->data['Profile']['email_address'],
		'default' => 'identicon'
	)) ?>
	<?php if ($year == $current_year): ?>
		Today is 
		<span id="summary_day"><?= $summary_day ?></span>
		and
		<span id="summary_name"><?= $summary_name_html ?></span>
		has written
	<?php else: ?>
		In
		<span id="summary_day"><?= $year ?></span>,
		<span id="summary_name"><?= $summary_name_html ?></span>
		wrote
	<?php endif; ?>
	<span id="summary_sketches_count"><?= $summary_sketches_count ?></span>
	sketch<?= $summary_sketches_count == 1 ? '' : 'es' ?>.
</h2>

<h2>Sketches by <?= $this->data['Profile']['display_name'] ?> in <?= $year ?></h2>
<p>
	<?php
		if (count($all_sketches) == 0) {
			if($current_year == $year) {
				echo 'None yet.';
			}
			else {
				echo 'None written.';
			}
		} else {
			foreach ($all_sketches as $sketch) {
				echo $this->element('sketch', array(
					'sketch' => $sketch,
					'showicon' => false,
					'showdelete' => $allow_changes));
			}
		}
	?>
</p>
<p>
	See also:
	<?php
		foreach ($years_with_sketches as $year) {
			$y = $year[0]['Year'];
			echo ' ' . $html->link($y, array(
				'controller' => 'profiles',
				'action' => 'review',
				$this->data['Profile']['id'],
				$y != $current_year ? $y : ''
			));
		}
	?>
</p>

<?php if ($allow_changes): ?>

<h2>Add A Sketch</h2>
<div>
	<?= $this->Form->create('Sketch', array('action' => 'add')) ?>
	<p>You wrote a sketch? Good work!</p>
	<?= $this->Form->input('title', array('label' => 'Title', 'size' => '40')) ?>
	<p><strong>Title is optional.</strong> If you don't add a title, the list will just say "a new sketch".</p>
	<?= $this->Form->input('url', array('label' => 'Link', 'size' => '40')) ?>
	<p><strong>Link is optional, too.</strong> You don't have to share your sketches, but if you want to, <a href="http://docs.google.com/">Google Docs</a> is a good place to host them. After you've uploaded your sketch, click the blue Share button, select "Get the link to share," then paste it here.</p>
	<?= $this->Form->end('Add Sketch') ?>
</div>

<h2>Profile</h2>
<div>
	<?= $this->Form->create('Profile', array('action' => 'edit')) ?>
	<?= $this->Form->input('display_name', array('label' => 'Name')) ?>
	<p>This is how your name will appear on the site. Enter your real name or choose a <i>nom de plume</i>.</p>
	<?= $this->Form->input('display_link', array('label' => 'Link', 'size' => 40)) ?>
	<p>Link to whatever you like: your blog, Twitter feed, Facebook profile, favorite political party, etc.</p>
	<?= $this->Form->end('Change') ?>
</div>
<p>
	Other things you can do:
	<a href="http://www.gravatar.com/signup">Set a profile image</a>,
	<?= $this->Html->link('Go home', '/'); ?>,
	or
	<?= $this->Html->link('Log out', '/auth/logout'); ?>
</p>

<?php endif; ?>
