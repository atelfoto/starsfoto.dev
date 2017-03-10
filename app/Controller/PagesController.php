<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {
/**
 * [$components description]
 * @var array
 */
	public $components = array('Paginator', 'Flash', 'Session','RequestHandler');
/**
 * This controller  use models Post and User
 *
 * @var array
 */
public $uses = array('Post','User');
/**
 * [index description]
 * @return [type] [description]
 */
public function index(){
	$d['pages']= $this->Post->find('all',array(
		'conditions'=> array('ref'=>'page',"Post.name"=>'index'
			)));
	$this->set($d);
}
/**
 * [servicios description]
 * @return [type] [description]
 */
public function servicios(){
	$d['pages']= $this->Post->find('all',array(
		'conditions'=> array('ref'=>'page',"Post.name"=>'servicios'
			)));
	$this->set($d);
}
/**
 * [legalinformation description]
 * @return [type] [description]
 */
public function legalinformation(){
	$d['pages']= $this->Post->find('all',array(
		'conditions'=> array('ref'=>'page',"Post.name"=>'legalinformations'
			)));
	$this->set($d);
}
/**
 * [sitemap description]
 * @return [type] [description]
 */
public function sitemap(){
	$this->loadModel('Portfolio');
	$portfolios = $this->Portfolio->find('all', array(
		'order' => array('Portfolio.created ASC'),
		"conditions"=>array(
			'online'=>1),
		"fields"=>array(
			'name',"created","slug")
		));
	$this->set(compact('portfolios'));
	$d['pages']= $this->Post->find('all',array(
		'conditions'=> array(
			'ref'=>'page',
			"Post.name"=>array('legalinformation',"servicios"),
			"online"=>1,
			)
		)
	);
	$this->set($d);
}
/**
 * [sitemapxml description]
 * @return [type] [description]
 */
public function sitemapxml(){
	$this->layout='ajax';
	$this->RequestHandler->respondAs('xml');
	$this->loadModel('Portfolio');
	$listPortfolios = $this->Portfolio->find('all',array(
		'conditions'=>array('online'=>1),
		'order'=> array('Portfolio.modified'=>'Desc')
		)
	);
	$this->loadModel('Post');
	$listpages = $this->Post->find('all',array(
		'conditions'=>array('online'=>1,"ref"=>'page','Post.name'=>array("legalinformation","servicios")),
		'order'=> array('Post.modified'=>'Desc')));
	return $this->set(compact('listPortfolios',"listpages"));
}

/**
 * [view description]
 * @param  [type] $slug [description]
 * @return [type]       [description]
 */
	public function view($slug=null) {
		if(!$slug)
			throw new NotFoundException(__('Aucune page ne correspond à cet ID'),array('class'=>'danger','type'=>'sign'));
		$page = $this->Post->find('first',array(
			'conditions'=>array('slug'=>$slug,'ref'=>'page')
			));
		if(empty($page))
			throw new NotFoundException(__('Aucune page ne correspond à cet ID'),array('class'=>'danger','type'=>'sign'));
		if($slug != $page['Post']['slug'])
			$this->redirect($page['Post']['link'],301);
		$d['page'] = current($page);
		$this->set($d);

	}

/**
 * [admin_index description]
 * @return [type] [description]
 */
	public function admin_index(){
		$this->paginate = array('Post'=>array(
			'limit'=>10,
			//'paramType'=> 'querystring' //
			));
		$d['pages'] = $this->Paginate('Post',array('ref'=>'page','online >= 0'));
		$this->set($d);

	}
	/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Post->create();
			if ($this->Post->save($this->request->data)) {
				 $this->Flash->success(__('The page  has been added.',h($id)),array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The page could not be added. Please, try again.'),array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->Post->User->find('list');
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
		if (!$this->Post->exists($id)) {
			throw new NotFoundException(__('Invalid post'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Post->save($this->request->data)) {
				$this->Flash->success(__('The page ID %s  has been edited.',h($id)), array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The page could not be edited. Please, try again.',h($id)), array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
			$this->request->data = $this->Post->find('first', $options);
		}
		$users = $this->Post->User->find('list');
		$this->set(compact('users'));
	}
/**
 * admin_enable method
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
public function admin_enable($id=null) {
	$post = $this->Post->read(null,$id);
	if (!$id && empty($post)) {
		$this->Flash->error(__('You must provide a valid ID number to enable a user.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if (!empty($post)) {
		$post['Post']['online'] = 1;
		if ($this->Post->save($post)) {
			$this->Flash->success(__('the page ID %s has been enabled.',h($id)));
		} else {
			$this->Flash->error(__('the page ID %s was not enabled.',h($id)),array('class'=>'danger','type'=>'sign'));
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
	$post = $this->Post->read(null,$id);
	if (!$id && empty($post)) {
		$this->Flash->error(__('You must provide a valid ID number to enable a user.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if (!empty($post)) {
		$post['Post']['online'] = 0;
		if ($this->Post->save($post)) {
			$this->Flash->success(__('User ID %s has been disabled.',h($id)));
		} else {
			$this->Flash->error(__('User ID %s was not disabled.',h($id)),array('class'=>'danger','type'=>'sign'));
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
		$this->Post->id = $id;
		if (!$this->Post->exists()) {
			throw new NotFoundException(__('Invalid post'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Post->delete()) {
			$this->Flash->success(__('The post has been deleted.'), array('class' => 'alert alert-success'));
		} else {
			$this->Flash->error(__('The post could not be deleted. Please, try again.'), array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}
