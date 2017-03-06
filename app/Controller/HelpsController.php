<?php
App::uses('AppController', 'Controller');
/**
 * Helps Controller
 *
 * @property Help $Help
 * @property PaginatorComponent $Paginator
 * @property FlashComponent $Flash
 * @property SessionComponent $Session
 */
class HelpsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session');

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Help->recursive = 0;
		$this->set('helps', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Help->exists($id)) {
			throw new NotFoundException(__('Invalid help'));
		}
		$options = array('conditions' => array('Help.' . $this->Help->primaryKey => $id));
		$this->set('help', $this->Help->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Help->create();
			if ($this->Help->save($this->request->data)) {
				$this->Flash->success(__('The help has been saved.'),array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The help could not be saved. Please, try again.'),array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->Help->User->find('list');
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
		if (!$this->Help->exists($id)) {
			throw new NotFoundException(__('Invalid help'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Help->save($this->request->data)) {
				$this->Flash->success(__('The help has been saved.'), array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The help could not be saved. Please, try again.'), array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Help.' . $this->Help->primaryKey => $id));
			$this->request->data = $this->Help->find('first', $options);
		}
		$users = $this->Help->User->find('list');
		$this->set(compact('users'));
	}
/**
 * admin_enable method
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
public function admin_enable($id=null) {
	$help = $this->Help->read(null,$id);
	if (!$id && empty($help)) {
		$this->Flash->error(__('You must provide a valid ID number to enable a user.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if (!empty($help)) {
		$help['Help']['online'] = 1;
		if ($this->Help->save($help)) {
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
	$help = $this->Help->read(null,$id);
	if (!$id && empty($help)) {
		$this->Flash->error(__('You must provide a valid ID number to enable a user.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if (!empty($help)) {
		$help['Help']['online'] = 0;
		if ($this->Help->save($help)) {
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
		$this->Help->id = $id;
		if (!$this->Help->exists()) {
			throw new NotFoundException(__('Invalid help'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Help->delete()) {
			$this->Flash->success(__('The help has been deleted.'), array('class' => 'alert alert-success'));
		} else {
			$this->Flash->error(__('The help could not be deleted. Please, try again.'), array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
