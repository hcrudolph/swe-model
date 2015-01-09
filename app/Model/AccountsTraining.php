<?php
App::uses('AppModel', 'Model');
/**
 * AccountsTraining Model
 *
 * @property Account $Account
 */
class AccountsTraining extends AppModel {

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
		'account_id' => array(
			'account_id' => array(
				'required',
				'exists'=>array(
					'model'=>'Account',
					'field'=>'id',
					'message'=>'Invalider Account'
				)
			)
		),
		'downloadlink' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Der Downloadlink darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'url' => array(
				'rule' => array('url'),
				'message' => 'Der angegebene Pfad ist keine valide URI.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
