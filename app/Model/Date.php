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
	//For easy HABTM-add and -delete
	public $actsAs = array('ExtendAssociations');

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	/**
	 * dateFormatAfterFind()
	 *
	 * @param $results, $primary
	 * @return $results
	 */
	public function afterFind($results, $primary = false) {
		foreach ($results as $key => $val) {
			if (isset($val['Date']['begin'])) {
				$results[$key]['Date']['begin'] = $this->dateTimeFormatAfterFind($val['Date']['begin']);
			}
			if (isset($val['Date']['end'])) {
				$results[$key]['Date']['end'] = $this->dateTimeFormatAfterFind($val['Date']['end']);
			}
		}
		return $results;
	}

	/**
	 * dateFormatAfterFind()
	 *
	 * @return $dateTimeString
	 */
	public function dateTimeFormatAfterFind($dateTimeString) {
		return date('d.m.Y H:i:s', strtotime($dateTimeString));
	}

	/**
	 * beforeSave()
	 *
	 * @return true
	 */

	public function beforeValidate($options = array())
	{
		if (!empty($this->data[$this->alias]['begin'])) {
			$this->data[$this->alias]['begin'] = $this->dateTimeFormatBeforeSave($this->data[$this->alias]['begin']);
		}
		if (!empty($this->data[$this->alias]['end'])) {
			$this->data[$this->alias]['end'] = $this->dateTimeFormatBeforeSave($this->data[$this->alias]['end']);
		}

		return true;
	}

	/**
	 * beforeSave()
	 *
	 * @return true
	 */

	public function beforeSave($options = array())
	{
		if (!empty($this->data[$this->alias]['begin'])) {
			$this->data[$this->alias]['begin'] = $this->dateTimeFormatBeforeSave($this->data[$this->alias]['begin']);
		}
		if (!empty($this->data[$this->alias]['end'])) {
			$this->data[$this->alias]['end'] = $this->dateTimeFormatBeforeSave($this->data[$this->alias]['end']);
		}

		return true;
	}

	/**
	 * dateTimeFormatBeforeSave()
	 *
	 * @return $dateTimeString
	 */
	public function dateTimeFormatBeforeSave($dateTimeString) {
		return date('Y-m-d H:i:s', strtotime($dateTimeString));
	}




    /**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'begin' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Das Beginndatum darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'datetime' => array(
				'rule' => array('datetime', 'ymd'),
				'message' => 'Bitte geben Sie ein valides Datum an.',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'room_id' => array(
			'roomFree'    => array(
				'rule'      => array('roomFree'),
				'message' => 'In diesem Zeitraum ist der Raum bereits belegt.',
			),
            'RoomExists' => array (
                'rule' => array('RoomExists'),
                'message' => 'Dieser Raum existiert nicht.',
                )
		),

        'course_id' => array(
            'CourseExists' => array (
                'rule' => array('CourseExists'),
                'message' => 'Dieser Kurs existiert nicht.',
                )
        ),

		'director' => array(
			'mitarbeiterFree'    => array(
				'rule'      => array('mitarbeiterFree'),
				'message' => 'In diesem Zeitraum ist der Mitarbeiter bereits verplant.',
			),
            'DirectorExists' => array (
                'rule' => array('DirectorExists'),
                'message' => 'Dieser Mitarbeiter existiert nicht.',
            )

		),
		'end' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Das Endedatum darf nicht leer sein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'datetime' => array(
				'rule' => array('datetime', 'ymd'),
				'message' => 'Bitte geben Sie ein valides Datum an.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'endBigger'    => array(
				'rule'      => array('endBigger'),
				'message' => 'Das Endedatum muss größer als das Beginndatum sein.',
			)
		),
		'mincount' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Sie müssen eine minimale Teilnehmeranzahl angeben.',
				'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Bitte geben Sie eine valide Ganzzahl an.',
				'allowEmpty' => false,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'maxcount' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Sie müssen eine maximale Teilnehmeranzahl angeben.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Bitte geben Sie eine valide Ganzzahl an.',
				'allowEmpty' => true,
				'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'maxcountBigger'    => array(
				'rule'      => array('maxcountBiggerEqual'),
				'message' => 'Die maximale Teilnehmerzahl muss mindestens der Minimalen entsprechen.',
			),
			'maxcountBiggerEqualTeilnehmer' => array (
				'rule'      => array('maxcountBiggerEqualTeilnehmer'),
				'message' => 'Die neue maximale Teilnehmerzahl ist geringer als die Zahl bereits angemeldeter Nutzer.',
			)
		)
	);

	/**
	 * endBigger()
	 *
	 * @return boolean
	 */
	public function endBigger()
	{
		return ((new DateTime($this->data[$this->alias]['end'])) > (new DateTime($this->data[$this->alias]['begin'])));
	}
	/**
	 * maxcountBigger()
	 *
	 * @return boolean
	 */
	public function maxcountBiggerEqual() {
		return ($this->data[$this->alias]['maxcount'] >= $this->data[$this->alias]['mincount']);
	}
	/**
	 * maxcountBiggerEqualTeilnehmer()
	 *
	 * @return boolean
	 */
	public function maxcountBiggerEqualTeilnehmer() {
		$date = $this->findById($this->data[$this->alias]['id']);
		return ($this->data[$this->alias]['maxcount'] >=  count($date['Account']));
	}

	/**
	 * CourseExists()
	 *
	 * @return boolean
	 */
	public function CourseExists() {
		return $this->Course->exists($this->data[$this->alias]['course_id']);
	}

	/**
	 * RoomExists()
	 *
	 * @return boolean
	 */
	public function RoomExists() {
		return $this->Room->exists($this->data[$this->alias]['room_id']);
	}

	/**
	 * DirectorExists()
	 *
	 * @return boolean
	 */
	public function DirectorExists() {
		return $this->Account->exists($this->data[$this->alias]['director']);
	}
	/**
	 * roomFree()
	 *
	 * @return boolean
	 */
	public function roomFree() {
		$conditions = array(
			'Date.room_id' => $this->data[$this->alias]['room_id'],
			'OR' => array(
				array(
					'Date.begin >=' => $this->data[$this->alias]['begin'],
					'Date.begin <' => $this->data[$this->alias]['end']
				),
				array(
					'Date.end >' => $this->data[$this->alias]['begin'],
					'Date.end <=' => $this->data[$this->alias]['end']
				)
			)
		);
		if(isset($this->data[$this->alias]['id']))
		{
			$conditions['NOT'] = array (
				'Date.id' => array($this->data[$this->alias]['id'])
			);
		}
		$count = $this->find('count', array('conditions' => $conditions));
		return (($count==0)?true:false);
	}

	/**
	 * mitarbeiterFree()
	 *
	 * @return boolean
	 */
	public function mitarbeiterFree() {
		$conditions = array(
			'Date.director' => $this->data[$this->alias]['director'],
			'OR' => array(
				array(
					'Date.begin >=' => $this->data[$this->alias]['begin'],
					'Date.begin <' => $this->data[$this->alias]['end']
				),
				array(
					'Date.end >' => $this->data[$this->alias]['begin'],
					'Date.end <=' => $this->data[$this->alias]['end']
				)
			)
		);
		if(isset($this->data[$this->alias]['id']))
		{
			$conditions['NOT'] = array (
				'Date.id' => array($this->data[$this->alias]['id'])
			);
		}
		$count = $this->find('count', array('conditions' => $conditions));
		return (($count==0)?true:false);
	}



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
		),
		'Trainer' => array(
			'className' => 'Account',
			'foreignKey' => 'director',
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
