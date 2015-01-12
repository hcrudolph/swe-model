<?php
App::uses('AppModel', 'Model');
/**
 * Person Model
 *
 * @property Account $Account
 */
class Person extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	/**
	 * beforeSave()
	 *
	 * @return true
	 */

	public function beforeSave($options = array())
	{

		foreach ($this->data[$this->alias] as $key => $val) {
			if (!(!empty($val) || is_numeric($val))) {
				$this->data[$this->alias][$key] = null;
			}
		}

		if (!empty($this->data[$this->alias]['birthdate'])) {
			$this->data[$this->alias]['birthdate'] = $this->dateFormatBeforeSave($this->data[$this->alias]['birthdate']);
		}

		return true;
	}

	/**
	 * dateFormatBeforeSave()
	 *
	 * @return $dateString
	 */
	public function dateFormatBeforeSave($dateString) {
		return date('Y-m-d', strtotime($dateString));
	}


	/**
	 * afterFind()
	 *
	 * @return $results
	 */

	public function afterFind($results, $primary = false) {
		if($primary) {
			foreach ($results as $key => $val) {
				if (array_key_exists('birthdate', $val['Person'])) {
					$results[$key]['Person']['birthdate'] = $this->dateFormatAfterFind($val['Person']['birthdate']);
				}
			}
		} else {
			if (array_key_exists('birthdate', $results['Person'])) {
				$results['Person']['birthdate'] = $this->dateFormatAfterFind($results['Person']['birthdate']);
			}
		}
		return $results;
	}

	/**
	 * dateFormatAfterFind()
	 *
	 * @return $dateString
	 */
	public function dateFormatAfterFind($dateString) {
		return date('d.m.Y', strtotime($dateString));
	}


/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Bitte geben Sie eine valide EMail-Adresse an.',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'name' => array(
			'maxLength' => array(
				'rule' => array('maxLength', '24'),
				'message' => 'Der Vorname darf maximal 24 Zeichen lang sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength', '2'),
				'message' => 'Der Vorname muss mindestens 2 Zeichen lang sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Der Vorname darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'surname' => array(
			'maxLength' => array(
				'rule' => array('maxLength', '24'),
				'message' => 'Der Nachname darf maximal 24 Zeichen lang sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength', '2'),
				'message' => 'Der Nachname muss mindestens 2 Zeichen lang sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Der Nachname darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'plz' => array(
			'postal' => array(
                'rule' => array('postal', null, 'de'),
				'message' => 'Bitte geben Sie eine valide Postleitzahl an.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Die Postleitzahl darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'city' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Der Ortsname darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'street' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Der Straßenname darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'housenumber' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Die Hausnummer darf nicht leer sein.',
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
		),
		'hnextra' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Dieses Feld darf nur aus Zahlen und Buchstaben bestehen.',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'birthdate' => array(
			'date' => array(
				'rule' => array('date', 'dmy'),
				'message' => 'Bitte geben Sie ein valides Datum an.',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		)
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
			'dependent' => true
		)
	);
}
