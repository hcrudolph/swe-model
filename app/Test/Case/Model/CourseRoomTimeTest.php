<?php
App::uses('CourseRoomTime', 'Model');

/**
 * CourseRoomTime Test Case
 *
 */
class CourseRoomTimeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.course_room_time'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CourseRoomTime = ClassRegistry::init('CourseRoomTime');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CourseRoomTime);

		parent::tearDown();
	}

}
