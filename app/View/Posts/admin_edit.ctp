<?php echo $this->assign('title', __('post')); ?>
 <?php $this->Html->addCrumb(__('post'),array('controller'=>'posts','action'=>'index','admin'=>true)); ?>
 <?php $this->Html->addCrumb('edit' ); ?>
<div class="posts index row">
	<div class="col-sm-12 page-header">
		<h3><i class="icon-posts"></i>&nbsp;<?php echo __('Admin Edit Post'); ?>		</h3>
	</div>
	<div class="col-sm-12">
		<div class="box box-primary  with-border nav-tabs-custom">
			<?php echo $this->Form->create('Post',array(
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
		 			<a href="#contenu" role="tab" data-toggle="tab" aria-controls="contenu">Contenu</a>
		 		</li>
		 		<li role="presentation">
		 			<a href="#publication" role="tab" data-toggle="tab" aria-controls="publication">publication</a>
		 		</li>
				<li class='pull-right'>
					<?php echo $this->html->link('<i class="icon-cancel-circled" style="color:#f00;">&nbsp;</i>'.__('closed'),
							array('controller'=>'posts','action'=>'index'),
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
					<?php echo $this->Form->input('id', array('type'=>"hidden"));?>
					<?php echo $this->Form->input('name', array('class' => 'form-control',
							 'placeholder' => __('Name'),
							 'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-name"></i></div>'
							 ));?>
					<?php echo $this->Form->input('slug', array('class' => 'form-control',
							 'placeholder' => __('Slug'),
							 'between'=>'<div class="input-group"><div class="input-group-addon"><i class="icon-slug"></i></div>'
							 ));?>
					<?php echo $this->Form->input('content', array("after"=>false
							 ));?>
					<?php echo $this->Form->input('modified_by', array('type'=>'hidden','value'=>$this->Session->read('Auth.User.username')
							 ));?>
				</div>
				<div class="tab-pane fade" role="tabpanel" id="publication">

				</div>
			</div>
			<div class="text-right box-footer" style="margin-top:10px;">
				<?php echo $this->Form->submit(__('publish'), array('div'=>false,'class' => 'btn btn-primary')); ?>
				<?php echo $this->html->link('<i class="icon-cancel-circled" style="color:#f00;">&nbsp;</i>'.__('closed'),
						array('controller'=>'posts','action'=>'index'),
						array('class' => 'btn btn-default','escape'=>false)); ?>
			</div>
			<?php echo $this->Form->end() ?>
		</div>
	</div><!-- end containers -->
</div>
<?php echo 	$this->Html->script(array('tinymce/tinymce.min'),array('inline'=>false)); ?>
<?php echo  $this->Html->scriptStart(array('inline'=>false)); ?>
//pour les tabs
$('#myTab a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});
//pour les toogle
  $(function() {
    $('#PostOnline').bootstrapToggle({
		size:'small',
		onstyle: 'primary',
		offstyle:'danger',
    });
  });
//pour le tinymce
tinyMCE.init({
selector: "#PostContent",
	entity_encoding : "raw",
	encoding: "UTF-8",
	theme: "modern",
	language :"fr_FR",
  	fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
    visualblocks_default_state: true,
    plugins: [
		"advlist autolink lists link image charmap  preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks code ",
		"media nonbreaking save table contextmenu ",
		"paste textcolor"
		],

	toolbar1: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ",
	toolbar2: " preview code | forecolor backcolor | media image |  visualblocks hr fontsizeselect | link unlink anchor ",
});
 <?= $this->Html->scriptEnd(); ?>
