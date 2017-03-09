<?php  echo $this->assign('title', __('home')); ?>
<div class="page-header">
	<h1>starsfoto </h1><br />
	<small>antonio rivas casado photographer <br />
	 	marbella
	 </small>
</div>
<?php foreach ($pages as $page): ?>
<div class="home">
	<?php echo $page['Post']['content'] ?>
</div>
<?php endforeach ?>
<div id="map" class="map " style="height: 500px;padding-left: 0;padding-right: 0;"></div>
<div class="clearfix"></div>

<?php echo $this->Html->script("https://maps.google.com/maps/api/js?key=AIzaSyB7l-WdKiQTz6zJB6131bqk3oVeS9p6HwA",array('inline'=>false)); ?>
<?= $this->Html->scriptStart(array('inline' => false)); ?>
jQuery(function ($) {
function init_map() {
// Basic options for a simple Google Map
// For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
var myLocation = new google.maps.LatLng(36.51044321955086,-4.889698215953899 );
var mapOptions = {
center: myLocation,
zoom: 15,
// Arrete le scroll avec la souris
					scrollwheel: false,
					streetViewControl: true,
//				zoomControl: false,
// mapTypeId: google.maps.MapTypeId.HYBRID
};
var marker = new google.maps.Marker({
position: myLocation,
title: "Les Maraîchers de la Coudraie"
});
var map = new google.maps.Map(document.getElementById("map"),
mapOptions);
marker.setMap(map);
}
init_map();
});
<?=  $this->Html->scriptEnd(); ?>
<?php  echo  $this->Html->scriptStart($options = array('inline'=>false)); ?>
(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src ="//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.5";
fjs.parentNode.insertBefore(js,fjs);}(document, 'script', 'facebook-jssdk'));
<?php echo  $this->Html->scriptEnd(); ?>

