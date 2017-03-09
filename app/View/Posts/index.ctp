<?php echo $this->assign('title', __('Posts')); ?>
 <?php $this->Html->addCrumb(__('Posts')); ?>
 <div class="posts index row">
	<div class="col-md-12 page-header">
		<h2><i class="icon-posts"></i>&nbsp;<?php echo __('Posts'); ?></h2>
	</div>
	<div class="col-md-12">
		<div class="text-right" style='margin-bottom:10px;'>
			<button class="btn " data-toggle="modal" data-target="#ModalAide">
			<i class="fa fa-question-circle">&nbsp;Aide</i>
			</button>
				<?php echo $this->Html->link("<i class='icon-plus'></i>". __("Add article"),array('action'=>'add'),
				array('class' =>"btn btn-success ",'escape'=>false)); ?>
		</div>
		<div class="panel table-responsive box-home">
			<table  class="table table-bordered text-center table-striped">
				<thead>
					<tr class="info">
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('name'); ?></th>
						<th><?php echo $this->Paginator->sort('slug'); ?></th>
						<th><?php echo $this->Paginator->sort('content'); ?></th>
						<th><?php echo $this->Paginator->sort('ref'); ?></th>
						<th><?php echo $this->Paginator->sort('online'); ?></th>
						<th><?php echo $this->Paginator->sort('intro'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th><?php echo $this->Paginator->sort('modified_by'); ?></th>
						<th><?php echo $this->Paginator->sort('category_id'); ?></th>
						<th><?php echo $this->Paginator->sort('media_id'); ?></th>
						<th><?php echo $this->Paginator->sort('home'); ?></th>
						<th colspan="3" class="actions"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($posts as $post): ?>
					<tr>
						<td><?php echo h($post['Post']['id']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['name']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['slug']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['content']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['ref']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['online']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['intro']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['created']); ?>&nbsp;toto</td>
								<td>
			<?php echo $this->Html->link($post['User']['firstname'],
									array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
		</td>
						<td><?php echo h($post['Post']['modified']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['modified_by']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['category_id']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['media_id']); ?>&nbsp;toto</td>
						<td><?php echo h($post['Post']['home']); ?>&nbsp;toto</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="fa fa-eye"></span>',
					 array('action' => 'view', $post['Post']['id']), array('class'=>'btn btn-default','escape' => false)); ?>
						</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="fa fa-pencil"></span>',
					 array('action' => 'edit', $post['Post']['id']), array('class'=>'btn btn-default','escape' => false)); ?>
						</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="fa fa-trash"></span>',
								'#Modal'.$post['Post']['id'],
									array('class'=>'btn btn-default btn-remove-modal',
									'escape' => false,
									'data-toggle' =>'modal',
									'role'=>'button',
									'data-uid'=>$post['Post']['id']
									)
							 ); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="col col-md-12 text-center">
			<?php echo $this->element('pagination'); ?>
			<?php  echo $this->element("pagination-counter"); ?>		</div>
	</div>
</div><!-- end containing of content -->



