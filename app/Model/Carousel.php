<?php
App::uses('AppModel', 'Model');
/**
 * Carousel Model
 *
 * @property User $User
 */
class Carousel extends AppModel {
/**
 * [$components description]
 * @var array
 */
	public $components = array("RequestHandler");

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules  notBlank
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				'message' => 'Name is required',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique'=>array(
				'rule'=>'isUnique',
				"message"=>' This name has already been chosen.'
			)
		),
		'photo' => array(
        	'uploadError' => array(
				'rule' => 'uploadError',
				'message' => ' Something is wrong, try again',
				'on' => 'create'
			),
	    	'isUnderPhpSizeLimit' => array(
	    		'rule' => 'isUnderPhpSizeLimit',
	        	'message' => 'File exceeds the size limit upload file'
	        ),
		     'isValidMimeType' => array(
	    	 	'rule' => array('isValidMimeType', array('image/jpeg', 'image/png'), false),
         	'message' => 'The picture is not jpg or png',
	    	 ),
		     // 'isBelowMaxSize' => array(
	    	 // 	'rule' => array('isBelowMaxSize', 1048576),
       //  	'message' => 'The image size is too large'
	    	 // ),
		     'isValidExtension' => array(
	    	 	'rule' => array('isValidExtension', array('jpg', 'png','jpeg'), false),
    		   	'message' => 'The image does not have the extension jpg or png'
	    	 ),
			 'checkUniqueName' => array(
   		    	 'rule' => array('checkUniqueName'),
   		    	 'message' => 'The image is already registered',
   		    	 'on' => 'update'
      		),
        ),
	);
/**
 * [checkUniqueName: Donne un nom unique à la photo avec le plugin upload]
 * @param  [type] $data [description]
 * @return [type]       [description]
 */
	function checkUniqueName($data)	{
	    $isUnique = $this->find('first', array('fields' => array('Carousel.photo'), 'conditions' => array('Carousel.photo' => $data['photo'])));

	    if(!empty($isUnique)) {
	        return false;
	    }
	    else {
	        return true;
	    }
	}
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
 * [$actsAs description]
 * @var array
 */
	public $actsAs = array(
			'Upload.Upload' => array(
			'photo' => array(
					'fields' => array(
						'dir' => 'photo_dir'
					),
					'thumbnailMethod' => 'php',
					'thumbnailSizes' => array(
						"xvga"=>"925x229",
						'vga' => '640x160',
						'thumb' => '302x75'
					),
					'deleteOnUpdate' => true,
					'deleteFolderOnDelete' => true
				),
			)
		);
}
