<p>A gallery of the <?= count($all_profiles) ?> writers <?if($current_year != $year):?>who participated<?else:?>participating<?endif?> in <?= $year ?>.</p>
<table id="directory">
<?php
	$columnCount = 5;
	
	for ($i = 0; $i < count($all_profiles); $i++) {
		if ($i % $columnCount == 0) {
			if ($i > 0) echo "</tr>\n";
			echo "<tr>\n";
		}
		$data = $all_profiles[$i];
		$url = $html->url(
			array(
				'controller' => 'profiles',
				'action' => 'review',
				$data['Profile']['id'],
				$year
			)
		);
		$cssClass = ($data[0]['Count'] >= 30) ? ' class="wrote30"' : '';
		echo
			'<td', $cssClass, '><a href="', $url, '">',
			$gravatar->imgTag(array(
				'email' => $data['Profile']['email_address'],
				'default' => 'identicon',
			)),
			'<br/><span class="name">',
			$data['Profile']['display_name'],
			'</span></a>',
			'</td>',
			"\n";
	}
	echo '</tr>';
?>
</table>
<p>
	See also:
	<?php
		foreach ($all_years as $y) {
			echo ' ' . $html->link($y, array(
				'controller' => 'profiles',
				'action' => 'index',
				$y
			));
		}
	?>
</p>
