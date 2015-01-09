<?php
App::uses('AppModel', 'Model');
/**
 * Tariff Model
 *
 * @property Course $Course
 */
class Tariff extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'description';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'course_id' => array(
			'required',
			'exists'=>array(
				'model'=>'Course',
				'field'=>'id',
				'message'=>'Invalider Kurs'
			),
		),
		'description' => array(
			'required',
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Sie müssen eine Tarifbeschreibung angeben',
				'allowEmpty' => false,
				'required' => true
			),
		),
		'amount' => array(
			'required',
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Der Betrag muss numerisch sein',
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Sie müssen einen Betrag angeben',
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	/*public $belongsTo = array(
		'Course' => array(
			'className' => 'Course',
			'foreignKey' => 'course_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);*/
}
