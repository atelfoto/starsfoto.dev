<?php
App::uses('Carousel', 'Model');

/**
 * Carousel Test Case
 */
class CarouselTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.carousel'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Carousel = ClassRegistry::init('Carousel');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Carousel);

		parent::tearDown();
	}

}
