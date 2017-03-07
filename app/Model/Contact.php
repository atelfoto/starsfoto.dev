<?php
App::uses('FrValidation', 'Localized.Validation');
 class Contact extends AppModel {

 	public $useTable =false;
 	public $validate = array(
 		'name'=> array(
 			"notBlank"=>array(
 				'rule' => 'notBlank',
 				'required' => true,
 				'message'=> 'you must enter your name'),
 			'between' => array(
 				'rule'    => array('lengthBetween', 5, 15),
 				'message' => 'Between 5 to 15 characters'
 				)
 			),
 		'email' => array(
 			'rule' => 'email',
 			'required' => true,
 			'message' => 'You must enter a valid email address'
 			),
 		'phone' => array(
 			'rule' => array('phone', null, 'fr'),
 			'message'=>'Must be valid french phone numero '
 			),
 		'mobile' => array(
 			'rule' => 'numeric',
 			'required' => false,
 			'message' => 'You must enter a numero mobile ',
 			"allowEmpty"=>true,
 			),
 		'message' => array(
 			'rule' => 'notBlank',
 			'required' => true,
 			'message' => 'You must enter your message'
 			),
 		'subject' => array(
 			'rule' => 'notBlank',
 			'required' => true,
 			'message' => 'This field can not stay empty. Plase choose a subject'
 			),
 		);
 	public function send($d){
 		$this->set($d);
 		if ($this->validates()) {
 		 	App::uses('CakeEmail','Network/Email');
 		 	//$mail = new CakeEmail();//en ligne
 		 	$mail = new CakeEmail("smtp"); // smtp en local pour les tests sinon default en ligne
 			$mail->to(array('atelfoto@msn.com'))
 			 	 ->from($d['email'],$d['name'])
 			 	 ->subject($d['subject'])
 			 	 ->emailFormat('html')
 			 	 ->template('contact')->viewVars($d);
 			return $mail->send();
 		}else{
 			return false;
 		}
 	}

 }
