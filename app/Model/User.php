<?php
App::uses('AppModel', 'Model');
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');
//App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 * @property Help $Help
 * @property Menu $Menu
 * @property Post $Post
 * @property Property $Property
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'firstname';
	// public $displayField = 'name';
/**
 * [beforeSave description]
 * @param  array  $options [description]
 * @return [type]          [description]
 */
public function beforeSave($options = array()) {
    if (isset($this->data[$this->alias]['password'])) {
        $passwordHasher = new SimplePasswordHasher();
        $this->data[$this->alias]['password'] = $passwordHasher->hash(
            $this->data[$this->alias]['password']
        );
    }
    return true;
}
/**
 * [afterSave description]
 * @param  [type] $created [description]
 * @param  [type] $options [description]
 * @return [type]          [description]
 */
/**
 * afterSave callback
 *
 * @param $created boolean
 * @param $options array * @return void
 */

public function afterSave($created, $options = Array()){
	if(!empty($this->data[$this->alias]['avatarf']['tmp_name'])){
		$file = $this->data[$this->alias]['avatarf'];
		$dest = WWW_ROOT . 'img' .DS. 'avatars' . DS . ceil($this->id/1000);
		if(!file_exists($dest)){
			mkdir($dest, 0777, true);
		}
		require APP . 'Vendor' . DS . 'autoload.php';
		$imagine = new Imagine\Gd\Imagine();
		try{
			$imagine
			->open($file['tmp_name'])
			->thumbnail(
				new Imagine\Image\Box(90, 90),
				Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND)
			->save($dest . DS . $this->id . '_thumb.jpg');
			$imagine
			->open($file['tmp_name'])
			->thumbnail(
				new Imagine\Image\Box(45, 45),
				Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND)
			->save($dest . DS . $this->id . '_mini.jpg');
			$imagine
			->open($file['tmp_name'])
			->resize(
				new Imagine\Image\Box(150,217))
			->save($dest . DS . $this->id . '.jpg');
		}catch(Imagine\Exception\Exception $e){
             //   debug($e);
		}
	}
}
/**
 * [identicalFields description]
 * @param  [type] $check [description]
 * @param  [type] $limit [description]
 * @return [type]        [description]
 */
	public function identicalFields($check, $limit){
        $field = key($check);
        return $check[$field] == $this->data['User']['password'];
    }
/**
 * [isJpg description]
 * @param  [type]  $check [description]
 * @param  [type]  $limit [description]
 * @return boolean        [description]
 */
	public function isJpg($check, $limit){
		$field = key($check);
		$filename= $check[$field]['name'];
		if(empty($filename)){
			return true;
		}
		$info = pathinfo($filename);
		return strtolower($info['extension']) == 'jpg';
	}
/**
 * [afterFind description]
 * @param  [type]  $results [description]
 * @param  boolean $primary [description]
 * @return [type]           [description]
 */
	function afterFind($results, $primary = false){
		foreach($results as $k => $result){
			if(isset($result[$this->alias]['avatar']) && isset($result[$this->alias]['id'])){
				$results[$k][$this->alias]['avatari'] = 'avatars/'.ceil($result[$this->alias]['id']/1000).'/'.$result[$this->alias]['id'].'.jpg';
				$results[$k][$this->alias]['avatart'] = 'avatars/'.ceil($result[$this->alias]['id']/1000).'/'.$result[$this->alias]['id'].'_thumb.jpg';
				$results[$k][$this->alias]['avatarm'] = 'avatars/'.ceil($result[$this->alias]['id']/1000).'/'.$result[$this->alias]['id'].'_mini.jpg';
			}
		}
		return $results;
	}

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'This field must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			"unique"=>array(
				'rule'=> 'isUnique',
				'message'=> 'This username is already used'
			)
		),
		'mail' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'You must enter a valid email address',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'This field must not be empty',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'You must specify a password',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password2' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'You must confirm your password',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'identicalFields' => array(
				'rule' => array('identicalFields'),
				'message' => 'This password is not identical',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'avatarf' => array(
			'rule' => 'isJpg',
			'message' => 'You must send a jpg'
			)
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Help' => array(
			'className' => 'Help',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Menu' => array(
			'className' => 'Menu',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
