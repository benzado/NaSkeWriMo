<?php
	$count = count($sketches);
	$title = sprintf(
		'%s for %s',
		($count == 1) ? "1 New Sketch" : "$count New Sketches",
		date('Y F jS, ga', $datetime)
	);
?>
<h2><?= $title ?></h2>
<p>
	<?php
		if (count($sketches) == 0) {
			echo 'None yet.';
		} else {
			foreach ($sketches as $sketch) {
				echo $this->element('sketch', array(
					'sketch' => $sketch,
					'showicon' => true,
					'showdelete' => false,
					'datetimeformat' => 'g:ia'
				));
			}
		}
	?>
</p>
