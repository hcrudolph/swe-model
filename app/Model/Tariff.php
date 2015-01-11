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
		'description' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Das Tarifmodell benötigt einen Namen',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'amount' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Sie müssen eine Zahl eingeben.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Bitte geben Sie einen Betrag ein.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

    public function afterFind($results, $primary = false) {
        foreach ($results as $key => $val) {
            if (isset($val['Tariff']['amount'])) {
                $results[$key]['Tariff']['amount'] = $this->NumberFormatAfterFind($val['Tariff']['amount']);
            }
        }
        return $results;
    }

    public function beforeSave($options = array())
    {
        if (!empty($this->data['Tariff']['amount'])) {
            $this->data['Tariff']['amount'] = $this->NumberFormatBeforeSave($this->data['Tariff']['amount']);
        }

        return true;
    }

    /**
     * NumberFormatAfterFind()
     *
     * @return $NumberString
     */

    public function NumberFormatAfterFind($NumberString) {
        $string = $NumberString;
        $NumberString = str_replace('.', ',', $string);
        return ($NumberString);
    }

    public function NumberFormatBeforeSave($NumberString) {
        $string = $NumberString;
        $NumberString = str_replace(',', '.', $string);
        return ($NumberString);
    }


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
