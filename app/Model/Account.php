<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
App::uses('Security', 'Utility');
/**
 * Account Model
 *
 * @property Person $Person
 * @property Bill $Bill
 * @property Post $Post
 * @property Certificate $Certificate
 * @property Date $Date
 */
class Account extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

    /**
 * beforeSave()
 *
 * @return true
 */

    public function beforeSave($options = array()) {
    	if(array_key_exists ( 'password' , $this->data[$this->alias])
    	{
		if (!(!empty($this->data[$this->alias]['password']) || is_numeric($this->data[$this->alias]['password']))) {
			unset($this->data[$this->alias]['password']);
		}
    	}

        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash($this->data[$this->alias]['password']);
        }
        return true;
    }

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'username' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				'message' => 'Der Username darf ausschließlich aus Buchstaben und Zahlen bestehen',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', '20'),
				'message' => 'Der Username darf maximal 20 Zeichen lang sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength', '4'),
				'message' => 'Der Username muss mindestens 4 Zeichen lang sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Der Username darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'isUnique' => array(
				'rule' => array('isUnique'),
				'message' => 'Dieser Username existiert bereits',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'password' => array(
			'maxLength' => array(
				'rule' => array('maxLength', '20'),
				'message' => 'Das Passwort darf maximal 20 Zeichen lang sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength', '6'),
				'message' => 'Das Passwort muss mindestens 6 Zeichen lang sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Das Passwort darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'passwordRepeat' => array(
			'compare'    => array(
				'rule'      => array('comparePasswords'),
				'message' => 'Die Passwörter stimmen nicht überein.',
			)

		),
		'role' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Die Rolle darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Bitte geben Sie eine valide Ganzzahl ein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'range' => array(
				'rule' => array('range', -1, 3),
				'message' => 'Die Rolle muss einer Zahl zwischen 0 und 2 entsprechen.'
			)
		)
	);


	public function comparePasswords(){
		return $this->data[$this->alias]['password'] === $this->data[$this->alias]['passwordRepeat'];
	}

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'Person' => array(
			'className' => 'Person',
			'foreignKey' => 'account_id',
			'dependent' => true
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'account_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Date' => array(
			'className' => 'Date',
			'foreignKey' => 'director',
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


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
    public $hasAndBelongsToMany = array(
		'Certificate' => array(
			'className' => 'Certificate',
			'joinTable' => 'accounts_certificates',
			'foreignKey' => 'account_id',
			'associationForeignKey' => 'certificate_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
		),
		'Date' => array(
			'className' => 'Date',
			'joinTable' => 'accounts_dates',
			'foreignKey' => 'account_id',
			'associationForeignKey' => 'date_id',
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
