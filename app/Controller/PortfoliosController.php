<?php
App::uses('AppController', 'Controller');
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
/**
 * Portfolios Controller
 *
 * @property Portfolio $Portfolio
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PortfoliosController extends AppController {
/**
 * Components
 *
 * @var array
 */
	public $components = array('RequestHandler',"Flash");
	public $cacheAction = array(
		// 'index'=>'2 DAY',
		 'view'=>'2 DAY'
		);

	// public function menu(){
	// 	$this->Portfolio->recursive = 0;
	// 	$portfolios = $this->Portfolio->find('all',array(
	// 		'conditions'=>array('online'=>1),
	// 		'fields'    =>array('slug','name')
	// 		));
	// 	return $portfolios;
	// }
	// public function sidebar(){
	// 	return $this->Portfolio->find('all');
	// }
public function sidebar() {
        $portfolios = $this->paginate();
        if ($this->request->is('requested')) {
            return $portfolios;
        }
        $this->set('portfolios', $portfolios);
    }
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Portfolio->recursive = 0;
		$this->loadModel('Menu');
		$menus= $this->Menu->find('first', array(
			'conditions' => array('Menu.controller' => "portfolios")
			));
		$this->set(compact('menus'));
		$this->paginate = array('Portfolio'=>array(
			'limit'=>6,
			));
		$this->set('portfolios',$this->paginate('Portfolio',array('online >=1')));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */

	public function view($slug) {
		// $this->layout="portfolio";
	    if(empty($slug)) {
	        throw new NotFoundException();
	    }
	    $portfolio = $this->Portfolio->find('first', array(
	        'conditions' => array('Portfolio.slug' => $slug),
	    ));
	    if(!$portfolio){
	        throw new NotFoundException();
	    }
	    if ($slug != $portfolio['Portfolio']['slug'] || $portfolio['Portfolio']['online'] != 1 ) {
			header("Status: 301 Moved Permanently", false, 301);
			$this->redirect($this->referer());
	    }
		$this->Flash->info(__('Clic sur la flèche gauche pour revenir en arrière.'),  array('class' => 'alert alert-info' ,"type"=>"info"));
	    $this->set(compact('portfolio'));
	}

