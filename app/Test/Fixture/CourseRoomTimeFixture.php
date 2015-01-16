<?php
/**
 * CourseRoomTimeFixture
 *
 */
class CourseRoomTimeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 32, 'unsigned' => true, 'key' => 'primary'),
		'courseid' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 32, 'unsigned' => true, 'key' => 'index'),
		'roomid' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index', 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'director' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 32, 'unsigned' => true),
		'begin' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'end' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'presetup' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'postsetup' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'courseid' => array('column' => 'courseid', 'unique' => 0),
			'roomid' => array('column' => 'roomid', 'unique' => 0)
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
			'courseid' => 1,
			'roomid' => 'Lorem ip',
			'director' => 1,
			'begin' => '2014-11-29 12:40:08',
			'end' => '2014-11-29 12:40:08',
			'presetup' => '2014-11-29 12:40:08',
			'postsetup' => '2014-11-29 12:40:08'
		),
	);

}
