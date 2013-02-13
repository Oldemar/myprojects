<?php
App::uses('AppModel', 'Model');
/**
 * Interest Model
 *
 * @property User $User
 * @property Area $Area
 */
class Interest extends AppModel
{
	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'mainarea' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'area_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
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
		'User' => array(
			'className'  => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		),
		'Area' => array(
			'className'  => 'Area',
			'foreignKey' => 'area_id',
			'conditions' => '',
			'fields'     => '',
			'order'      => ''
		)
	);

	/**
	 * Before save filter.
	 * 
	 * @see Model::beforeSave()
	 */
	public function beforeSave()
	{
		$this->create($this->data);
		$this->data['Interest']['user_id'] = Authcomponent::user('id');
		return TRUE;
	}

	/**
	 * Custom find all.
	 * 
	 * Find all areas 
	 */
	public function findAllAreas()
	{
		$areas = $this->findArea(
			array(
				'Area.parent_id' => 0,
				'Area.active'    => true
			),
			array(
				'ChildArea' => array(
					'fields' => array(
						'ChildArea.id',
						'ChildArea.name',
						'ChildArea.image',
						'ChildArea.parent_id',
						'ChildArea.description'
					)
				)
			)
		);

		foreach ($areas as $a => $area) {
			$ids = $this->getChildrenIds($area['ChildArea']);
			$this->findGrandChildrens($ids, $area['ChildArea']);
			if (!empty($area['ChildArea'])) {
				$area['ChildArea'] = Set::sort($area['ChildArea'], '{n}.name', 'asc');
			}
			$areas[$a]['ChildArea'] = $area['ChildArea'];
		}

		return $areas;
	}

	/**
	 * Get the Area Ids of the area record.
	 * 
	 * Used to find grand-children.
	 * 
	 * @param  array $children Children list.
	 * @return array An array list of Area ids
	 */
	private function getChildrenIds($children)
	{
		$ids = array();
		foreach ($children as $a => $child) {
			// Find all grand-children
			$ids[] = $child['id'];
		}
		return $ids;
	}

	/**
	 * Find all grandchildren and their grandchildren and so on.
	 * 
	 * @param array $ids ID list.
	 */
	private function findGrandChildrens($ids, &$children)
	{
		$areas = $this->findArea(array(
			'Area.parent_id' => $ids,
			'Area.active'    => true
		));

		// To prevent an infinite loop, exit function
		// where there is no record.
		if (!$areas || empty($areas)) {
			return;
		}

		$newChildren = array();
		foreach ($areas as $area) {
			$newChildren[] = $children[] = $area['Area'];
		}
		$ids = $this->getChildrenIds($newChildren);
		$this->findGrandChildrens($ids, $children);
		unset($newChildren);
	}

	/**
	 * Find Area
	 * 
	 * @param array $conditions Condition clause.
	 */
	private function findArea($conditions, $contain = array())
	{
		return $this->User->Area->find('all', array(
			'fields' => array(
				'Area.id',
				'Area.name',
				'Area.image',
				'Area.parent_id',
				'Area.description'
			),
			'conditions' => $conditions,
			'contain'    => $contain
		));
	}

	public function findAll($userId)
	{
		$interests = $this->find('all', array(
			'conditions' => array(
				'Interest.user_id' => $userId
			),
			'contain' => array('Area')
		));
		return $interests;
	}
}
