<?php
App::uses('AppController', 'Controller');
class ContactsController extends AppController{
	public $components = array ('Session','Security',"Flash");
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index');
	}
	function index(){
		if($this->request->is('post')){
		if (!empty($this->request->data['Contact']['website'])) {
			$this->Flash->success(__("Your Mail us is reached."),array('class'=>"success alert-success",'type'=>'ok-sign'));
			$this->request->data = array();
		}else{
 				if($this->Contact->send($this->request->data['Contact'] )){
 					$this->Flash->success(__("Thank you.Your Mail Us is reached."),array('class'=>"success alert-success", 'type'=>'ok-sign'));
 					$this->request->data = array();
 				} else{
					$this->Flash->error(__("Thank you to correct your fields."),array('class'=>'alert alert-danger', 'type'=>'info-sign'));
 				}
			}
		}
	}
}
