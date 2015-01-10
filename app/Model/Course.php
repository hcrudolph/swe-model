<?php
App::uses('AppModel', 'Model');
/**
 * Course Model
 *
 * @property Date $Date
 */
class Course extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Der Kursname darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'level' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Der Schwierigkeitsgrad darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Bitte geben Sie eine valide Ganzzahl an.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'range' => array(
				'rule' => array('range', -1, 6),
				'message' => 'Der Schwierigkeitsgrad muss einer Zahl zwischen 0 und 5 entsprechen.'
			)
		),
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Die Kursbeschreibung darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'tariff_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Der Kurs benötigt ein Tarifmodell für den Trainer.',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
            'TariffExists' => array (
                'rule' => array('TariffExists'),
                'message' => 'Es existiert kein Tarifmodell für diesen Kurs.',
            )
		),
	);

    public function TariffExists() {
        if(!$this->Tariff->exists())
            return true;
    }


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Date' => array(
			'className' => 'Date',
			'foreignKey' => 'course_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	public $hasOne = array(
		'Tariff' => array(
			'className' => 'Tariff',
			'foreignKey' => 'course_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
