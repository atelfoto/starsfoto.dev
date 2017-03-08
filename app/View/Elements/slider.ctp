<?php  $sliders=$this->requestAction(array('controller'=>'carousels','action'=>'slider','admin'=>false)); ?>
<?php   foreach ($sliders as $k => $v): $v = current($v); ?>
	<li>
		<?php echo  $this->Html->image('/files/carousel/photo/'.$v["photo_dir"].'/'.$v["photo"], array('alt'=> "","width"=>"auto","height"=>"229", "class"=>"center-block")); ?>
	</li>
<?php   endforeach ?>

<?php // foreach ($sliders as $k => $v): $v = current($v); ?>
  <!--<li>	<picture>
 <source media="(max-width: 480px)"
            srcset="/files/carousel/photo/<?php // echo $v['photo_dir']; ?>/vga_<?php // echo $v['photo'] ?>"> -->

  <!-- <source media="(max-width: 750px)"
            srcset="/files/carousel/photo/<?php // echo $v['photo_dir']; ?>/xvga_<?php // echo $v['photo'] ?>">

</picture>
</li>-->

<?php // endforeach ?>
