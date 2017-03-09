<?php echo $this->Html->meta(array('name' => 'robots', 'content' =>$post['Post']['robots']),NULL,array("inline"=>false)); ?>
<?php  $this->Html->meta('description', $this->Text->truncate($post['Post']['description'], 300, array("exact"=>false)),array('inline' => false)); ?>
<?php echo $this->Html->meta(array('property' => 'og:type', 'type' => 'meta', 'content' => "article" ),NULL,array("inline"=>false)); ?>
<?php echo $this->Html->meta(array('property' => 'og:title', 'type' => 'meta', 'content' => $post['Post']['name']),NULL,array("inline"=>false)); ?>
<?php echo $this->Html->meta(array('property' => 'og:url', 'type' => 'meta', 'content' =>
"http://".env('HTTP_HOST')."/post/".$post['Post']['slug'] ),NULL,array("inline"=>false));  ;?>
<?php echo $this->Html->meta(array('property' => 'og:description', 'type' => 'meta', 'content' =>
	$this->Text->truncate($post['Post']['description'], 200, array("exact"=>false))),NULL,array("inline"=>false));  ;?>
<?php echo $this->Html->meta(array('name'=>'twitter:card','content'=>"summary"),NULL,array('inline'=>false));  ;?>
<?php echo $this->Html->meta(array('name'=>'twitter:title','content'=>"château de chazeron ".$post['Post']['name']),NULL,array('inline'=>false));  ;?>
<?php echo $this->Html->meta(array('name'=>'twitter:url','content'=>"http://".env('HTTP_HOST')."/post/".$post['Post']['slug']),NULL,array('inline'=>false)); ?>
<?php echo $this->Html->meta(array('name' => 'twitter:description','content'=>
$this->Text->truncate($post['Post']['description'], 160, array("exact"=>false))
),NULL,array("inline"=>false)); ;?>
<?php  echo $this->Html->meta(array('name'=>'twitter:image','content'=>"http://".env('HTTP_HOST')."/img/summary.jpg"),NULL,array('inline'=>false));?>

<?php $this->assign('title',$post['Post']['name']);
$this->Html->addCrumb(__('Post'),array("controller"=>"posts","action"=>"index"));
$this->Html->addCrumb( $post['Post']['name']);  ?>
<div class="container container-">
	<div class=" page-content">
		<h2> <?php echo $post['Post']['name'] ?></h2>
		 <?php echo $post['Post']['content'] ?>
	</div>
	<hr class="style-two">
</div>
