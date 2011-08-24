<p>Enter your email address and press "Send Passcode" to have a four-digit passcode sent to you.</p>

<?php echo $this->Form->create(false); ?>
<div>
    <?php echo $this->Form->label('email_address', 'Email'); ?>
    <?php echo $this->Form->text('email_address', array('size' => 20)); ?>
</div>
<?php echo $this->Form->end('Send Passcode'); ?>
