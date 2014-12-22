<?php
App::uses('AppModel', 'Model');
/**
 * Date Model
 *
 * @property Course $Course
 * @property Room $Room
 * @property Account $Account
 */
class Date extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

    /**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'begin' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'Bitte geben Sie ein valides Datum an.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Das Beginndatum darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'end' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'Bitte geben Sie ein valides Datum an.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Das Endedatum darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Course' => array(
			'className' => 'Course',
			'foreignKey' => 'course_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Room' => array(
			'className' => 'Room',
			'foreignKey' => 'room_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
    public $hasAndBelongsToMany = array(
		'Account' => array(
			'className' => 'Account',
			'joinTable' => 'accounts_dates',
			'foreignKey' => 'date_id',
			'associationForeignKey' => 'account_id',
			'unique' => 'false',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		)
	);

}
