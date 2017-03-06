<?php
App::uses('AppModel', 'Model');
/**
 * Menu Model
 *
 * @property User $User
 */
class Menu extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
/**
 * [$actsAs description plugi sluggable pour faire le champ slug automatiquement]
 * @var array
 */
	public $actsAs = array(
		'Sluggable.Sluggable' => array(
	        'field'     => 'name',  // Field that will be slugged
	        'slug'      => 'slug',  // Field that will be used for the slug
	        'lowercase' => true,    // Do we lowercase the slug ?
	        'separator' => '-',     //
	        'overwrite' => false    // Does the slug is auto generated when field is saved no matter what
		),
		"Containable"
	);
/**
 * construire le champs controller au pluriel selon le champ name
 * @param  array  $options [description]
 * @return [type]          [description]
 */
	public function beforeSave($options= array()) {
				if (empty($this->data['post']['controller'])  && !empty($this->data['Menu']['name']))
					$this->data['Menu']['controller'] = strtolower(Inflector::pluralize($this->data['Menu']['name']	));
					$this->data['Menu']['controller']= Inflector::slug($this->data['Menu']['controller'],'_' );
				return true;
			}
}
