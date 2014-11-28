<?php
App::uses('Certificate', 'Model');

/**
 * Certificate Test Case
 *
 */
class CertificateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.certificate'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Certificate = ClassRegistry::init('Certificate');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Certificate);

		parent::tearDown();
	}

}
