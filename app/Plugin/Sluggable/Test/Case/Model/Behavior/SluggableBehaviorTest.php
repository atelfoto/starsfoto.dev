<?php
class Post extends CakeTestModel{
    public $actsAs = array('Sluggable.Sluggable');
}
class Post2 extends CakeTestModel{
    public $useTable = 'posts';
    public $actsAs = array('Sluggable.Sluggable' => array(
        'field'     => 'content',
        'slug'      => 'name',
        'overwrite' => true,
        'separator' => '_',
        'lowercase' => false
    ));
}

class SluggableTestCase extends CakeTestCase{

    public $fixtures = array('plugin.sluggable.post');

    public function setUp(){
        parent::setUp();
        $this->Post = new Post();
    }

    public function testSlugGeneration(){
        $this->Post->save(array('name' => 'Hi my name is john'));
        $this->assertEqual('', $this->Post->field('slug'));

        $this->Post->save(array('name' => 'Hi my name is john', 'slug' => ''));
        $this->assertEqual('hi-my-name-is-john', $this->Post->field('slug'));
    }

    public function testWithParameters(){
        $this->Post2 = new Post2();
        $this->Post2->save(array('content' => 'Hi what is my name ?'));
        $this->assertEqual('Hi_what_is_my_name', $this->Post2->field('name'));
    }

}