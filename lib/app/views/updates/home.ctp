<h2 id="summary">
	<?php if ($summary_mode < 0): ?>
		<?php if ($summary_days_left > 1): ?>
			There are 
			<span id="summary_day"><?= $summary_days_left ?></span>
			days until September
		<?php else: ?>
			National Sketch Writing Month starts tomorrow
		<?php endif; ?>
		and 
		<span id="summary_people_count"><?= $summary_people_count ?></span>
		people are getting ready to write.
	<?php else: ?>
		<?php if ($summary_mode == 0): ?>
			Today is 
			<span id="summary_day"><?= $summary_day ?></span>
		<?php else: ?>
			National Sketch Writing Month is over
		<?php endif; ?>
		and
		<span id="summary_people_count"><?= $summary_people_count ?></span>
		people have written 
		<span id="summary_sketches_count"><?= $summary_sketches_count ?></span>
		sketches.
	<?php endif; ?>
</h2>

<p>
	<?php if ($current_profile): ?>
		<?php if ($summary_mode >= 0): ?>
			<div>
				You have written
				<span id="your_sketches_count"><?= $your_sketches_count ?></span>
				sketch<?= $your_sketches_count == 1 ? '' : 'es' ?>.
				<?php
					$your_profile_url = $html->url(array(
						'controller' => 'profiles',
						'action' => 'review',
						$current_profile['id']
					), true);
					$tweet = "I've written $your_sketches_count sketch".($your_sketches_count == 1 ? '' : 'es')." for National Sketch Writing Month $your_profile_url #naskewrimo";
				?>
				<a href="http://twitter.com/home?status=<?= urlencode($tweet) ?>">Tweet!</a>
			</div>
		<?php endif; ?>
		<div>
			<?= $html->link('Update', array('controller' => 'profiles', 'action' => 'review', $current_profile['id'])) ?> 
			or
			<?= $html->link('Log out', '/auth/logout') ?>
		</div>
	<?php else: ?>
		<?= $html->link('Log in', '/auth/login') ?>
		or
		<?= $html->link('Sign up', '/auth/passcode') ?>.
	<?php endif; ?>
</p>

<h2>Latest Updates</h2>
<p>
	<?php
		if (count($all_recent_updates) == 0) {
			echo 'None yet.';
		} else {
			$last_date_header = false;
			foreach ($all_recent_updates as $sketch) {
				$dt = strtotime($sketch['Sketch']['created']);
				$date_header = date('F j, Y', $dt);
				if ($date_header != $last_date_header) {
					printf("<h3>%s</h3>\n", $date_header);
					$last_date_header = $date_header;
				}
				echo $this->element('sketch', array(
					'sketch' => $sketch,
					'showicon' => true,
					'showdelete' => false,
					'datetimeformat' => 'h:ia '
				));
			}
		}
	?>
</p>

<h2>Most Prolific in <?= $year ?></h2>
<p>
	<?php if (count($top_writers) == 0): ?>
		None yet.
	<?php else: foreach ($top_writers as $writer): ?>
		<div>
			<?php
				$linkinfo = array(
					'controller' => 'profiles',
					'action' => 'review',
					$writer['Profile']['id']
				);
				echo $html->link(
					$gravatar->imgTag(array(
						'email' => $writer['Profile']['email_address'],
						'size' => 24,
						'default' => 'identicon'
					)),
					$linkinfo, 
					array('escape' => false)
				);
				echo ' ';
				echo $html->link($writer['Profile']['display_name'], $linkinfo);
				printf(
					' wrote %d sketch%s',
					$writer[0]['Count'],
					$writer[0]['Count'] == 1 ? '' : 'es'
				);
			?>
		</div>
	<?php endforeach; endif; ?>
</p>
