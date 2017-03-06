<?php echo $this->assign('title', __('menu')); ?>
 <?php $this->Html->addCrumb(__('menu'),array('controller'=>'menus','action'=>'index','admin'=>true)); ?>
 <?php $this->Html->addCrumb('edit' ); ?>
<div class="menus index row">
	<div class="col-sm-12 page-header">
		<h3><i class="icon-menus"></i>&nbsp;<?php echo __('Admin Edit Menu'); ?>		</h3>
	</div>
	<div class="col-sm-12">
		<div class="box box-primary  with-border nav-tabs-custom">
			<?php echo $this->Form->create('Menu',array(
				'novalidate'=>true,
				'inputDefaults'=>array(
				'div'=>'form-group',
				'label'=>array('class'=>'control-label'),
				'after'=>'</div>',
				'error'=>array('attributes' => array('wrap' => 'span', 'class' => 'help-block text-danger')),
				'class'=>'form-control'),
				'class'=>'')); ?>
			<ul class="nav nav-tabs" role="tablist">
		 		<li role="presentation" class="active">
		 			<a href="#contenu" role="tab" data-toggle="tab" aria-controls="contenu">contenu</a>
		 		</li>
		 		<li role="presentation">
		 			<a href="#publication" role="tab" data-toggle="tab" aria-controls="publication">publication</a>
		 		</li>
				<li class='pull-right'>
					<?php echo $this->html->link('<i class="icon-cancel-circled" style="color:#f00;">&nbsp;</i>'.__('closed'),
							array('controller'=>'menus','action'=>'index'),
							array('class' => 'btn btn-default','escape'=>false)); ?>
				</li>
				<li class='pull-right'>
					<?php echo $this->Form->button('<i class="icon-ok" style="color:#fff;">&nbsp;</i>'.__('publish'),
			 				array('class' => 'btn btn-success  pull-right')); ?>
				</li>
				<li class='pull-right'>
					<?php echo $this->Form->input('online', array('label' => false,'div'=>array('class'=>'pull-right'),
							'after'=>false)); ?>
				</li>
			</ul>
			<div class="tab-content box-body">
				<div class="tab-pane fade in active" role="tabpanel" id="contenu">
					<?php echo $this->Form->input('id', array('class' => 'form-control',
							 'placeholder' => __('Id'),
							 'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-id"></i></div>'
							 ));?>
					<?php echo $this->Form->input('name', array('class' => 'form-control',
							 'placeholder' => __('Name'),
							 'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-name"></i></div>'
							 ));?>
					<?php echo $this->Form->input('slug', array('class' => 'form-control',
							 'placeholder' => __('Slug'),
							 'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-slug"></i></div>'
							 ));?>
					<?php echo $this->Form->input('alias', array('class' => 'form-control',
							 'placeholder' => __('Alias'),
							 'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-alias"></i></div>'
							 ));?>
					<?php echo $this->Form->input('content', array('class' => 'form-control',
							 'placeholder' => __('Content'),
							 'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-content"></i></div>'
							 ));?>
					<?php echo $this->Form->input('user_id', array('type'=>"hidden",'value'=>$this->Session->read('Auth.User.id')
							 ));?>

				</div>
				<div class="tab-pane fade" role="tabpanel" id="publication">
					<?php echo $this->Form->input('description', array('class' => 'form-control',
							 'placeholder' => __('Description'),
							 'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-description"></i></div>'
							 ));?>
					<p id='compteur' class='text-right'><i>0 mots - 0 Caractere / 250</i></p>
					<?php echo $this->Form->input('robots', array('class' => 'form-control',
							 'placeholder' => __('Robots'),
							 'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-robots"></i></div>'
							 ));?>
					<?php echo $this->Form->input('keywords', array('class' => 'form-control',
							 'placeholder' => __('Keywords'),
							 'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-keywords"></i></div>'
							 ));?>
				</div>
			</div>
			<div class="text-right box-footer" style="margin-top:10px;">
				<?php echo $this->Form->submit(__('publish'), array('div'=>false,'class' => 'btn btn-primary')); ?>
				<?php echo $this->html->link('<i class="icon-cancel-circled" style="color:#f00;">&nbsp;</i>'.__('closed'),
						array('controller'=>'menus','action'=>'index'),
						array('class' => 'btn btn-default','escape'=>false)); ?>
			</div>
			<?php echo $this->Form->end() ?>
		</div>
	</div><!-- end containers -->
</div>
<?php echo  $this->Html->scriptStart(array('inline'=>false)); ?>
$(document).ready(function(e) {
  $('#MenuDescription').keyup(function() {
    var nombreCaractere = $(this).val().length;
    var nombreMots = jQuery.trim($(this).val()).split(' ').length;
    if($(this).val() === '') {
     	nombreMots = 0;
    }
    var msg = ' ' + nombreMots + ' mot(s) | ' + nombreCaractere + ' Caractere(s) / 160';
    $('#compteur').text(msg);
    if (nombreCaractere > 160) { $('#compteur').addClass("mauvais"); } else { $('#compteur').removeClass("mauvais"); }
  })
});
//pour les tabs
$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});
//pour les toogle
  $(function() {
    $('#MenuOnline').bootstrapToggle({
		size:'small',
		onstyle: 'primary',
		offstyle:'danger',
    });
  });
 <?= $this->Html->scriptEnd(); ?>