/**
 * admin_index method
 *
 * @return void
 */

	public	function admin_index(){
		$actionHeading =__('portfolio manager');
		$this->Portfolio->recursive = 0;
		$this->paginate = array('Portfolio'=>array(
			'limit'=>6,
			'order'=>array('Portfolio.modified' => 'desc'),
			));
		$d['portfolios'] = $this->Paginate('Portfolio',array(
			'online >= 0'));
		$this->set($d);
		$this->set(compact('actionHeading'));
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Portfolio->exists($id)) {
			throw new NotFoundException(__('Invalid portfolio'));
		}
		$options = array('conditions' => array('Portfolio.' . $this->Portfolio->primaryKey => $id));
		$this->set('portfolio', $this->Portfolio->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
public function admin_add() {
	$actionHeading = __('Add photo gallery');
	if ($this->request->is('post')) {
		$this->Portfolio->create();
		if ($this->Portfolio->save($this->request->data)) {
			$slug= Inflector::slug($this->request->data['Portfolio']['name'],'-');
			$dir = WWW_ROOT .'files'.DS.'portfolio'.DS.$slug;
			if(!file_exists($dir))
				mkdir($dir, 0777);
			Cache::clear();
			foreach(glob(CACHE.'views'.DS.'galerie_photos.php') as $file){
				unlink($file);
			}
			$this->Flash->success(__('The portfolio has been saved.'),  array('class' => 'alert alert-success'));
			return $this->redirect(array('action' => 'upload',$this->Portfolio->id));
		} else {
			$this->Flash->error(__('The portfolio could not be saved. Please, try again.'),  array('class' => 'alert alert-danger'));
		}
	}
	$users = $this->Portfolio->User->find('list');
	$this->set(compact('users','actionHeading'));
}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function admin_edit($id = null) {
	$actionHeading = __('edit gallery photo');
	if (!$this->Portfolio->exists($id)) {
		throw new NotFoundException(__('Invalid portfolio'));
	}
	if ($this->request->is(array('post', 'put'))) {
		if ($this->Portfolio->save($this->request->data)) {
			Cache::clear();
			foreach(glob(CACHE.'views'.DS.'galerie_photos_*.php') as $file){
				unlink($file);
			}
			foreach(glob(CACHE.'views'.DS.'galerie_photos.php') as $file){
				unlink($file);
			}
			$this->Flash->success(__('The portfolio has been saved.'),  array('class' => 'alert alert-success'));
			 return $this->redirect(array('action' => 'index'));
		} else {
			$this->Flash->error(__('The portfolio could not be saved. Please, try again.'),  array('class' => 'alert alert-danger'));
		}
	} else {
		$options = array('conditions' => array('Portfolio.' . $this->Portfolio->primaryKey => $id));
		$this->request->data = $this->Portfolio->find('first', $options);
	}
	$this->set(compact("actionHeading"));
}

/**
* admin_upload
**/
 	public function admin_upload($id=null,$slug=null){
		$options = array('conditions' => array('Portfolio.' . $this->Portfolio->primaryKey => $id));
		$this->set('portfolio', $this->Portfolio->find('first', $options));
		$this->Portfolio->id = $id;
		$portfolio = $this->Portfolio->read(null,$slug);
		$slug = $portfolio['Portfolio']['slug'];//'mon-album-3'
		$folderPortfolio = WWW_ROOT .'files'.DS.'portfolio'.DS.$slug.DS;// 'D:\wamp\www\chateau-chazeron.dev\app\webroot\files\portfolio\mon-album-3\'
		$images = new Folder($folderPortfolio.'images',true,0777);//
		$images = $folderPortfolio.'images';//'D:\wamp\www\chateau-chazeron.dev\app\webroot\files\portfolio\mon-album-3\images'
		$thumbs= new Folder($folderPortfolio.'thumbs',true,0777);
		$thumbs = $folderPortfolio.'thumbs';//'D:\wamp\www\chateau-chazeron.dev\app\webroot\files\portfolio\mon-album-3\thumbs'
		if (!empty($this->request->data)) {
			$this->set('_serialize',array('portfolios'));
			$imageName = $this->request->data['Portfolio']['photo'][0]['name'];//'694150.jpg'
			$extension = strtolower(pathinfo($imageName,PATHINFO_EXTENSION));//'jpg'
			if (file_exists($images.'/'.$imageName)) {
				$imageName = date('His'). $imageName;
			}
			if (!empty($this->request->data['Portfolio']['photo'][0]['tmp_name'])&&	in_array($extension, array('jpg','jpeg'))) {
				$j=1;
				$counts= count(glob($images.'/*.jpg'));//voir pour les images jpeg
				$imageName = $counts +1;//1
				$imageName = $id.'-'.sprintf('%02d',$imageName).".jpg";
				list($width,$height)=getimagesize($this->request->data['Portfolio']['photo'][0]['tmp_name']);
				require APP.'Vendor'.DS.'autoload.php';
				$imagine = new Imagine\Gd\Imagine();
				if ($width>$height) {
					try{
						$imagine
						->open($this->request->data['Portfolio']['photo'][0]['tmp_name'])
						->resize(
							new Imagine\Image\Box(800,533))
						->save($images.DS.$imageName);
						$imagine
						->open($this->request->data['Portfolio']['photo'][0]['tmp_name'])
						->thumbnail(
							new Imagine\Image\Box(170,113),
							Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND)
						->save($thumbs.DS.$imageName);
					}catch(Imagine\Exception\Exception $e){
						debug($e);
					}
					try{
						$watermark = $imagine->open(WWW_ROOT .'img'.DS.'watermark.png');
						$imagine
						->open($images.'/'.$imageName)
						->paste($watermark, new Imagine\Image\Point(800 - 200, 533 - 160))
						->save($images.'/'.$imageName);
					} catch (Imagine\Exception\Exception $e) {
						debug($e);
					}
				}else{
					try{
						$imagine
						->open($this->request->data['Portfolio']['photo'][0]['tmp_name'])
						->resize(
							new Imagine\Image\Box(533,800))
						->save($images.DS.$imageName);
						$imagine
						->open($this->request->data['Portfolio']['photo'][0]['tmp_name'])
						->thumbnail(
							new Imagine\Image\Box(113,170),
							Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND)
						->save($thumbs.DS.$imageName);
					}catch(Imagine\Exception\Exception $e){
						debug($e);
					}
					try{
						$watermark = $imagine->open(WWW_ROOT .'img'.DS.'watermark.png');
						$imagine
						->open($images.'/'.$imageName)
						->paste($watermark, new Imagine\Image\Point(533 - 200, 800 - 160))
						->save($images.'/'.$imageName);
					} catch (Imagine\Exception\Exception $e) {
						debug($e);
					}
				}
			}
			return true;
		}
		if ($this->request->is(array('post','put'))) {
			$this->Flash->success(__('The portfolio has been uploaded.'),  array('class' => 'alert alert-success'));
		}
	}

/**
* configxml
**/
public function configxml($id=null,$slug=null){
	$this->layout="ajax";
	$this->RequestHandler->respondAs('xml');
	$options = array('conditions' => array('Portfolio.' . $this->Portfolio->primaryKey => $id));
	$this->set('portfolio', $this->Portfolio->find('first', $options));
	$this->Portfolio->id = $id;
	$portfolio = $this->Portfolio->read(null,$slug);
	$slug = $portfolio['Portfolio']['slug'];
	$folder= WWW_ROOT .'files'.DS.'portfolio'.DS.$slug.DS;
	$counts= count(glob(WWW_ROOT .'files'.DS.'portfolio'.DS.$slug.DS.'images/*.jpg'));
	$xmlversion='<?xml version="1.0" encoding="UTF-8"?>';
	return $this->set(compact('portfolios','counts',"xmlversion"));
}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
public function admin_delete($id = null) {
	$this->Portfolio->id = $id;
	if (!$this->Portfolio->exists()) {
		throw new NotFoundException(__('Invalid portfolio'));
	}
	$this->request->onlyAllow('post', 'delete');
	if ($this->Portfolio->delete()) {
		Cache::clear();
		//foreach(glob(CACHE.'models'.DS.'myapp_cake_model_default_chateauccxbdchaz_portfolios') as $file){
		//	unlink($file);
		//}
		foreach(glob(CACHE.'views'.DS.'galerie_photos.php') as $file){
			unlink($file);
		}
		$this->Flash->success(__('The portfolio has been deleted.'),  array('class' => 'alert alert-success'));
	} else {
		$this->Flash->error(__('The portfolio could not be deleted. Please, try again.'),  array('class' => 'alert alert-danger'));
	}
	return $this->redirect(array('action' => 'index'));
}
/**
 * [admin_enable description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function admin_enable($id=null) {
	$portfolio = $this->Portfolio->read(null,$id);
	if (!$id && empty($portfolio)) {
		$this->Flash->error(__('You must provide a valid ID number to enable a post.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if (!empty($portfolio)) {

		$portfolio['Portfolio']['online'] = 1;
		if ($this->Portfolio->save($this->Portfolio->saveField('online', 1,false))) {
			$slug=$portfolio['Portfolio']['slug'];
			$this->Flash->success(__('The Portfolio %s has been published.',h($slug)),array('class'=>'success','type'=>'ok'));
		} else {
			return	$this->Flash->error(__('The Portfolio %s was not published.',h($slug)),array('class'=>'danger','type'=>'sign'));
		}
		$this->redirect(array('action'=>'index'));
	} else {
		$this->Flash->error(__('No Portfolio by that ID was found.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
}
/**
 * [admin_disable description]
 * @param  [type] $id [description]
 * @return [type]     [description]
 */
function admin_disable($id=null) {
	$portfolio = $this->Portfolio->read(null,$id);
	if (!$id && empty($portfolio)) {
		$this->Flash->error(__('You must provide a valid ID number to disable a portfolio.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
	if (!empty($portfolio)) {
		$portfolio['Portfolio']['online'] = 1;
		if($this->Portfolio->saveField('online', 0)){
			$this->Flash->success(__('The Portfolio %s has been disabled.',h($slug=$portfolio['Portfolio']['slug'])),array('class'=>'success','type'=>'ok'));
		}else{
			$this->Flash->error(__('The Portfolio %s was not disabled.',h($id)),array('class'=>'danger','type'=>'sign'));
		}
		return	$this->redirect(array('action'=>'index'));
	} else {
		$this->Flash->error(__('No Portfolio by that ID was found.',true),array('class'=>'danger','type'=>'sign'));
		$this->redirect(array('action'=>'index'));
	}
}
}
