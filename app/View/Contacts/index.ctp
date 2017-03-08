<?= $this->assign('title', __('Contact Us')); ?>
<?php echo $this->Html->meta(array('name' => 'robots', 'content' => "index , follow"),NULL,array("inline"=>false)); ?>
<?php  $this->Html->meta('description', "Si vous avez des questions, n'hésitez pas à nous contacter." , array('inline'=> false));
echo $this->Html->meta('canonical', 'http://'.env("HTTP_HOST").'/contact', array('rel'=>'canonical', 'type'=>null, 'title'=>null, 'inline' => false)
); ?>
<?php $this->Html->addCrumb("contact"); ?>
<h2>contact</h2>
<?php echo $this->Form->create(
	'Contact',array(
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
			//"wrapInput"=> 'col-md-9',
			'class'=>'form-control col-md-9'
			),
		'class'=>'well form-horizontal'
		)
	);
	?>
	<fieldset class='text-center'>
		<?php echo $this->Form->input('name', array('class' => 'form-control',
			'placeholder' => __('Name'),
			'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-user"></i></div>'
			));?>
		<?php echo $this->Form->input('email', array('class' => 'form-control',
			'placeholder' => __('Your Email'),"type"=>"email",
			'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-mail"></i></div>'
			));?>
		<?php echo $this->Form->input('phone', array('class' => 'form-control',
			'placeholder' => __('Your Phone'),
			'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-phone"></i></div>'
			));?>
		<?php echo $this->Form->input('mobile', array('class' => 'form-control',
			'placeholder' => __('Your Mobile'),'type'=>'tel',
			'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-mobile"></i></div>'
			));?>
		<?php echo $this->Form->input('subject', array('class' => 'form-control',
			'empty'=> __('Choose the subject of your message:'),'type'=>"select",
			"options"=>array(
				'Visite Guidée'=>"Visite Guidée",
				'Chasse au Trésor'=>"Chasse au Trésor",
				'Location de Salle'=>"Location de Salle",
				'stages en développement touristique'=>'stages en développement touristique',
				"Autres"=>"Autres"
				),
			'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-category_id"></i></div>'
			));?>
		<?php echo $this->Form->input('message', array('class' => 'form-control ',
			'placeholder' => __('Enter Your message...'),'type'=>'textarea',
			"after"=>false
			));?>
		<?php echo $this->Form->input('website', array('class' => 'form-control website',
			"after"=>false,'label'=>false
			));?>
		<p class='text-left'><i class="fa fa-asterisk"></i>&nbsp;<?= __('Required field:'); ?></p>
	</fieldset>
	<div class="text-right">
		<?php echo $this->Form->button(__('Reset') , array('class'=>"btn btn-default",'type'=>'reset')); ?>
		<?php echo $this->Form->button(__('Sent').' <i class="icon-right-circled"></i>',
		array('type'=>"submit","class"=>"btn btn-primary","escape"=>false)); ?>
	</div>
<?= $this->Form->end(); ?>

