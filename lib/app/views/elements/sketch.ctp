<div class="sketchitem">
	<?php
		if (! isset($datetimeformat)) {
			echo $sketch['Sketch']['created'];
			echo ': ';
		} elseif ($datetimeformat) {
			$dt = strtotime($sketch['Sketch']['created']);
			echo date($datetimeformat, $dt);
		}

		if ($showicon) {
			$linkinfo = array(
				'controller' => 'profiles',
				'action' => 'review',
				$sketch['Profile']['id']
			);
			echo $html->link( 
				$gravatar->imgTag(array(
					'email' => $sketch['Profile']['email_address'],
					'size' => 24,
					'default' => 'identicon'
				)),
				$linkinfo,
				array('escape' => false)
			);
			echo ' ';
			echo $html->link($sketch['Profile']['display_name'], $linkinfo);
			echo ' wrote ';
		}

		$title = $sketch['Sketch']['title'];
		$url = $sketch['Sketch']['url'];
		
		echo '<strong>';
		if (!empty($title)) {
			echo '&#8220;';
		}
		if (!empty($url)) {
			printf(
				'<a href="%s" rel="nofollow">',
				htmlspecialchars($url, ENT_COMPAT, 'UTF-8')
			);
		}
		if (empty($title)) {
			echo 'a new sketch';
		} else {
			echo strip_tags($title);
		}
		if (!empty($url)) { 
			echo '</a>'; 
		}
		if (!empty($title)) {
			echo '&#8221;';
		}
		echo '</strong> ';
		if ($showdelete) {
			echo $html->link(
				'delete',
				array(
					'controller' => 'sketches',
					'action' => 'delete',
					$sketch['Sketch']['id']
				),
				array(
					'class' => 'dangerous'
				),
				empty($title)
				? "Are you sure you want to delete this sketch entry?"
				: "Are you sure you want to delete the sketch \"$title\"?"
			);
		}
	?>
</div>
