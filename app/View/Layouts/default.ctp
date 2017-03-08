<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$cakeDescription = __d('cake_dev', 'Stars foto');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		//echo $this->Html->css('app');
		echo $this->Html->css('styles');
		//echo $this->Html->script(array('jquery-1.11.3.min','app'));
		echo $this->fetch('meta');
	//	echo $this->fetch('script');
	?>
</head>
<body id="home">
	<div class="site-container">
		<header class="header">
			<div class="container">
				<a href="#" class="header__icon" id="header__icon"></a>
				<a href="#" class="header__logo">Logo</a>
				<nav class="menu">
					<?php echo $this->element("sidebar"); ?>
				</nav>
			</div>
		</header>
		<div class="site-pusher">
			<div class="site-content" >
				<div class="container" id="container">
					<ul class="bxslider">
						<?php echo $this->element('slider') ?>
					</ul>
					<?php echo $this->Flash->render(); ?>
					<?php echo $this->fetch('content'); ?>
					<div id='container_footer'></div>
				</div>
				<footer id="footer">Copyright &copy; 2014-<?php echo date('Y'); ?> <a href=""><?php echo env('HTTP_HOST'); ?> <?php echo $cakeVersion; ?></a>
				</footer>
			</div>
			<div class="site-cache" id="site-cache"></div>
		</div>
	</div>
  <?php
  	echo $this->Html->css('jquery.bxslider.min');
		echo $this->fetch('css');
		echo $this->Html->script(array('app.min'));
		echo  $this->Html->script('jquery.bxslider.min');
   ?>
   <?php $this->Html->scriptStart(array('inline'=>false)); ?>
   	$(document).ready(function(){
  		$('.bxslider').bxSlider({
  		mode: 'fade',
  		auto: true,
  		pager:false,
  		controls:false,
  		});
		});
   <?php $this->Html->scriptEnd(); ?>
   <?php echo $this->fetch('script'); ?>
</body>
</html>
