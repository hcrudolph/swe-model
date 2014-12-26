<?php
App::uses('Bill', 'Model');

/**
 * Bill Test Case
 *
 */
class BillTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bill',
		'app.account',
		'app.person',
		'app.post',
		'app.date',
		'app.course',
		'app.room',
		'app.accounts_date',
		'app.certificate',
		'app.accounts_certificate',
		'app.tariff',
		'app.bills_tariff'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Bill = ClassRegistry::init('Bill');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bill);

		parent::tearDown();
	}

}
