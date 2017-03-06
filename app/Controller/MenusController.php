<?php
App::uses('AppController', 'Controller');
/**
 * Menus Controller
 *
 * @property Menu $Menu
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class MenusController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * [menu description]
 * @return [type] [description]
 */
	public function admin_menu(){
		$this->layout='admin';
		$this->Menu->recursive = 0;
		$menus = $this->Menu->find('all',array(
			'conditions'=>array('online'=>1),
			'fields'    =>array('name',"id",'controller','icon'),
			'order' =>array('name'=>"asc")
			));
		return $menus;
	}
/**
* admin_dashboard
**/
public function admin_dashboard(){
		$this->loadModel('User');
		$this->set('users_count', $this->User->find('count'));
		$users_total = $this->User->find('count');
		$this->set(compact("users_total"));
		$this->set('users_count',$this->User->find('count', array(
			'conditions' =>array('User.active'=>1))));

		$menus_total = $this->Menu->find('count');
		$this->set(compact("menus_total"));
		$this->set('menus_count',$this->Menu->find('count', array(
			'conditions' =>array('Menu.online'=>1))));

		$this->loadModel('Portfolio');
		$portfolios_total = $this->Portfolio->find('count');
		$this->set(compact('portfolios_total'));
		$this->set('portfolios_count', $this->Portfolio->find('count',array(
			'conditions'=>array("Portfolio.online"=>1))));

		$this->loadModel('Carousel');
		$carousels_total = $this->Carousel->find('count');
		$this->set(compact('carousels_total'));
		$this->set('carousels_count', $this->Carousel->find('count',array(
			'conditions'=>array("Carousel.online"=> 1))));
		$this->set('menus_count', $this->Menu->find('count'));
}
/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Menu->recursive = 0;
		$this->set('menus', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
		$this->set('menu', $this->Menu->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Menu->create();
			if ($this->Menu->save($this->request->data)) {
				$this->Flash->success(__('The menu has been saved.'),array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The menu could not be saved. Please, try again.'),array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->Menu->User->find('list');
		$this->set(compact('users'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Menu->exists($id)) {
			throw new NotFoundException(__('Invalid menu'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Menu->save($this->request->data)) {
				$this->Flash->success(__('The menu has been saved.'), array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The menu could not be saved. Please, try again.'), array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Menu.' . $this->Menu->primaryKey => $id));
			$this->request->data = $this->Menu->find('first', $options);
		}
		$users = $this->Menu->User->find('list');
		$this->set(compact('users'));
	}
/**
 * admin_enable method
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
public function admin_enable($id=null) {
	$menu = $this->Menu->read(null,$id);
	if (!$id && empty($menu)) {
		$this->Flash->error(__('You must provide a valid ID number to enable a user.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if (!empty($menu)) {
		$menu['Menu']['online'] = 1;
		if ($this->Menu->save($menu)) {
			$this->Flash->success(__('User ID %s has been published.',h($id)));
		} else {
			$this->Flash->error(__('User ID %s was not saved.',h($id)),array('class'=>'danger','type'=>'sign'));
		}
		$this->redirect(array('action'=>'index'));
	} else {
		$this->Flash->error(__('No user by that ID was found.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
}
/**
 * admin_disable method
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
public function admin_disable($id=null) {
	$menu = $this->Menu->read(null,$id);
	if (!$id && empty($menu)) {
		$this->Flash->error(__('You must provide a valid ID number to enable a user.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if (!empty($menu)) {
		$menu['Menu']['online'] = 0;
		if ($this->Menu->save($menu)) {
			$this->Flash->success(__('User ID %s has been published.',h($id)));
		} else {
			$this->Flash->error(__('User ID %s was not saved.',h($id)),array('class'=>'danger','type'=>'sign'));
		}
		$this->redirect(array('action'=>'index'));
	} else {
		$this->Flash->error(__('No user by that ID was found.',true),array('class'=>'danger','type'=>'sign'));
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
		$this->Menu->id = $id;
		if (!$this->Menu->exists()) {
			throw new NotFoundException(__('Invalid menu'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Menu->delete()) {
			$this->Flash->success(__('The menu has been deleted.'), array('class' => 'alert alert-success'));
		} else {
			$this->Flash->error(__('The menu could not be deleted. Please, try again.'), array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
