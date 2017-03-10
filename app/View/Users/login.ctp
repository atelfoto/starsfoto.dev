<?= $this->assign('title',__('Connexion')); ?>
<?php echo $this->Html->meta(array('name' => 'robots','content'=>"No index, no follow"),NULL,array("inline"=>false));; ?>
<div class=" login">
	<div class="media">
		<div class="media-left" style="padding: 20px;">
			<?php // echo  $this->Html->image("logo_thumb.jpg", array("class"=>"img-circle")); ?>
		</div>
		<div class="media-body" style="padding-top: 30px;">
			<h2 class="media-heading" style="color:#E98500 ;font-family:Tangerinebold;font-size:3.5em ;">Stars Foto</h2>
		</div>
	</div>
	<div class="panel-body">
		<?php  echo $this->Form->create(
			null, array('url' => array('controller' => 'users', 'action' => 'login'),
				'novalidate'=>true,
				'inputDefaults'=>array(
					'div'=>'form-group',
					'label'=>array(
						'class'=>'control-label col-md-3'
						),
					'after'=>'</div>',
					'error'=>array(
						'attributes' => array(
							'wrap' => 'span', 'class' => 'help-block text-danger'
							)
						),
					'class'=>'form-control col-md-9'
					),
				'class'=>'well form-horizontal'
				)
			);
			?>
			<fieldset class='text-center'>
				<?php echo $this->Form->input('username', array('class' => 'form-control',
					'placeholder' => __('username'),
					'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-user"></i></div>'
					));?>
				<?php echo $this->Form->input('password', array('class' => 'form-control',
					'placeholder' => __('password'),"type"=>"email",
					'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-password">&nbsp;</i></div>'
					));?>
			</fieldset>
			<button  type="submit" class="btn btn-primary btn-lg btn-block"> <?= __('Login'); ?></button>
				<?= $this->Form->end(); ?>
	</div>			
</div>
<div class="clearfix" style="padding-bottom: 25px;"></div>
