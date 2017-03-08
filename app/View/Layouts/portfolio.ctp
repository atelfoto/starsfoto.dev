<?php  $cakeDescription = __d('cake_dev', 'stars foto '); ?><!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo $this->Html->charset();?>
	<meta http-equiv="x-ua-compatible" content="ie=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title><?php echo $cakeDescription ;?> | <?php  echo $this->fetch('title'); ?>
	</title>
	<!-- <link rel="apple-touch-icon" href="http://www.<?= env('HTTP_HOST');?>/img/apple-icon.png"/> -->
<!-- <link rel="apple-touch-icon" sizes="57x57" href="http://<?= env('HTTP_HOST');?>/img/favicon/apple-icon-57x57.png" />
<link rel="apple-touch-icon" sizes="60x60" href="http://<?= env('HTTP_HOST');?>/img/favicon/apple-icon-60x60.png" />
<link rel="apple-touch-icon" sizes="72x72" href="http://<?= env('HTTP_HOST');?>/img/favicon/apple-icon-72x72.png" />
<link rel="apple-touch-icon" sizes="76x76" href="http://<?= env('HTTP_HOST');?>/img/favicon/apple-icon-76x76.png" />
<link rel="apple-touch-icon" sizes="114x114" href="http://<?= env('HTTP_HOST');?>/img/favicon/apple-icon-114x114.png" />
<link rel="apple-touch-icon" sizes="120x120" href="http://<?= env('HTTP_HOST');?>/img/favicon/apple-icon-120x120.png" />
<link rel="apple-touch-icon" sizes="144x144" href="http://<?= env('HTTP_HOST');?>/img/favicon/apple-icon-144x144.png" />
<link rel="apple-touch-icon" sizes="152x152" href="http://<?= env('HTTP_HOST');?>/img/favicon/apple-icon-152x152.png" />
<link rel="apple-touch-icon" sizes="180x180" href="http://<?= env('HTTP_HOST');?>/img/favicon/apple-icon-180x180.png" />
<link rel="apple-touch-icon" sizes="192x192" href="http://<?= env('HTTP_HOST');?>/img/favicon/apple-icon-192x192.png" />
<link rel="icon" type="image/png" sizes="16x16" href="http://<?= env('HTTP_HOST');?>/img/favicon/favicon-16x16.png" />
<link rel="icon" type="image/png" sizes="32x32" href="http://<?= env('HTTP_HOST');?>/img/favicon/favicon-32x32.png" />
<link rel="icon" type="image/png" sizes="36x36" href="http://<?= env('HTTP_HOST');?>/img/favicon/favicon-36x36.png" />
<link rel="icon" type="image/png" sizes="48x48" href="http://<?= env('HTTP_HOST');?>/img/favicon/favicon-48x48.png" />
<link rel="icon" type="image/png" sizes="72x72" href="http://<?= env('HTTP_HOST');?>/img/favicon/favicon-72x72.png" />
<link rel="icon" type="image/png" sizes="96x96" href="http://<?= env('HTTP_HOST');?>/img/favicon/favicon-96x96.png" />
<link rel="icon" type="image/png" sizes="144x144" href="http://<?= env('HTTP_HOST');?>/img/favicon/favicon-144x144.png" />
<link rel="icon" type="image/png" sizes="192x192" href="http://<?= env('HTTP_HOST');?>/img/favicon/favicon-192x192.png" />
<link rel="apple-touch-startup-image" href="http://www.<?= env('HTTP_HOST');?>/img/apple-image.png"/> -->
<?php
echo $this->Html->meta('icon')."\r\n";
echo $this->Html->meta(array('name' => 'keywords', 'content' => ''));
echo $this->fetch('meta');
?>
<meta property="og:locale" content="fr_FR" />
<meta name="twitter:site" content="<?= $cakeDescription; ?>">
<meta name="twitter:creator" content="<?= $cakeDescription; ?>">
<meta name="twitter:domain" content="<?= env('HTTP_HOST');?>">
<meta name="application-name" content="<?= $cakeDescription; ?>"/>
<meta name="msapplication-TileColor" content="#EBEAE6"/>
<!-- <meta name="msapplication-square70x70logo" content="tiny.png"/>
<meta name="msapplication-square150x150logo" content="square.png"/>
<meta name="msapplication-wide310x150logo" content="wide.jpg"/>
<meta name="msapplication-square310x310logo" content="large.jpg"/> -->
<?php  // echo $this->Html->meta('blog du château', $this->Html->url(array(
	// 'controller' => 'posts', 'action' => 'feed', 'ext'=>'rss')),array('type' => 'rss'));?>
	<?php
	echo $this->Html->css(array('portfolio.min'));
	echo $this->fetch('css');
	echo $this->Html->script(array("app.min"));
	?>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.6.2/html5shiv.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body data-spy="scroll" data-target=".navbar-fixed-top">
	<div class="container" >
		<!--nocache-->
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->Session->flash('notif'); ?>
		<!--/nocache-->
		<div class="" style="" id='page-header'>
			<h2 class="title "><?php  echo $this->fetch('title'); ?></h2>
		</div>
	</div>
	<?php   echo $this->fetch('content'); ?>
	<!--nocache-->
	<!--/nocache-->
	<?php  echo $this->fetch('script');?>
</body>
</html>
