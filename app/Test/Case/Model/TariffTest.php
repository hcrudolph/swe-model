<?php
App::uses('Tariff', 'Model');

/**
 * Tariff Test Case
 *
 */
class TariffTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tariff'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tariff = ClassRegistry::init('Tariff');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tariff);

		parent::tearDown();
	}

}
