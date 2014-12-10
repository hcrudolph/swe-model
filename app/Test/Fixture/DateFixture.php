<?php
/**
 * DateFixture
 *
 */
class DateFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'course_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'room_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'director' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'index'),
		'begin' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'end' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'presetup' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'postsetup' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'course_id' => array('column' => 'course_id', 'unique' => 0),
			'room_id' => array('column' => 'room_id', 'unique' => 0),
			'director' => array('column' => 'director', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'course_id' => 1,
			'room_id' => 1,
			'director' => 1,
			'begin' => '2014-12-10 09:24:25',
			'end' => '2014-12-10 09:24:25',
			'presetup' => '2014-12-10 09:24:25',
			'postsetup' => '2014-12-10 09:24:25'
		),
	);

}
