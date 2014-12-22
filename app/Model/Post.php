<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property Account $Account
 */
class Post extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'heading';



	/**
	 * afterFind()
	 *
	 * @return $results
	 */

	public function afterFind($results, $primary = false) {
		foreach ($results as $key => $val) {
			if (isset($val['Post']['visiblebegin'])) {
				$results[$key]['Post']['visiblebegin'] = $this->dateFormatAfterFind($val['Post']['visiblebegin']);
			}
			if (isset($val['Post']['visibleend'])) {
				$results[$key]['Post']['visibleend'] = $this->dateFormatAfterFind($val['Post']['visibleend']);
			}
			if (isset($val['Post']['created'])) {
				$results[$key]['Post']['created'] = $this->dateTimeFormatAfterFind($val['Post']['created']);
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
	 * dateTimeFormatAfterFind()
	 *
	 * @return $dateTimeString
	 */
	public function dateTimeFormatAfterFind($dateTimeString) {
		return date('d.m.Y h:i:s', strtotime($dateTimeString));
	}

	/**
	 * beforeSave()
	 *
	 * @return true
	 */

	public function beforeSave($options = array())
	{
		$this->data[$this->alias] = Hash::filter($this->data[$this->alias]);

		if (!empty($this->data[$this->alias]['visiblebegin'])) {
			$this->data[$this->alias]['visiblebegin'] = $this->dateFormatBeforeSave($this->data[$this->alias]['visiblebegin']);
		}
		if (!empty($this->data[$this->alias]['visibleend'])) {
			$this->data[$this->alias]['visibleend'] = $this->dateFormatBeforeSave($this->data[$this->alias]['visibleend']);
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
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'heading' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Sie müssen einen Betreff eingeben',
				'allowEmpty' => false,
				'required' => true,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxLength' => array(
				'rule' => array('maxLength', '50'),
				'message' => 'Maximal 50 Zeichen',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'body' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Der Body muss Text enthalten',
				'allowEmpty' => false,
				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'visiblebegin' => array(
			'date' => array(
				'rule' => array('date', 'dmy'),
				'message' => 'Falsches Datenformat',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'hasEnd'    => array(
				'rule'      => array('hasEnd'),
				'message' => 'Sie müssen ein Endedatum angeben',
			),
		),
		'visibleend' => array(
			'date' => array(
				'rule' => array('date', 'dmy'),
				'message' => 'Falsches Datenformat',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'hasStart'    => array(
				'rule'      => array('hasStart'),
				'message' => 'Sie müssen ein Beginndatum angeben',
			),
			'endBigger'    => array(
				'rule'      => array('endBigger'),
				'message' => 'Das Endedatum muss nach dem Beginndatum sein',
			)
		)
	);

	public function hasEnd()
	{
		return (!empty($this->data[$this->alias]['visiblebegin']) AND !empty($this->data[$this->alias]['visibleend']));
	}

	public function hasStart()
	{
		return (!empty($this->data[$this->alias]['visibleend']) AND !empty($this->data[$this->alias]['visiblebegin']));
	}

	public function endBigger()
	{
		return ((new DateTime($this->data[$this->alias]['visibleend'])) > (new DateTime($this->data[$this->alias]['visiblebegin'])));
	}




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
