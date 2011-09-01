<?php echo '<?xml version="1.0" encoding="utf-8"?>',"\n" ?>
<feed xmlns="http://www.w3.org/2005/Atom">
	
	<id>http://naskewrimo.org/feed/atom</id>
	<title>NaSkeWriMo Sketches</title>
	<subtitle>September is National Sketch Writing Month</subtitle>
	<updated><?= date('c', $last_updated) ?></updated><?php /*  2003-12-13T18:30:02Z */ ?>
	<link rel="self" href="http://www.naskewrimo.org/feed/atom"/>
	<author>
		<name>NaSkeWriMoBot</name>
		<email>naskewrimobot@benzado.com</email>
	</author>
	
<?php
	function xmlencode($text) {
		return htmlspecialchars(strip_tags($text), ENT_COMPAT, 'UTF-8');
	}
?>

<?php foreach ($groups as $key => $group): ?>
	<entry>
		<id>http://naskewrimo.org/sketches/<?= $key ?></id>
		<?php
			$count = count($group['sketches']);
			$title = sprintf(
				'%s for %s',
				($count > 1) ? "$count New Sketches" : "1 New Sketch",
				date('Y F jS, ga', $group['time'])
			);
		?>
		<title type="text"><?= xmlencode($title) ?></title>
		<updated><?= date('c', $group['time']) ?></updated>
		<link rel="alternate" href="http://www.naskewrimo.org/sketches/<?= $key ?>"/>
		<content type="html">
			&lt;p&gt;
			<?php foreach ($group['sketches'] as $sketch) {
				$element = $this->element('sketch', array(
					'sketch' => $sketch,
					'showicon' => true,
					'showdelete' => false,
					'datetimeformat' => 'g:ia'
				));
				echo htmlspecialchars($element, ENT_COMPAT, 'UTF-8');
			} ?>
			&lt;/p&gt;
		</content>
	</entry>
<?php endforeach ?>
</feed>
