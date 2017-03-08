<?php
App::uses('AppController', 'Controller');
/**
 * Carousels Controller
 *
 * @property Carousel $Carousel
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class CarouselsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * index method
 *
 * @return void
 */
public function slider(){
	$sliders = $this->Carousel->find('all'
		,array(
			'conditions'=>array('type'=>'image/jpeg','online'=>1),
			'fields'    =>array('name','photo','photo_dir','class','content')
			)
		);
	return $sliders;
}


/**
 * admin_index method
 *
 * @return void
 */
public function admin_index() {
	$actionHeading =__('carousel manager');
	$this->Carousel->recursive = 0;
	$this->paginate = array('Carousel'=>array(
		'limit'=>10,
		'order'=>array('Carousel.modified' => 'desc'),
		));
	$d['carousels'] = $this->Paginate('Carousel',array(
		'online >= 0'));
	$this->set($d);
	$this->set(compact('actionHeading'));
	//$this->set('carousels', $this->Paginator->paginate());
}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->layout='admin';
		if (!$this->Carousel->exists($id)) {
			throw new NotFoundException(__('Invalid carousel'));
		}
		$options = array('conditions' => array('Carousel.' . $this->Carousel->primaryKey => $id));
		$this->set('carousel', $this->Carousel->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		$this->layout='admin';
		$actionHeading =__('Add picture');
		if ($this->request->is('post')) {
			$this->Carousel->create();
			if ($this->Carousel->save($this->request->data)) {
				$this->Flash->success(__('The picture Id %s has added to your carousel.Please crop uour picture or close.',h($id)),array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'crop',$this->Carousel->id));
			} else {
				$this->Flash->error(__('The picture could not be added to your carousel. please correct your mistakes and try again.'),array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->Carousel->User->find('list');
		$this->set(compact('users','actionHeading'));
	}
/**
 * [admin_crop description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
public function admin_crop($id=null){
	$this->layout='admin';
	$options = array('conditions' => array('Carousel.' . $this->Carousel->primaryKey => $id));
	$this->set('carousel', $this->Carousel->find('first', $options));
	if($this->request->is('post')){
		if (!empty($this->request->data['h'])) {
			$targ_w = 925;
			$targ_h = 229;
			$targ_x = $this->request->data['x'];
			$targ_y = $this->request->data['y'];
			$img= $this->request->data['Carousel']['photo'];
			$jpeg_quality = $this->request->data['quality'];
			$src = WWW_ROOT .'files'.DS."carousel".DS."photo".DS. $id.DS.$img;
			$img_r = imagecreatefromjpeg($src);
			$dst_r = imagecreatetruecolor($targ_w, $targ_h);
			imagecopyresampled($dst_r,$img_r,0,0,$this->request->data['x'],$this->request->data['y'],
				$targ_w,$targ_h,$this->request->data['w'],$this->request->data['h']);
			imagejpeg($dst_r,WWW_ROOT .'files'.DS."carousel".DS."photo".DS. $id.DS."xvga_".$img,$jpeg_quality);
			$this->Flash->success(__(" Your picture ID %s is been cropped",h($id)), array('class'=>"success", "type"=>'ok'));
			return $this->redirect(array("action"=>"index",array("admin"=>true)));
		}else{
			$this->Session->setFlash(__("Please select a crop region again then press submit"), array('class'=>"danger", "type"=>'info'));
		}
	}

}
/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		$this->layout='admin';
		$actionHeading =__('edit');
		if (!$this->Carousel->exists($id)) {
			throw new NotFoundException(__('Invalid carousel'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Carousel->save($this->request->data)) {
				$this->Flash->success(__('The picture Id %s has been modified.',h($id)), array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The picture Id %s could not be modified. Please, try again.',h($id)), array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Carousel.' . $this->Carousel->primaryKey => $id));
			$this->request->data = $this->Carousel->find('first', $options);
		}
		$users = $this->Carousel->User->find('list');
		$this->set(compact('users',"actionHeading"));
	}
/**
 * [admin_active description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function admin_active($id=null) {
	$carousel = $this->Carousel->read(null,$id);
	if (!$id && empty($carousel)) {
		$this->Flash->error(__('You must provide a valid ID number to enable a post.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if (!empty($carousel)) {
		$this->Carousel->updateAll(array('Carousel.class' => "' '"));
		$this->Carousel->saveField('class', "active",false);
		$this->Carousel->saveField('online', 1,false);
		if ($this->Carousel->save($this->Carousel->saveField('class',"active",false))) {
			$this->Session->setFlash(__('The Picture %s has been activated in the first to your carousel.',h($id)),array('class'=>'success','type'=>'ok'));
		} else {
			$this->Session->setFlash(__('The picture  %s was not activated in the first to your carousel.Please try agin',h($id)),array('class'=>'danger','type'=>'sign'));
		}
		$this->redirect(array('action'=>'index'));
	} else {
		$this->Session->setFlash(__('No Carousel by that ID was found.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
}
/**
 * admin_enable method
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
public function admin_enable($id=null) {
	$carousel = $this->Carousel->read(null,$id);
	if (!$id && empty($carousel)) {
		$this->Flash->error(__('You must provide a valid ID number to enable a user.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if (!empty($carousel)) {
		$carousel['Carousel']['online'] = 1;
		if ($this->Carousel->save($this->Carousel->saveField('online', 1,false))) {
			$this->Flash->success(__('The picture %s has been published to your carousel.',h($id)));
		} else {
			$this->Flash->error(__('The picture %s was not published to your carousel.',h($id)),array('class'=>'danger','type'=>'sign'));
		}
		$this->redirect(array('action'=>'index'));
	} else {
		$this->Flash->error(__('No Carousel by that ID was found.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
}
/**
 * admin_disable method
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
public function admin_disable($id=null) {
	$carousel = $this->Carousel->read(null,$id);
	if (!$id && empty($carousel)) {
		$this->Flash->error(__('You must provide a valid ID number to enable a carousel.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if ($carousel['Carousel']['class']== 'active'){
		$this->Flash->error(__('you can not disable an active image please actived another image before'), array('class' => 'alert alert-danger'));
		return $this->redirect(array('action' => 'index'));
	}
	if (!empty($carousel)) {
		$carousel['Carousel']['online'] = 0;
		if ($this->Carousel->save($this->Carousel->saveField('online', 0,false))) {
			$this->Flash->success(__('The picture ID %s has been disabled to your carousel.',h($id)));
		} else {
			$this->Flash->error(__('the picture ID %s was not disabled to your carousel.',h($id)),array('class'=>'danger','type'=>'sign'));
		}
		$this->redirect(array('action'=>'index'));
	} else {
		$this->Flash->error(__('No Carousel by that ID was found.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
}
/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$carousel = $this->Carousel->read(null,$id);
		$this->Carousel->id = $id;
		if (!$this->Carousel->exists()) {
			throw new NotFoundException(__('Invalid carousel'));
		}
		if ($carousel['Carousel']['class']== 'active'){
			$this->Flash->error(__('You cannot delete an active image.Please select another image before.'), array('class' => 'alert alert-danger'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Carousel->delete()) {
			$this->Flash->success(__('The picture %s has been deleted to your carousel.',h($id)), array('class' => 'alert alert-success'));
		} else {
			$this->Flash->error(__('The picture %s could not be deleted. Please, try again.',h($id)), array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
