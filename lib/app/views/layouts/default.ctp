<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title><?php echo $title_for_layout ?></title>
	<?php echo $scripts_for_layout ?>
	<?php echo $html->css('naskewrimo'); ?>
	<link rel="alternate" type="application/atom+xml" href="/feed/atom"/>
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
		<li><a href="http://septembersketch.blogspot.com/">News Blog</a></li>
		<li><a href="http://www.facebook.com/group.php?gid=19835704586">Facebook Group</a></li>
		<li><a href="http://naskewrimo.tumblr.com/">Tumblelog</a></li>
	</ul>
	<p style="color: #909;">
		Support the site!
		<a href="http://www.zazzle.com/benzado/gifts?cg=196538341821228242&rf=238950482054443238">Buy some swag!</a>
		There's
		<a href="http://www.zazzle.com/naskewrimo_2010_t_shirt-235992339223613810?rf=238950482054443238">a T-shirt</a>,
		<a href="http://www.zazzle.com/naskewrimo_2010_mug-168693372226939112?rf=238950482054443238">a mug</a>,
		<a href="http://www.zazzle.com/naskewrimo_2010_tote_bag-149986192421240862?rf=238950482054443238">a tote bag</a>,
		<strike>and more</strike>! There are only three items.
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
