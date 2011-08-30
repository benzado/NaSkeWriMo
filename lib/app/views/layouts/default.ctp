<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title><?php echo $title_for_layout ?></title>
	<?php echo $scripts_for_layout ?>
	<?php echo $html->css('naskewrimo'); ?>
	<link rel="alternate" type="application/atom+xml" href="/feed/atom"/>
	<meta property="og:title" content="National Sketch Writing Month" />
	<meta property="og:type" content="activity" />
	<meta property="og:url" content="http://www.naskewrimo.org/" />
	<meta property="og:image" content="http://www.naskewrimo.org/img/fb.png" />
	<meta property="og:site_name" content="NaSkeWriMo" />
	<meta property="fb:admins" content="429804" />
</head>
<body>

<div id="header">
	<h1><?= $html->link('September is National Sketch Writing Month', '/'); ?></h1>
	<p>30 days. 30 sketches. No excuses. No apologies.</p>
	<ul class="links">
		<li><?= $html->link('Home', '/') ?></li>
		<li><?= $html->link('About', '/pages/about') ?></li>
		<li><?= $html->link('Writers', '/profiles') ?></li>
		<li><?= $html->link('F.A.Q.', '/pages/faq') ?></li>
		<li><a href="http://naskewrimo.tumblr.com/">Blog</a></li>
		<!-- <li><a href="http://www.facebook.com/group.php?gid=19835704586">Facebook Group</a></li> -->
	</ul>
	<p style="color: #909;">
		Support the site!
		<strike><a href="http://www.zazzle.com/naskewrimo*">Buy some swag!</a></strike>
		Design some swag!
	</p>
</div>

<?php echo $session->flash(); ?>

<?php echo $content_for_layout ?>

<div id="footer">
	<ul class="links">
		<li>Website by <a href="http://www.benzado.com/">Benjamin Ragheb</a></li>
		<li>Hosting by <a href="http://nearlyfreespeech.net/">NearlyFreeSpeech.NET</a></li>
	</ul>
	<p>
		<iframe src="http://www.facebook.com/plugins/like.php?app_id=252487608117350&amp;href=http%3A%2F%2Fwww.naskewrimo.org%2F&amp;send=false&amp;layout=standard&amp;width=450&amp;show_faces=true&amp;action=like&amp;colorscheme=light&amp;font&amp;height=80" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:80px;" allowTransparency="true"></iframe>
	</p>
	<p>
	Questions?  Email <a href="mailto:naskewrimo@benzado.com">naskewrimo@benzado.com</a>.
	</p>
</div>

<!-- Piwik --> 
<script type="text/javascript">
var pkBaseURL = (("https:" == document.location.protocol) ? "https://trekker.benzado.com/" : "http://trekker.benzado.com/");
document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
</script><script type="text/javascript">
try {
var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 11);
piwikTracker.trackPageView();
piwikTracker.enableLinkTracking();
} catch( err ) {}
</script><noscript><p><img src="http://trekker.benzado.com/piwik.php?idsite=11" style="border:0" alt="" /></p></noscript>
<!-- End Piwik Tracking Code -->

</body>
</html>
