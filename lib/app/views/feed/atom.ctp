<?php echo '<?xml version="1.0" encoding="utf-8"?>',"\n" ?>
<feed xmlns="http://www.w3.org/2005/Atom">
	
	<id>http://naskewrimo.org/feed/atom</id>
	<title>NaSkeWriMo Sketches</title>
	<subtitle>September is National Sketch Writing Month</subtitle>
	<updated><?= date('c', $last_updated) ?></updated><?php /*  2003-12-13T18:30:02Z */ ?>
	<link rel="self" href="http://www.naskewrimo.org/feed/atom"/>
	
<?php
	function xmlencode($text) {
		return htmlspecialchars(strip_tags($text), ENT_COMPAT, 'UTF-8');
	}

	foreach ($recent_sketches as $sketch): 
		$title = $sketch['Sketch']['title'];
		$sketch_url = $sketch['Sketch']['url'];
		$profile_url = $html->url(array(
			'controller' => 'profiles',
			'action' => 'review',
			$sketch['Profile']['id']
		), true);
?>

	<entry>

<?php if (empty($title)) {
	$entry_title = 'a new sketch by ' . $sketch['Profile']['display_name'];
} else {
	$entry_title = '"' . $title . '" by ' . $sketch['Profile']['display_name'];
} ?>
		<title type="text"><?= xmlencode($entry_title) ?></title>

<?php if (empty($sketch_url)): ?>
		<link href="<?= $profile_url ?>"/>
<?php else: ?>
		<link href="<?= xmlencode($sketch_url) ?>"/>
<?php endif; ?>

		<id>http://naskewrimo.org/sketch/<?= $sketch['Sketch']['id'] ?></id>
		<updated><?= date('c', $sketch[0]['createdTime']) ?></updated>
		<summary type="text">
<?php if (empty($sketch_url)): ?>
			Click through to view <?= xmlencode($sketch['Profile']['display_name']) ?>'s profile.
<?php else: ?>
			Click through to read <?= xmlencode($sketch['Profile']['display_name']) ?>'s sketch.
<?php endif; ?>
		</summary>
		<author>
			<name><?= xmlencode($sketch['Profile']['display_name']) ?></name>
			<uri><?= xmlencode($profile_url); ?></uri>
		</author>
	</entry>

<?php endforeach; ?>

</feed>
