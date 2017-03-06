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

$cakeDescription = __d('cake_dev', 'Stars Foto');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<?php echo $this->Html->charset(); ?>
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<meta name="copyright" content="//<?= env('HTTP_HOST'); ?>">
	<meta name="author" content="<?= env('HTTP_HOST'); ?>">
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
	echo $this->Html->meta('icon');
	echo $this->Html->meta(array("name"=>"keywords","content"=>""));
	echo $this->fetch('meta');
	echo $this->Html->css('styles.min');
	echo $this->fetch('css');
	?>
	<style>
		body{
			/*background: url(../img/boxed-bg.jpg);*/
		}
		.slider-partenaires{
			margin-top: 3em;
			box-shadow: inset 0 5px 5px 0 rgba(0,0,0,0.3);
			-webkit-box-shadow: inset 0 5px 5px 0 rgba(0,0,0,0.3);
			clear: both;
			background: rgb(242,242,242);
		}
		.page-header.container h2{
			font-weight: bold;
			font-size: 56px;
			text-align: center;
		}
		p{
			color: #555;
			/*color: #222;*/
			font-size: 1.1em;
		}
		/*.bx-viewport*/
		.bxslider {
			margin-bottom: 3em;
		}
		#map{
			position: relative; overflow: hidden;
		}
		#footer{
			border-top: 6px solid #f60;

			background: #00b027;
			color: #fff;
			/*border-top: solid 6px #f00;*/
			/*overflow: hidden;*/
			padding: 1.5em 0;
		}
	</style>
</head>
<body>
	<?php // echo $this->element('navigation'); ?>
	<?php //  echo $this->element('carousel'); ?>
		<div id="container" class="container">
			<?php echo $this->Flash->render(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>

		<?php
		echo  $this->Html->script(array("app.min"));
		// echo  $this->Html->script('jquery.bxslider.min');
		echo $this->fetch('script');
		?>

</body>
</html>
