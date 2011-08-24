<p>Enter your email address and the passcode that was emailed to you when you registered.</p>

<?php echo $this->Form->create(false); ?>
<div>
    <?php echo $this->Form->label('email_address', 'Email'); ?>
    <?php echo $this->Form->text('email_address', array('size' => 20)); ?>
</div>
<div>
    <?php echo $this->Form->label('passcode', 'Passcode'); ?>
    <?php echo $this->Form->password('passcode', array('size' => 4)); ?>
</div>
<?php echo $this->Form->end('Login'); ?>

<p>
	<?= $html->link('Forgot your passcode?', 'passcode') ?>
</p>
